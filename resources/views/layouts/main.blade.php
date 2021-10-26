<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header')</title>
    <link rel="stylesheet" href="{{asset('/css/styleadmin.css')}}">

</head>

<body>
    <header>
        <h1>@yield('header')</h1>
    </header>
   <!-- @auth
    <nav class="user-panel" align="canter">
        <span>{{ \Auth::user()->name }}</span>
        <a href="{{route('logout') }}">Logout</a>
    </nav>
    @endauth -->
    <nav class="menu">
        <div class="home">
            <ul>
                <li><a href="{{route('product.list')}}">Home Page</a></li></li>
            </ul>
        </div>
        <ul>
            <li><a href="{{route('admin.product')}}">Product</a></li>
            <li><a href="{{route('admin.category')}}">Category</a></li>
            <li><a href="{{route('admin.promotion')}}">Promotion</a></li>
            <li><a href="{{route('admin.user')}}">User</a></li>
        </ul>
    </nav>
    <main>
        @if(session()->has('status'))
        <div class="status">
            <span class="info">{{session()->get('status') }}</span>
        </div>
        @endif
        {{--after status message --}}
        @error('error')
        <div class="status">
            <span class="warn">{{$message}}</span>
        </div>
        @enderror
        @yield('content')
    </main>

    <footer>
        
    </footer>

</body>

</html>