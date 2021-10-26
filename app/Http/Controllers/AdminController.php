<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;

class AdminController extends SearchableController
{
    //
    function list()
    {
        return view('admin.product', [
            'products' => Product::orderBy('code')->get(),
        ]);
    }
    
    function createForm(){
        return view('admin.create-product-form');
    }
    function create(Request $request){
        
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        Product::create($request->all());
        return redirect()->route('admin.product');
    }

    function updateForm($productCode){
        $product = $this->find($productCode);
        return view('admin.update-form',[
            'product' => $product,
        ]);
    }

    function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $product->update($request->all());

        return redirect()->route('admin.product',);
    }
}
