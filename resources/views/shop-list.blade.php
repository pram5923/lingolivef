@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{route('shop-list') }}" method="get" class="search-box">
    <table class="form-table">
        <tr>
            <td>
                <lable><strong>Search</strong></lable>
            </td>
            <td class="blue">::</td>
            <td><input type="text" name="term" value="{{$search['term']}}"></td>
            <td>
                <button type="submit" class="primary">Search</button>
                <a href="{{ route('product-list')}}">
                    <button type="submit" class="accent">Cancel</button>
                </a>
            </td>
        </tr>
    </table>
</form>

<nav>
    <ul>
    @can('create', \App\Models\Shop::class)
        <li>
            <a href="{{ route('shop-create-form') }}">New Shop</a>
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
        <th>No. of Products</th>
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
        <td class="count">{{$shop->products_count }}</td>
    </tr>
    @endforeach
</table>

@endsection