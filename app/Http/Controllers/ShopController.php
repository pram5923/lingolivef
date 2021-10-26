<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\QueryException;
Use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends SearchableController
{

    function getQuery()
    {
        return Shop::orderBy('code');
    }
    function admin(){
        return view('admin.promotion',[
            'shops' => Shop::orderBy('code')->get(),
        ]);
    }

    function filterByTerm($query, $term)
    {
        if (!empty($term)) {
            foreach (preg_split('/\s+/', $term) as $word) {
                $query->where(function ($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('code', 'LIKE', "%{$word}%")
                        ->orWhere('name', 'LIKE', "%{$word}%")
                        ->orWhere('owner', 'LIKE', "%{$word}%");
                });
            }
        }
        return $query;
    }

    function prepareSearch($search)
    {
        $search['term'] = (empty($search['term'])) ? null : $search['term'];
        return $search;
    }
    function filterBySearch($query, $search)
    {
        return $this->filterByTerm($query, $search['term']);
    }

    function search($search)
    {
        $query = $this->getQuery();
        return $this->filterBySearch($query, $search);
    }

    function find($code)
    {
        return $this->getQuery()->where('code', $code)->firstOrFail();
    }

    function list(Request $request)
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search)->withCount('products');
        session()->put('bookmark.shop-view', $request->getUri());
        return view('shop-list', [
            'title' => "{$this->title} : List",
            'search' => $search,
            'shops' => $query->paginate(5),
        ]);
    }

    function createForm()
    {
        return view('admin.create-promotion-form');
    }

    function create(Request $request)
    {
        try{
            $shop = Shop::create($request->getParsedBody());
            return redirect()->withSuccess( 'Promotion {$shop->code} was created.');
                // ... Normal process
            } catch(QueryException$excp) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function show($shopCode)
    {
        $shop = $this->find($shopCode);
        return view('shop-view', [
            'title' => "{$this->title} : View",
            'shop' => $shop,
        ]);
    }


    function updateForm($shopCode)
    {
        $shop = $this->find($shopCode);
        return view('admin.update-promotion-form', [
            'shop' => $shop,
        ]);
    }


    function update(Request $request, $shopCode)
    {    
        try{
            // ... Normal process
            $shop = $this->find($shopCode);
            $shop->fill($request->getParsedBody());
            $shop->save();
            return redirect(session()->get('bookmark.admin.update.promotion.form', route('admin.promotion',['shop' => $shop->code])))
            ->with('status', "Shop {$shop->code} was updated.");
           
        } catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function delete($shopCode)
    {
        $this->authorize('delete', Shop::class);
        try{
            // ... Normal process
            $shop = $this->find($shopCode);
            $shop->delete();
            return redirect(session()->get('bookmark.admin.promotion', route('admin.promotion')))
            ->with('status', "Shop {$shop->code} was deleted.");
        } catch(QueryException$excp) 
        {// We don't want withInput() here.
            return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
        ]);
    }
    }

    function showProduct(Request $request, ProductController $productController, $shopCode)
    {
        $shop = $this->find($shopCode);
        $search = $productController->prepareSearch($request->getQueryParams());
        $query = $productController->filterBySearch($shop->products(), $search);
        session()->put('bookmark.product-view', $request->getUri());
        return view('shop-view-product', [
            'title' => "{$this->title} {$shop->code} : Product",
            'shop' => $shop,
            'search' => $search,
            'products' => $query->paginate(5),
        ]);
    }

    function addProductForm(Request $request, ProductController $productController, $shopCode)
    {
        $shop = $this->find($shopCode);
        $query = Product::orderBy('code')->whereDoesntHave(
                'shops',
                function ($innerQuery) use ($shop) {
                    return $innerQuery->where('code', $shop->code);
                }
            );

        $search = $productController->prepareSearch($request->getQueryParams());
        $query = $productController->filterBySearch($query, $search);

        return view('shop-add-product-form', [
            'title' => "{$this->title} {$shop->code} : Add Product",
            'search' => $search,
            'shop' => $shop,
            'products' => $query->paginate(5),
        ]);
    }

    function addProduct(
        Request $request,
        ProductController $productController,
        $shopCode
    ) {
        try{
            // ... Normal process
            $shop = $this->find($shopCode);
            $data = $request->getParsedBody();
            $product = $productController->find($data['product']);
            $shop->products()->attach($product);
    
            return redirect(session()->get('bookmark.shop-view-product', route('shop-add-product-form',['shop' => $shop->code])))
            ->with('status', "Shop {$shop->code} was added to Product {$product->code}.");  
        }catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
            }
    }


    function removeProduct($shopCode, $productCode)
    {
        try{
            // ... Normal process
            $shop = $this->find($shopCode);
            $product = $shop->products()
                ->where('code', $productCode)
                ->firstOrFail();
            $shop->products()->detach($product);
    
            return redirect()->back()
            ->with('status',"Product {$product->code} was remove form Shop {$shop->code}.");
        } catch(QueryException$excp) {
            // We don't want withInput() here.
            return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
            ]);
        }
    }
}
