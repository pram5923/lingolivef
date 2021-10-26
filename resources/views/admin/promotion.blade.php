@extends('layouts.main')
@section('content')


<div class="top">
@include('sweetalert::alert')
    <ul>
        <li></li>
        <li>
            <h1 id="text">PROMOTION</h1>
        </li>
        <li>
            <a href="{{route('admin.create-promotion-form')}}">
                <input type="submit" class="new" value="New Promotion">
            </a>
        </li>
    </ul>
</div>

<table class="list">

    <tr>
        <th class=remove>Code</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Updated</th>
        <th>Delete</th>
    </tr>

    @foreach($shops as $shop)
    <tr>
        <td class="code">
            {{$shop->code }}
            </a>
        </td>
        <td>{{$shop->name }}</td>
        <td>{{$shop->price }}</td>
        <td>{{$shop->description}}</td>
        <td class="count">
        <a href="{{route('admin.update-promotion-form',['shop' => $shop->code,])}}">
                <button type="button" class="btn btn-update">UPDATE</button>
            </a>
        </td>
        <td class="count">
            <a href="{{route('admin.delete-promotion',['shop' => $shop->code,])}}">
                <button type="button" class="btn btn-delete">DELETE</button>
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection