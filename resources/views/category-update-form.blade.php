@extends('layouts.main')


@section('content')

<form action="{{ route('admin.update-category', ['category' => $category->code,]) }}" method="post">
    @csrf
    <table>
        <tr>
            <td><strong>Code</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="code" value="{{ old('code', $category->code) }}" required />
            <td>
        </tr>

        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name"  value="{{ old('name', $category->name) }}" required" /></td>
        </tr>


        <tr>
            <td class="adress" valign="top"><strong>Description</strong></td>
            <td valign="top" class="blue">::</td>
            <td>
                <textarea name="description" cols="80" rows="10">{{ old('description', $category->description) }}</textarea>
            </td>
        </tr>

        <tr>

    </table>

    <input type="submit" value="Update" class="submit">

</form>

@endsection