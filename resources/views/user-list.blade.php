@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{route('user-list') }}" method="get" class="search-box">
    <table class="form-table">
        <tr>
            <td>
                <lable><strong>Search</strong></lable>
            </td>
            <td class="blue">::</td>
            <td><input type="text" name="term" value="{{$search['term']}}"></td>
            <td>
                <button type="submit" class="primary">Search</button>
                <a href="{{ route('user-list')}}">
                    <button type="submit" class="accent">Cancel</button>
                </a>
            </td>
        </tr>
    </table>
</form>

<nav>
    <ul>
        @can('create', \App\Models\User::class)
        <li>
            <a href="{{ route('user-create-form') }}">New User</a>
        </li>
        @endcan
    </ul>
</nav>

{{ $users->withQueryString()->links() }}

<table class="list">

    <tr>
        <th class="email">E-mail</th>
        <th>Name</th>
        <th>Role</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td class="email">
            <a class="code" href="{{route('user-view', [
'user' => $user->email,
])}}">
                {{$user->email }}
            </a>
        </td>
        <td>{{$user->name }}</td>
        <td>{{$user->role }}</td>
    </tr>
    @endforeach
</table>

@endsection