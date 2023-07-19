<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <title>{{ $title }}</title>
    <link rel='icon' href='logo.png'>
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <style>
        a.deco-none {
            color: #000000 !important;
            text-decoration: none;

        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg  navbar-dark bg-primary ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('logo.png') }}" alt="" width="30" height="24"
                    class="d-inline-block align-text-top ">
                <b>Dapur Digital</b></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @if ($title == 'Dashboard')
                    <form class="col-12 col-lg-6" action="{{ route('product-list') }}" method="GET">
                        <div class="row ">
                            <div class="col-10">
                                <select name="product_name" class="custom-select choices-single">
                                    <option value="">Cari Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->product_name }}">
                                            {{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 d-flex">
                                <button class="btn btn-light" type="submit">
                                    <ion-icon name="search-outline"></ion-icon> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                {{-- <a href="{{route('cart.list')}}" class="btn btn-light me-2">
                    <ion-icon name="cart-outline"></ion-icon>
                </a>     --}}
                @if ($user != null)
                    <div class="d-flex">
                        <div class="dropdown "  style="min-width: 150px">
                                <a href="#" class=" align-items-center text-white text-decoration-none dropdown-toggle "
                                    id="dropdownUser1"  data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('/uploads/' . $user->photo) }}" alt="hugenerd" width="30"
                                        height="30" class="rounded-circle">
                                    <span class="d-none d-sm-inline mx-1">{{ $user->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-light text-small shadow dropdown-menu-left">
                                    <li><a class="dropdown-item" href="{{ route('profile-customer.index') }}">
                                            <ion-icon name="person-outline"></ion-icon> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('cart.list') }}">
                                            <ion-icon name="cart-outline"></ion-icon> Keranjang
                                        </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('transaction.customer.index') }}">
                                            <ion-icon name="basket-outline"></ion-icon> Transaksi
                                        </a></li>
                                        <hr class="dropdown-divider">
                                    <li><a class="dropdown-item" href="{{ route('customer.address') }}">
                                        <ion-icon name="location-outline"></ion-icon> Alamat
                                        </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button class="dropdown-item">
                                                <ion-icon name="log-out-outline"></ion-icon> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                        </div>
                    </div>
                @endif

                @if ($user == null)
                    <div class="d-flex">
                        <a class="btn btn-light  me-2" href="/login">Login</a>
                        <a class="btn btn-dark" href="/register">Register</a>
                    </div>
                @endif
            </div>
        </div>


        </div>
        </div>
    </nav>
