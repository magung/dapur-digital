@php
    $title = 'Dashboard';
    $user = Auth::guard('customer')->user();
@endphp
@include('template.header-pelanggan')
<br>
<br>


<div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @for ($i = 0; $i < count($banners); $i++)
            @if ($i == 0)
                <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="{{ $i }}"
                    class="active" aria-current="true" aria-label="{{ $banners[$i]->description }}"></button>
            @else
                <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="{{ $i }}"
                    aria-current="true" aria-label="{{ $banners[$i]->description }}"></button>
            @endif
        @endfor
    </div>
    <div class="carousel-inner" role="listbox">
        @for ($i = 0; $i < count($banners); $i++)
            @if ($i == 0)
                <a class="carousel-item active" href="{{$banners[$i]->link}}">
                    
                    <img src="{{ asset('uploads/' . $banners[$i]->photo) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>{{$banners[$i]->description}}</p>
                    </div>
                </a>
            @else
                <a class="carousel-item" href="{{$banners[$i]->link}}">
                    <img src="{{ asset('uploads/' . $banners[$i]->photo) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>{{$banners[$i]->description}}</p>
                    </div>
                </a>
            @endif
        @endfor
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div id="produk_kami"></div>
<br>
<div class="conteiner mt-5 mb-5 container-fluid">
    <h3 class="text-center" >Produk Kami</h3>
    <div class="col-md-8 offset-md-2">
        <!-- Notifikasi menggunakan flash session data -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <br>
    <div class="row row-cols-md-3 row-cols-sm-3 g-2">
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="card">
                    <a href="{{ route('cart.create', $product->product_id) }}">
                        <img src="{{ asset('uploads/' . $product->photo) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">Deskripsi Produk</p>
                        <p class="card-text">Harga Rp. {{ number_format($product->price) }}</p>
                        @if ($user != null)
                            <a href="{{ route('cart.create', $product->product_id) }}" class="btn btn-primary">Tambah
                                ke
                                Keranjang</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="conteiner container-fluid">
    <div class="row">
        <h3 class="text-center">Hubungi Kami</h3>
        {{-- <div class="col-md-12"><a
                href="https://www.google.com/maps/place/Dapur+Digital+Cibinong/data=!3m1!4b1!4m2!3m1!1s0x2e69c16dbc9a9e57:0xe9cb75131f99208b"
                target="_blank" itemprop="hasMap" data-tracking-element-type="7">
                <div class="col-md-12"
                    style="background-image:url('https://maps.googleapis.com/maps/api/staticmap?scale=1&amp;size=1600x900&amp;style=feature:poi.business|visibility:off&amp;style=feature:water|visibility:simplified&amp;style=feature:road|element:labels.icon|visibility:off&amp;style=feature:road.highway|element:labels|saturation:-90|lightness:25&amp;format=jpg&amp;language=id&amp;region=ID&amp;markers=color:0x60a5a5|-6.4829209,106.8432076&amp;zoom=16&amp;client=google-presto&amp;signature=ylh-UZfAZvFgCvMKSrnegfIIXxc')"
                    title="Peta yang menampilkan lokasi bisnis."></div>
            </a>
        </div> --}}
        {{-- <div class="col-md-12"
                style="background-image:url('https://maps.googleapis.com/maps/api/staticmap?scale=1&amp;size=1600x900&amp;style=feature:poi.business|visibility:off&amp;style=feature:water|visibility:simplified&amp;style=feature:road|element:labels.icon|visibility:off&amp;style=feature:road.highway|element:labels|saturation:-90|lightness:25&amp;format=jpg&amp;language=id&amp;region=ID&amp;markers=color:0x60a5a5|-6.4829209,106.8432076&amp;zoom=16&amp;client=google-presto&amp;signature=ylh-UZfAZvFgCvMKSrnegfIIXxc')"
                title="Peta yang menampilkan lokasi bisnis."></div> --}}

        <a href="https://www.google.com/maps/place/Dapur+Digital+Cibinong/data=!3m1!4b1!4m2!3m1!1s0x2e69c16dbc9a9e57:0xe9cb75131f99208b"
            target="_blank" itemprop="hasMap" data-tracking-element-type="7">
            <div id="map" style="height: 400px;">
            </div>
        </a>
    </div>
</div>
<br>
<div class="conteiner container-fluid">
    <div class="row">
        <div class="col-md-3 offset-md-2">
            <h3>Kontak</h3>
            @foreach ($stores as $store)
                <b>{{$store->store_name}}</b><br>
                <p>{{$store->phone_number}}</p>
            @endforeach
        </div>
        <div class="col-md-3">
            <h3>Alamat</h3>
            @foreach ($stores as $store)
                <b>{{$store->store_name}}</b><br>
                <p>{{$store->store_address}}</p>
            @endforeach
        </div>
        <div class="col-md-3">
            <h3 >Jam Buka</h3>
            <table>
                <tr>
                    <td>Senin</td>
                    <td>:</td>
                    <td>09.00–21.00</td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td>:</td>
                    <td>09.00–21.00</td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td>:</td>
                    <td>09.00–21.00</td>
                </tr>
                <tr>
                    <td>Kamis</td>
                    <td>:</td>
                    <td>09.00–21.00</td>
                </tr>
                <tr>
                    <td>Jum'at</td>
                    <td>:</td>
                    <td>09.00–21.00</td>
                </tr>
                <tr>
                    <td>Sabtu</td>
                    <td>:</td>
                    <td>09.00–18.00</td>
                </tr>
                <tr>
                    <td>Minggu</td>
                    <td>:</td>
                    <td>09.00–18.00</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>



<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(window).on('load', function() {
    //     $('#staticBackdrop').modal('show');
    // });
    $(document).ready(function() {
    })
    $('#staticBackdrop').modal('show')
</script> --}}

@include('template.footer-pelanggan')
