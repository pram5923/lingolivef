@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{route('product-view-shop', [
'product' => $product->code,
])}}">&lt; Back</a></li>
    </ul>
</nav>

<form action="{{route('product-add-shop-form', [
    'product' => $product->code,]) }}" method="get" class="search-form">
    <lable><strong>Search</strong></lable>
    </td>
    <td class="blue">::</td>
    <td><input type="text" name="term" value="{{$search['term']}}"></td>
    <button type="submit">Search</button>
    <a href="{{route('product-view-shop', [
        'product' => $product->code,])  }}">
        <button type="button" class="accent">Clear</button>
    </a>
</form>
<br>

{{ $shops->withQueryString()->links() }}

<form action="{{ route('product-add-shop', [
    'product' => $product->code,
]) }}" method="post">
    @csrf

    <table class="list">

        <tr>
            <th class="remove">Code</th>
            <th>Name</th>
            <th>Owner</th>
            <th class="remove"></th>
        </tr>

        <tbody>
            @foreach($shops as $shop)
            <tr>
                <th class="code">{{ $shop->code }}</th>
                <td><em>{{ $shop->name }}</em></td>
                <td>{{ $shop->owner }}</td>
                <td class="add">
                    <button type="submit" class="Add" name="shop" value="{{ $shop->code }}">
                        Add
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

@endsection