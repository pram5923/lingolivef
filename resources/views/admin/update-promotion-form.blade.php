@extends('layouts.main')

@section('content')
<div class="container">
    <form action="{{ route('admin.update-promotion', ['shop' => $shop->code,]) }}" method="post">
        @csrf
        <table>
            <div class="row">
                <div class="col-25">
                    <label for="fname">CODE</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="code" value="{{ old('code', $shop->code) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="name" value="{{ old('name', $shop->name) }}"required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">PRICE</label>
                </div>
                <div class="col-75">
                    <input type="number" id="fname" name="price" value="{{ old('price', $shop->price) }}"required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="description" placeholder="Write description.." style="height:200px" required>
                    {{ old('description', $shop->description) }}
                    </textarea>
                </div>
                <div class="row">
                    <input type="submit" value="UPDATE">
                </div>
        </table>
    </form>
</div>

@endsection