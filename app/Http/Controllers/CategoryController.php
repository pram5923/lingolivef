<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\QueryException;

class CategoryController extends SearchableController
{
    private $title = 'Category';

    function getQuery()
    {
        return Category::orderBy('code');
    }

    function admin(){
        return view('admin.category',[
            'categories' => Category::orderBy('code')->get(),
        ]);
    }
    function list(Request $request)
    {
        $search = $this->prepareSearch($request->getQueryParams());
        $query = $this->search($search)->withCount('products');
        session()->put('bookmark.category-list', $request->getUri());
        return view('category-list', [
            'title' => "{$this->title} : List",
            'search' => $search,
            'categories' => $query->paginate(5),
        ]);
    }

    function createForm()
    {
        return view('admin.create-category-form');
    }

    function create(Request $request)
    {
        try{
            $category = Category::create($request->getParsedBody());
            return redirect()->route('admin.category')
            ->with('status', "Category {$category->code} was created.");
                // ... Normal process
            } catch(QueryException$excp) {
                return redirect()->back()->withInput()->withErrors([
                    'error' => $excp->errorInfo[2],
                ]);
            }
    }

    function show($categoryCode)
    {
        $category = $this->find($categoryCode);
        return view('category-view', [
            'title' => "{$this->title} : View",
            'category' => $category,
        ]);
    }

    function updateForm($categoryCode)
    {
        $category = $this->find($categoryCode);
        return view('admin.update-category-form', [
            'title' => "{$this->title} : Update",
            'category' => $category,
        ]);
    }

    function update(Request $request, $categoryCode)
    {
        try{
            // ... Normal process
            $category = $this->find($categoryCode);
            $category->fill($request->getParsedBody());
            $category->save();
            return redirect(session()->get('bookmark.admin.update-category-form', route('admin.category',['category' => $category->code])))
            ->with('status', "Category {$category->code} was updated."); 
        } catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }

    function delete($categoryCode)
    {
        try{
            // ... Normal process
            $category = $this->find($categoryCode);
            $category->delete();
            return redirect(session()->get('bookmark.admin.category', route('admin.category')))
            ->with('status', "Category {$category->code} was deleted.");
            
        } catch(QueryException$excp) 
        {// We don't want withInput() here.
            return redirect()->back()->withErrors(['error' => $excp->errorInfo[2],
        ]);
    }
    }

    function showCategory(Request $request, ProductController $productController, $categoryCode)
    {
        $category = $this->find($categoryCode);
        $search = $productController->prepareSearch($request->getQueryParams());
        $query = $productController->filterBySearch($category->products(), $search);
        session()->put('bookmark.product-view', $request->getUri());
        return view('category-view-product', [
            'title' => "{$this->title} {$category->code} : Product",
            'category' => $category,
            'search' => $search,
            'products' => $query->paginate(5),
        ]);
    }

    function addProductForm(Request $request, ProductController $productController, $categoryCode)
    {
        $category = $this->find($categoryCode);
        $query = Product::orderBy('code')->whereDoesntHave(
                'category',
                function ($innerQuery) use ($category) {
                    return $innerQuery->where('code', $category->code);
                }
            );

        $search = $productController->prepareSearch($request->getQueryParams());
        $query = $productController->filterBySearch($query, $search);

        return view('category-add-product-form', [
            'title' => "{$this->title} {$category->code} : Add Product",
            'search' => $search,
            'category' => $category,
            'products' => $query->paginate(5),
        ]);
    }

    function addProduct(
        Request $request,
        ProductController $productController,
        $categoryCode
    ) {
        try{
            // ... Normal process
            $category = $this->find($categoryCode);
            $data = $request->getParsedBody();
            $product = $productController->find($data['product']);
            $product->category()->associate($category);
            $product->save();
    
            return redirect(session()->get('bookmark.category-view-product', route('category-add-product-form',['category' => $category->code])))
            ->with('status', "Product {$product->code} was added to Category {$category->code}.");
        }catch(QueryException$excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
                ]);
            }
    }

    public function __construct() 
    {
        $this->middleware('auth');
    }
}
