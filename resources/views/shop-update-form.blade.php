@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('shop-update', ['shop' => $shop->code,]) }}" method="post">
        @csrf

        <table>
                <tr>
                        <td><strong>Code</strong></td>
                        <td class="blue">::</td>
                        <td><input type="text" name="code"  value="{{ old('code', $shop->code) }}" required /></td>
                </tr>

                <tr>
                        <td><strong>Name</strong></td>
                        <td class="blue">::</td>
                        <td><input type="text" name="name" value="{{ old('name', $shop->name) }}" required /></td>
                </tr>

                <tr>
                        <td><strong>Owner</strong></td>
                        <td class="blue">::</td>
                        <td><input type="text" name="owner" value="{{ old('owner', $shop->owner) }}" required /></td>
                </tr>

                <tr>
                        <td><strong>Latitude</strong></td>
                        <td class="blue">::</td>
                        <td><input type="number" name="latitude"  value="{{ old('latitude', $shop->latitude) }}" required /></td>
                </tr>

                <tr>
                        <td><strong>Longitude</strong></td>
                        <td class="blue">::</td>
                        <td><input type="number" name="longitude"  value="{{ old('longitude', $shop->longitude) }}" required /></td>
                </tr>

                <tr>
                        <td class="adress" valign="top"><strong>Address</strong></td>
                        <td class="blue adress" valign="top">::</td>
                        <td class="adress"><textarea name="address" cols="80" rows="10">{{ old('address', $shop->address) }}</textarea></td>
                </tr>
        </table>

        <input type="submit" value="Update" class="submit">

</form>
@endsection