@extends('layouts.main')

@section('content')
@include('sweetalert::alert')
<div class="top">
    <ul>
        <li></li>
        <li>
            <h1 id="text">PRODUCT</h1>
        </li>
        <li>
            <a href="{{route('admin.create-product-form')}}">
                <input type="submit" class="new" value="New Product">
            </a>
        </li>
    </ul>
</div>

<table class="list">

    <tr>
        <th class=remove>Code</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Description</th>
        <th>Updated</th>
        <th>Delete</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td class="code">
            <!--<a class="code" href="{{route('admin.product', [
'product' => $product->code,
])}}"> -->
            {{$product->code }}
            </a>
        </td>
        <td>{{$product->name }}</td>

        <td>{{$product->category->name}}</td>
        <td>{{$product->price }}</td>
        <td>{{$product->description}}</td>
        <td class="count">
            <a href="{{route('admin.update-form',['product' => $product->code,])}}">
                <button type="button" class="btn btn-update">UPDATE</button>
            </a>
        </td>
        <td class="count">
            <a href="{{ route('admin.delete', ['product' => $product->code,]) }}">
                <button type="button" class="btn btn-delete">DELETE</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection