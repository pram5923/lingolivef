@extends('layouts.main')

@section('content')
<div class="top">
    <ul>
        <li></li>
        <li>
            <h1 id="text">CATEGORY</h1>
        </li>
        <li>
            <a class="code" href="{{route('admin.create-category-form')}}">
                <input type="submit" class="new" value="New Category">
            </a>
        </li>
    </ul>
</div>

<table class="list">

    <tr>
        <th>Code</th>
        <th >Name</th>
        <th>Description</th>
        <th>Updated</th>
        <th>Delete</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td class="code">
                {{$category->code }}
        </td>
        <td>{{$category->name }}</td>
        <td >{{$category->description}}</td>
        <td class="count">
            <a href="{{route('admin.update-category-form',['category' => $category->code,])}}">
                <button type="button" class="btn btn-update">UPDATE</button>
            </a>
        </td>
        <td class="count">
            <a href="{{ route('admin.delete-category', ['category' => $category->code,]) }}">
                <button type="button" class="btn btn-delete">DELETE</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection