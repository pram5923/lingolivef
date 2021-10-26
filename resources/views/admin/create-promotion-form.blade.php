@extends('layouts.main')

@section('content')
<div class="container">
    <form action="{{ route('admin.create-promotion') }}" method="post">
        @csrf
        <table>
            <div class="row">
                <div class="col-25">
                    <label for="fname">CODE</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="code" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Price</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="price" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Description</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="description" placeholder="Write description.." style="height:200px" required></textarea>
                </div>
                <div class="row">
                    <input type="submit" value="New Promotion" >
                </div>
        </table>
    </form>
</div>

@endsection