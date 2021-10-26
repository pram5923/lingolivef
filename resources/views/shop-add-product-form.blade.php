@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{route('shop-view-product', [
'shop' => $shop->code,
])}}">&lt; Back</a></li>
    </ul>
</nav>

<form action="{{route('shop-add-product-form', [
'shop' => $shop->code,
])}}" method="get" class="search-form">
    <div>
        <table  class="form-table">
            <tr>
                <td>
                    <lable><strong>Search</strong></lable>
                </td>
                <td class="blue">::</td>
                <td><input type="text" name="term" value="{{$search['term']}}"></td>
                <td>
                    <button type="submit" class="primary">Search</button>
                    <a href="{{ route('shop-list')}}">
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

{{ $products->withQueryString()->links() }}

<form action="{{ route('shop-add-product', [
    'shop' => $shop->code,
]) }}" method="post">
    @csrf

    <table class="list">

        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th class="Remove"></th>
        </tr>

        <tbody>
            @foreach($products as $product)
            <tr>
                <th class="code">{{ $product->code }}</th>
                <td><em>{{ $product->name }}</em></td>
                <td>{{$product->category->name}}</td>
                <td>{{ $product->price }}</td>
                <td class="add">
                    <button type="submit" class="Add" name="product" value="{{ $product->code }}">
                        Add
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

@endsection