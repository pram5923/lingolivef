@extends('layouts.main')

@section('header', $title)

@section('content')

<nav>
        <ul>
                <li><a href="{{route('category-view-product', [
'category' => $category->code,
])}}">Show Product</a></li>
@can('update', \App\Models\category::class)
                <li>
                        <a href="{{ route('category-update-form', [
'category' => $category->code,
]) }}">Update</a>
                </li>
@endcan
                @can('delete', $category)
                <li>
                        <a href="{{ route('category-delete', [
'category' => $category->code,
]) }}">Delete</a>
                </li>
                @endcan
                <li>
                        <a href="{{session()->get('bookmark.category-view', route('category-list'))}}">&lt; Back</a>
                </li>
        </ul>
</nav>

<table>
        <tr>
                <td><strong>Code</strong></td>
                <td class="blue">::</td>
                <td>{{$category['code']}}</td>
        </tr>

        <tr>
                <td><strong>Name</strong></td>
                <td class="blue">::</td>
                <td class="name">{{$category['name']}}</td>
        </tr>

        <tr>
                <td><strong>Description</strong></td>
                <td class="blue">::</td>
                <td>{{ $category['description']}}</td>
        </tr>
</table>

@endsection