@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('user-update', ['user' => $user->email,]) }}" method="post">
    @csrf
    <table>

        <tr>
            <td><strong>E-mail</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="email" size="80" value="{{ old('email', $user->email) }}" required/></td>
        </tr>

        <tr>
            <td><strong>Name</strong></td>
            <td class="blue">::</td>
            <td><input type="text" name="name"  size="80" value="{{ old('name', $user->name) }}" required/></td>
        </tr>

        <tr>
            <td><strong>Password</strong></td>
            <td class="blue">::</td>
            <td><input type="password" name="password" placeholder="Leave blank if you don't need to edit." size="80"/></td>
        </tr>

        <tr>
            <td><strong>Role</strong></td>
            <td class="blue">::</td>
            <td>
                <select name="role" style="width:100%">
                    <option>-- Plese select --</option>
                    <option value="USER">USER</option>
                    <option value="ADMIN">ADMIN</option>
                </select>
            </td>
        </tr>

        <tr>

    </table>

    <input type="submit" value="Update" class="submit">

</form>

@endsection