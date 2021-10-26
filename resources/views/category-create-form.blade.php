@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('category-create') }}" method="post">
    @csrf

    <table>

        <tr>
            <td><strong>Code</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="code" value="{{ old('code') }}"  required/></td>
        </tr>

        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name" value="{{ old('name') }}"  required/></td>
        </tr>


        <tr>
            <td valign="top"><strong>Description</strong></td>
            <td valign="top" class="blue">::</td>
            <td><textarea name="description" cols="80" rows="10">{{ old('description') }}</textarea></td>



    </table>

    <input type="submit" value="Create" class="submit">

</form>

@endsection