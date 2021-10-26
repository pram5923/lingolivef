<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6749ec7941.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>

<body>
    <header>


    </header>
    <div class="sidenav">
        <form action="{{ route('product.list') }}" method="get" class="search-form">
            <ul>
                <li><i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search" name="term" value="{{$search['term']}}">
                </li>
                <li><i class="fas fa-home"></i><a href="{{ route('product.list')}}">HOME</a></li>
                <li><i class="fas fa-gamepad"></i>GAME
                    <ul class="list-category" name="term" value="{{$search['term']}}">
                            @foreach($categories as $category)
                            <li value="{{$category->code }}" {{ ($category->code === old('category'))? ' selected' : '' }} >
                                 {{ $category->name }}
                            </li>
                            @endforeach
                        </select>
                    </ul>
                </li>
                <li><i class="fas fa-tags"></i>PROMOTION</li>
                @can('create', \App\Models\User::class)
                <li><i class="fas fa-user-edit"></i></i><a href="{{ route('admin.product')}}">EDIT</a></li>
                @endcan
            </ul>
        </form>

        <div class="login">
            <ul>
                <li><button type="submit" class="btn btn-login">LOGIN</button></li>
                <li><button type="submit" class="btn btn-register"><a href="{{route('admin.home') }}">LOGOUT</a></button></li>
            </ul>

        </div>
    </div>

    <div class="main">

        <div class="grid-container">
            @foreach($products as $product)
            <div class="grid-item">
                <div class="box-up">
                    <img class="product-img" src="{{ asset('images/products/'.$product['code'].'.jpg')}}" />
                    <div class="product-text">
                        <div class="info-inner">
                            <h1>{{$product->name}}</h1>
                        </div>
                    </div>
                    <div class="description">{{$product->description}}</div>
                </div>
                <div class="box-down">
                    <div class="h-bg">
                        <div class="h-bg-inner"></div>
                    </div>

                    <a class="cart" href="#">
                        <span class="price">{{$product->price}}</span>
                        <span class="add-to-cart">
                            <span class="txt">Add in cart</span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div> ​
    </div>
</body>