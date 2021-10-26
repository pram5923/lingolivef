@extends('layouts.main')

@section('header', $title)

@section('content')
<nav>
        <ul>
                <li><a href="{{route('shop-view-product', [
'shop' => $shop->code,
])}}">Show Product</a></li>
@can('update', \App\Models\Shop::class)
                <li>
                        <a href="{{ route('shop-update-form', [
'shop' => $shop->code,
]) }}">Update</a>
</li>
@endcan
@can('delete', \App\Models\Shop::class)
                <li>
                        <a href="{{ route('shop-delete', [
'shop' => $shop->code,
]) }}">Delete</a>
                </li>
@endcan
                <li>
                        <a href="{{session()->get('bookmark.shop-view', route('shop-list'))}}">&lt; Back</a>
                </li>
        </ul>
</nav>

<table class="shop">
        <tr>
                <td><strong>Code</strong></td>
                <td class="blue">::</td>
                <td>{{$shop['code']}}</td>
        </tr>

        <tr>
                <td><strong>Name</strong></td>
                <td class="blue">::</td>
                <td class="name">{{$shop['name']}}</td>
        </tr>

        <tr>
                <td><strong>Owner</strong></td>
                <td class="blue">::</td>
                <td>{{$shop['owner']}}</td>
        </tr>

        <tr>
                <td><strong>Location</strong></td>
                <td class="blue">::</td>
                <td>{{$shop['latitude']}} , {{$shop['longitude']}}</td>
        </tr>

        <tr>
                <td class="adress" valign="top"><strong>Address</strong></td>
                <td class="blue adress" valign="top">::</td>
                <td class="adress">
                        <pre class="shop-ad">{{$shop['address']}}</pre>
                </td>
        </tr>
</table>

@endsection