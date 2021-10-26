@extends('layouts.main')

@section('content')
<div class="top">
    <ul>
        <li></li>
        <li>
            <h1 id="text">USERS</h1>
        </li>
        <li>
            <a href="{{route('admin.create-user-form')}}">
                <input type="submit" class="new" value="New User">
            </a>
        </li>
    </ul>
</div>

<table class="list">

    <tr>
        <th class="email">E-mail</th>
        <th>Name</th>
        <th>Role</th>
        <th>Updated</th>
        <th>Delete</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td class="email">
            <!--<a class="code" href="{{route('user-view', [
'user' => $user->email,
])}}">-->
                {{$user->email }}
            </a>
        </td>
        <td>{{$user->name }}</td>
        <td>{{$user->role }}</td>
        <td class="count">
            <a href="{{route('admin.update-user-form', ['user' => $user->email,])}}">
                <button type="button" class="btn btn-update">UPDATE</button>
            </a>
        </td>
        <td class="count">
        <a href="{{route('admin.delete-user', ['user' => $user->email,])}}">
            <button type="button" class="btn btn-delete">DELETE</button>
        </a>
        </td>
    </tr>
    @endforeach
</table>
@endsection