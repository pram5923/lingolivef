@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('user-create') }}" method="post">
    @csrf
    <table>
    <tr>
            <td><strong>E-mail</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="email" size="80" value="{{ old('email') }}"  required/></td>
        </tr>

        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name" size="80" value="{{ old('name') }}"  required/></td>
        </tr>

        <tr>
            <td><strong>Password</strong></td>
            <td class="blue">::</td>
            <td><input type="password" name="password" size="80" value="{{ old('password') }}"  required/></td>
        </tr>

        <tr>
            <td><strong>Role</strong></td>
            <td class="blue">::</td>
            <td >
                <select name="role" width="80" style="width:100%">
                    <option>-- Plese select --</option>
                    <option value="USER">USER</option>
                    <option value="ADMIN">ADMIN</option>
                </select>
            </td>
        </tr>
    </table>

    <input type="submit" value="Create" class="submit-user"/>
</form>
@endsection