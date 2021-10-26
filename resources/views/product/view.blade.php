@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
<ul>
                <li><a href="{{route('product-view-shop', [
                        'product' => $product->code,
                        ])}}">Show Shop</a></li>
                @can('update', \App\Models\Product::class)
                <li>
                        <a href="{{route('product-update',['product' => $product->code,])}}">Update</a>
                </li>
                @endcan
                @can('delete', \App\Models\Product::class)
                <li>
                        <a href="{{route('product-update',['product' => $product->code,])}}">Delete</a>
                </li>
                @endcan
                <li>
                        <a href="{{session()->get('bookmark.product-view', route('product-list'))}}">&lt; Back</a>
                </li>
        </ul>
</nav>

<table>
        <tr>
                <td><strong>Code</strong></td>
                <td class="blue">::</td>
                <td>{{$product['code']}}</td>
        </tr>

        <tr>
                <td><strong>Name</strong></td>
                <td class="blue">::</td>
                <td class="name">{{$product['name']}}</td>
        </tr>

        <tr>
                <td><strong>Category</strong></td>
                <td class="blue">::</td>
                <td>[{{$product->category->code}}] <span class="name">{{$product->category->name}}</span></td>
        </tr>

        <tr>
                <td><strong>Price</strong></td>
                <td class="blue">::</td>
                <td>{{ number_format((double)$product['price'],2)}}</td>
        </tr>
</table>
<pre>
{{$product['description']}}
</pre>

@endsection