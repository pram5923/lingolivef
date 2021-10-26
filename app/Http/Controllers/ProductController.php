<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Alret;
class ProductController extends SearchableController
{
    function admin(){

        return view('admin.product',[
            'products' => Product::orderBy('code')->get(),
        ]);
    }

    function getQuery()
    {
        return Product::orderBy('code');
    }

    public function filterByTerm($query, $term)
    {
        if (!empty($term)) {
            $words = preg_split('/\s+/', $term);

            foreach ($words as $word) {
                $query->where(function ($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('name', 'LIKE', "%{$word}%")
                        ->orWhere('code', 'LIKE', "%{$word}%")
                        ->orWhereHas('category', function ($query) use ($word) {
                            $query->where('name', 'LIKE', "%{$word}%");
                        });
                });
            }
        }
        return $query;
    }

    function list(Request $request)
    {
        $categories = Category::orderBy('code')->get();
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search)->withCount('shops');
        session()->put('bookmark.product-view', $request->getUri());
        return view('product.list', [
            'search' => $search,
            'products' => $query->paginate(7),
            'categories' => $categories,
        ]);
    }

    function createForm(Request $request)
    {
        $this->authorize('create', Product::class);
        $categories = Category::orderBy('code')->get();
        return view('admin.create-product-form', [
            'categories' => $categories,
        ]);
    }

    function create(Request $request)
    {
        $this->authorize('create', Product::class);
        try{
            $product = Product::create($request->getParsedBody());
            return redirect()->route('admin.product')
                ->withSuccessMessage('status', "Product {$product->code} was created.");
                //with('status', "Product {$product->code} was created.");
                // ... Normal process
            } catch(QueryException$excp) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function show($productCode)
    {
        $product = $this->find($productCode);
        return view('product-view', [
            'title' => "{$this->title} : View",
            'product' => $product,
        ]);
    }

    function updateForm($productCode)
    {
        $this->authorize('update', Product::class);
        $product = $this->find($productCode);
        $categories = Category::orderBy('code')->get();

        return view('admin.update-form', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    function update(Request $request, $productCode)
    {
        $this->authorize('update', Product::class);

        try{
            // ... Normal process
            $product = $this->find($productCode);
            $product->fill($request->getParsedBody());
            $product->save();
        } catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ])->withSuccessMessage('Success Title');
        }
    }

    function delete($productCode)
    {
        $this->authorize('delete', Product::class);
        
        try{
            // ... Normal process
            $product = $this->find($productCode);
            $product->delete();
            return redirect(session()->get('bookmark.admin.product', route('admin.product')))
            ->with('status', "Product {$product->code} was deleted.");
        } catch(QueryException$excp) 
        {// We don't want withInput() here.
            return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
        ]);
    }
    }

    function prepareSearch($search)
    {
        $search = parent::prepareSearch($search);
        $search = array_merge([
            'minPrice' => null,
            'maxPrice' => null,
        ], $search);
        return $search;
    }

    function filterByPrice($query, $minPrice, $maxPrice)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        return $query;
    }

    function filterBySearch($query, $search)
    {
        $query = parent::filterBySearch($query, $search);
        $query = $this->filterByPrice(
            $query,
            $search['minPrice'],
            $search['maxPrice']
        );
        return $query;
    }

    function showShop(Request $request, ShopController $shopController, $productCode)
    {
        $product = $this->find($productCode);
        $search = $shopController->prepareSearch($request->getQueryParams());
        $query = $shopController->filterBySearch($product->shops(), $search);
        return view('product-view-shop', [
            'title' => "{$this->title} {$product->code} : Shop",
            'product' => $product,
            'search' => $search,
            'shops' => $query->paginate(5),
        ]);
    }

    function addShopForm(Request $request, ShopController $shopController, $productCode)
    {
        $this->authorize('update', Product::class);
        $product = $this->find($productCode);
        $query = Promotion::orderBy('code')->whereDoesntHave(
                'products',
                function ($innerQuery) use ($product) {
                    return $innerQuery->where('code', $product->code);
                }
            );

        $search = $shopController->prepareSearch($request->getQueryParams());
        $query = $shopController->filterBySearch($query, $search);

        return view('product-add-shop-form', [
            'title' => "{$this->title} {$product->code} : Add Shop",
            'search' => $search,
            'product' => $product,
            'shops' => $query->paginate(5),
        ]);
    }

    function addShop(
        Request $request,
        ShopController $shopController,
        $productCode
    ) {
        $this->authorize('update', Product::class);
        
        try{
            // ... Normal process
            $product = $this->find($productCode);
            $data = $request->getParsedBody();
            $shop = $shopController->find($data['shop']);
            $product->shops()->attach($shop);
    
            return redirect(session()->get('bookmark.product-view-shop', route('product-add-shop-form', ['product'=>$product->code])))
                ->with('status', "Shop {$shop->code} was added to Prodict {$product->code}.");
        }catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function removeShop($productCode, $shopCode)
    {
        $this->authorize('update', Product::class);
        try{
            // ... Normal process
            $product = $this->find($productCode);
            $shop = $product->shops()
                ->where('code', $shopCode)
                ->firstOrFail();
            $product->shops()->detach($shop);
    
            return redirect()->back()
            ->with('status',"Shop {$shop->code} was remove form Product {$product->code}.");
        } catch(QueryException$excp) {
            // We don't want withInput() here.
            return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
            ]);
        }
    }

    public function __construct() 
    {
        $this->middleware('auth');
    }
}
