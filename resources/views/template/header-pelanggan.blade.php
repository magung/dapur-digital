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
    <style>
        a.deco-none {
            color: #000000 !important;
            text-decoration: none;

        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg  navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top ">
                <b>Dapur Digital</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex  me-2">
                    <div class="dropdown  me-2">
                        <a href="#"
                            class="btn btn-light align-items-center text-black text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-none d-sm-inline mx-1">Kategori</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="/list-product-category/{{ $category->category_id }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <input class="form-control me-2" type="search" placeholder="Cari Produk" aria-label="Search">
                    <button class="btn btn-light" type="submit">Cari</button>
                </form>
                @if ($user != null)
                    <a href="/cart-list" class="btn btn-light me-2">
                        <ion-icon name="cart-outline"></ion-icon>
                    </a>
                    <div class="d-flex">
                        <div class="dropdown ">
                            <a href="#" class="align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/uploads/{{ $user->photo }}" alt="hugenerd" width="30" height="30"
                                    class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">{{ $user->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button class="dropdown-item">Logout</button>
                                    </form>
                                    {{-- <a class="dropdown-item" href="#">Logout</a> --}}
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
