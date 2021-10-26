@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{route('category-view', [
'category' => $category->code,
])}}">&lt; Back</a></li>
    </ul>
</nav>

<form action="{{route('category-view-product', [
'category' => $category->code,
])}}" method="get" class="search-form">
    <div>
    <table class="form-table">
        <tr>
            <td><lable><strong>Search</strong></lable></td>
            <td class="blue">::</td>
            <td><input type="text" name="term" value="{{$search['term']}}"></td>
            <td>
                <button type="submit" class="primary">Search</button>
    
                    <a href="{{ route('category-list')}}">
                        <button type="submit" class="accent">Cancel</button>
                    </a>
            </td>
        </tr>
        <tr>
            <td><label><strong>Min Price</strong></label></td>
            <td class="blue">::</td>
            <td><input type="number" name="minPrice" value="{{$search['minPrice']}}"></td>
            <td></td>
        </tr>
        <tr>
            <td><label><strong>Mix Price</strong></label></td>
            <td class="blue">::</td>
            <td><input type="number" name="maxPrice" value="{{$search['maxPrice']}}"></td>
        </tr>
    </table>
    </div>
</form>
<br>

<nav>
    <ul>
    @can('create', \App\Models\Category::class)
        <li>
            <a href="{{ route('category-add-product-form', [
    'category' => $category->code,
]) }}">Add Product</a>
        </li>
    @endcan
    </ul>
</nav>

{{ $products->withQueryString()->links() }}

<table class="list">

    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td class="code">
            <a class="code" href="{{route('product-view', [
'product' => $product->code,
])}}">
                {{$product->code }}
            </a>
        </td>
        <td>{{$product->name }}</td>
        <td>{{$product->category->name}}</td>
        <td>{{$product->price }}</td>
    </tr>
    @endforeach
</table>

@endsection