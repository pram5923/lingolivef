@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
    <ul>
        <li><a href="{{route('category-view-product', [
'category' => $category->code,
])}}">&lt; Back</a></li>
    </ul>
</nav>

<form action="{{route('category-add-product-form', [
'category' => $category->code,
])}}" method="get" class="search-form">
    <div>
        <table>

            <tr>
                <td class="table-label"><label for="cmp-search"><strong>Search</strong></label></td>
                <td class="table-sep"><label class="table-sep">::</label></td>
                <td><input id="cmp-search" type="text" name="term" value="{{ $search['term'] }}" /></td>
                <td class="table-submit"></td>
                <td></td>
            </tr>

            <tr>
                <td class="table-label"><strong>Min Price</strong></td>
                <td><label class="table-sep">::</label></td>
                <td><input type="number" name="minPrice" value="{{ $search['minPrice'] }}"></td>
                <td><input type="submit" value="Search"></td>
                <td><a href="{{route('category-add-product-form', ['category' => $category->code,])}}">
                        <button type="button" class="accent">Clear</button>
                    </a></td>
            </tr>
            <tr>
                <td class="table-label"><strong>Max Price</strong></td>
                <td><label class="table-sep">::</label></td>
                <td><input type="number" name="maxPrice" value="{{ $search['maxPrice'] }}"></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</form>
<br>

{{ $products->withQueryString()->links() }}

<form action="{{ route('category-add-product', [
    'category' => $category->code,
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