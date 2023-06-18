<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="dropdown pb-4">
            {{-- <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/uploads/{{$user->photo }}" alt="hugenerd" width="30" height="30" class="rounded-circle">
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
            </ul> --}}
        </div>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="/" class="nav-link text-black  align-middle px-0">
                    <ion-icon name="home-outline"></ion-icon> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            @if ($user->role_id == 1)
            <li>
                <a href="#master-data" data-bs-toggle="collapse"  class="nav-link text-black px-0 align-middle">
                    <ion-icon name="server-outline"></ion-icon> <span class="ms-1 d-none d-sm-inline ">Master Data</span> </a>
                <ul class="collapse nav flex-column ms-1 show" id="master-data" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{route('banner.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Banner</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('customer.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Customer</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('user.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">User</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('store.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Toko</span></a>
                    </li>
                    <li>
                        <a href="{{route('category.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Kategori</span></a>
                    </li>
                    <li>
                        <a href="{{route('product.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Produk</span></a>
                    </li>
                    <li>
                        <a href="{{route('payment.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Pembayaran</span></a>
                    </li>
                    <li>
                        <a href="{{route('role.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Role</span></a>
                    </li>
                    <li>
                        <a href="{{route('cutting.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Cutting</span></a>
                    </li>
                    <li>
                        <a href="{{route('finishing.index')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Finishing</span></a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($user->role_id == 1 || $user->role_id == 2)
            <li class="nav-item">
                <a href="/transaction" class="nav-link text-black  align-middle px-0">
                    <ion-icon name="bar-chart-outline"></ion-icon> <span class="ms-1 d-none d-sm-inline">Transaksi</span>
                </a>
            </li>
            @endif
            @if ($user->role_id == 1 || $user->role_id == 3)
            <li class="nav-item">
                <a href="#report" data-bs-toggle="collapse"  class="nav-link text-black px-0 align-middle">
                    <ion-icon name="analytics-outline"></ion-icon> <span class="ms-1 d-none d-sm-inline ">Laporan</span> </a>
                <ul class="collapse nav flex-column ms-1 show" id="report" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{route('report.reportStockProduct')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Laporan Produk</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('report.reportTransaction')}}" class="nav-link text-black px-0"> <ion-icon name="chevron-forward-outline"></ion-icon> <span class="d-none d-sm-inline">Laporan Transaksi</span></a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
        <hr>
       
    </div>
</div>