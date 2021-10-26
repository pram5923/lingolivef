@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('category-list') }}" method="get" class="search-form">
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
    @can('create', \App\Models\Category::class)
        <li>
            <a href="{{ route('category-create-form') }}">New Category</a>
        </li>
    @endcan
    </ul>
</nav>

{{ $categories->withQueryString()->links() }}

<table class="list">

    <tr>
        <th>Code</th>
        <th >Name</th>
        <th width="10em">No. of Products</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td class="code">
            <a class="code" href="{{route('category-view', [
'category' => $category->code,
])}}">
                {{$category->code }}
            </a>
        </td>
        <td>{{$category->name }}</td>
        <td class="count">{{$category->products_count }}</td>
    </tr>
    @endforeach
</table>

@endsection