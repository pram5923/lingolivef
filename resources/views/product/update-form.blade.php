@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('product-update', ['product' => $product->code,]) }}" method="post">
    @csrf
    <table>
        <tr>
            <td><strong>Code</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="code" value="{{ old('code', $product->code) }}" required />
            <td>
        </tr>

        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name" value="{{ old('name', $product->name) }}" required /></td>
        </tr>

        <tr>
            <td><strong>Category</strong></td>
            <td class="blue">::</td>
            <td>
                <select name="category_id">

                    <option>-- Plese select category --</option>
                    @foreach($categories as $category)

                    <option value="{{$category->code }}"
                        {{ ($category->code === old('category', $product->category->code))?
                            ' selected' : '' }}>
                            [{{ $category->code }}] {{ $category->name }}
                    </option>

                    @endforeach

                </select>
            </td>
        </tr>

        <tr>
            <td><strong>Price</strong></td>
            <td class="blue">::</td>
            <td><input type="number" step="any" name="price" value="{{ old('price', $product->price) }}" required /></td>
        </tr>

        <tr>
            <td class="adress" valign="top"><strong>Description</strong></td>
            <td valign="top" class="blue">::</td>
            <td>
                <textarea name="description" cols="80" rows="10">{{old('description', $product->description) }}</textarea>
            </td>
        </tr>

        <tr>

    </table>

    <input type="submit" value="Update" class="submit">

</form>

@endsection