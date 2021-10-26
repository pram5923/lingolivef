@extends('layouts.main')

@section('content')
<div class="container">
    <form action="{{ route('admin.create-user') }}" method="post">
        @csrf
        <table>
            <div class="row">
                <div class="col-25">
                    <label for="fname">EMAIL</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">NAME</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Password</label>
                </div>
                <div class="col-75">
                    <input type="password" name="password" value="{{ old('password') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">Role</label>
                </div>
                <div class="col-75">
                <select name="role" width="80" style="width:100%">
                    <option>-- Plese select --</option>
                    <option value="0">USER</option>
                    <option value="1">ADMIN</option>
                </select>
                </div>
            </div>
            <div class="row">
                    <input type="submit" value="New User" >
                </div>
        </table>
    </form>
</div>

@endsection