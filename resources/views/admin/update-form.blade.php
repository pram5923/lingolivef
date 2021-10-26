@extends('layouts.main')

@section('content')
<div class="container">
    <form action="{{ route('admin.update', ['product' => $product->code,]) }}" method="post">
        @csrf
        <table>
            <div class="row">
                <div class="col-25">
                    <label for="fname">CODE</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="code" value="{{ old('code', $product->code) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="name" value="{{ old('namr', $product->name) }}"required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Category</label>
                </div>
                <div class="col-75">
                    <select name="category_id">
                        <option>-- Plese select category --</option>

                        @foreach($categories as $category)

                        <option value="{{$category->code }}" {{ ($category->code === old('category'))? ' selected' : '' }}>
                            [{{ $category->code }}] {{ $category->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Price</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="price" value="{{ old('price', $product->price) }}"required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="description" placeholder="Write description.." style="height:200px" required>
                    {{ old('description', $product->description) }}
                    </textarea>
                </div>
                <div class="row">
                    <input type="submit" value="UPDATE">
                </div>
        </table>
    </form>
</div>

@endsection