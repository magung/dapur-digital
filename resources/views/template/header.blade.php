<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <title>{{$title}}</title>
    <link rel='icon' href='{{asset('logo.png')}}'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light"  style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{asset('logo.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Dapur Digital</a>
            <div class="d-flex">
                <div class="dropdown ">
                    <a href="#" class="align-items-center text-black text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('/uploads/'.$user->photo )}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">{{ $user->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light text-small shadow">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{route('logout-admin')}}" method="POST">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                            {{-- <a class="dropdown-item" href="#">Logout</a> --}}
                        </li>
                    </ul>
                </div>
            </div>
          </div>
        </div>
      </nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('template.sidebar')
            <div class="col py-3">