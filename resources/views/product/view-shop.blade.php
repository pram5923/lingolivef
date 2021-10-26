@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{route('product-view', [
'product' => $product->code,
])}}">&lt; Back</a></li>
    </ul>
</nav>

<form action="{{route('product-view-shop', [
'product' => $product->code,
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
                    <a href="{{route('product-view-shop', [
        'product' => $product->code,])  }}">
                        <button type="submit" class="accent">Cancel</button>
                    </a>
                </td>
            </tr>
        </table>
</form>
<br>

<nav>
    <ul>
    @can('update', \App\Models\Product::class)
        <li>
            <a href="{{ route('product-add-shop-form', [
    'product' => $product->code,
]) }}">Add Shop</a>
        </li>
    @endcan
    </ul>
</nav>


{{ $shops->withQueryString()->links() }}

<table class="list">

    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Owner</th>
        @can('update', \App\Models\Product::class)
        <th class="Remove"></th>
        @endcan
    </tr>

    @foreach($shops as $shop)
    <tr>
        <td class="code">
            <a class="code" href="{{route('shop-view', [
'shop' => $shop->code,
])}}">
                {{$shop->code }}
            </a>
        </td>
        <td>{{$shop->name }}</td>
        <td>{{$shop->owner }}</td>
        @can('update', \App\Models\Product::class)
        <td>
            <a class="remove" href="{{ route('product-remove-shop', [
                    'product' => $product->code,
                    'shop' => $shop->code,
                ]) }}">Remove</a>
        </td>
        @endcan

    </tr>
    @endforeach
</table>

@endsection