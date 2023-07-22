<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Alamat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5 mb-5">
        <h1 class="display-4">
            Tambah Alamat
        </h1>
        <div class="row">
            <div class="col-md-12">

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

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('customer.address.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="form-group">
                                <label for="name">Nama Alamat</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" required>

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contact_name">Nama Kontak</label>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror"
                                    name="contact_name" required>

                                <!-- error message untuk contact_name -->
                                @error('contact_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="contact_phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                    name="contact_phone" required>

                                <!-- error message untuk contact_phone -->
                                @error('contact_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="province">Provinsi:</label>
                                <select id="province" name="province" class="form-control @error('province') is-invalid @enderror" onchange="getRegencies()"
                                    required>
                                    <option value="">Pilih Provinsi</option>
                                </select>
                                <!-- error message untuk province -->
                                @error('province')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="regency">Kota/Kabupaten:</label>
                                <select id="regency" name="regency" class="form-control @error('regency') is-invalid @enderror" onchange="getDistricts()"
                                    required>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                                <!-- error message untuk regency -->
                                @error('regency')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="district">Kecamatan:</label>
                                <select id="district" class="form-control" onchange="getVillages()" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="village">Kelurahan/Desa:</label>
                                <select id="village" class="form-control" required>
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>

                            <input type="hidden" id="address" name="address">
                            <input type="hidden" id="search_place" name="search_place">


                            <div class="form-group">
                                <label for="postal_code">Kode POS</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                                    name="postal_code" required>

                                <!-- error message untuk postal_code -->
                                @error('postal_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="note">Catatan</label>
                                <input type="text" class="form-control @error('note') is-invalid @enderror"
                                    name="note" required>

                                <!-- error message untuk note -->
                                @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-md btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- include summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 250, //set editable area's height
            });
            // Fetch provinces
            $.get("/get-provinces", function(data) {
                var provinceSelect = $("#province");
                provinceSelect.empty();
                provinceSelect.append('<option value="">Pilih Provinsi</option>');

                $.each(data, function(index, province) {
                    provinceSelect.append('<option value="' + province.id + '">' + province.name +
                        '</option>');
                });
            });

            // Fetch regencies based on selected province
            $("#province").change(function() {
                var provinceId = $(this).val();
                var regencySelect = $("#regency");
                var districtSelect = $("#district");
                var villageSelect = $("#village");

                regencySelect.empty();
                regencySelect.append('<option value="">Pilih Kota/Kabupaten</option>');
                districtSelect.empty();
                districtSelect.append('<option value="">Pilih Kecamatan</option>');
                villageSelect.empty();
                villageSelect.append('<option value="">Pilih Kelurahan/Desa</option>');

                if (provinceId) {
                    $.get("/get-regencies/" + provinceId, function(data) {
                        $.each(data, function(index, regency) {
                            regencySelect.append('<option value="' + regency.id + '">' +
                                regency.name + '</option>');
                        });
                    });

                    // Set province name
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName);
                    $("#search_place").val(provinceName);
                } else {
                    $("#address").val("");
                    $("#search_place").val("");
                }
            });

            // Fetch districts based on selected regency
            $("#regency").change(function() {
                var regencyId = $(this).val();
                var districtSelect = $("#district");
                var villageSelect = $("#village");

                districtSelect.empty();
                districtSelect.append('<option value="">Pilih Kecamatan</option>');
                villageSelect.empty();
                villageSelect.append('<option value="">Pilih Kelurahan/Desa</option>');

                if (regencyId) {
                    $.get("/get-districts/" + regencyId, function(data) {
                        $.each(data, function(index, district) {
                            districtSelect.append('<option value="' + district.id + '">' +
                                district.name + '</option>');
                        });
                    });

                    // Set regency name
                    var regencyName = $("#regency option:selected").text();
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName + ", " + regencyName);
                    $("#search_place").val(regencyName + ", " + provinceName);
                } else {
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName);
                    $("#search_place").val(provinceName);
                }
            });

            // Fetch villages based on selected district
            $("#district").change(function() {
                var districtId = $(this).val();
                var villageSelect = $("#village");

                villageSelect.empty();
                villageSelect.append('<option value="">Pilih Kelurahan/Desa</option>');

                if (districtId) {
                    $.get("/get-villages/" + districtId, function(data) {
                        $.each(data, function(index, village) {
                            villageSelect.append('<option value="' + village.id + '">' +
                                village.name + '</option>');
                        });
                    });

                    // Set district name
                    var districtName = $("#district option:selected").text();
                    var regencyName = $("#regency option:selected").text();
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName + ", " + regencyName + ", " + districtName);
                    $("#search_place").val(districtName + ", " + regencyName + ", " + provinceName);
                } else {
                    var regencyName = $("#regency option:selected").text();
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName + ", " + regencyName);
                    $("#search_place").val(regencyName + ", " + provinceName);
                }
            });

            $("#village").change(function() {
                var villageId = $(this).val();
                if(villageId) {
                    var districtName = $("#district option:selected").text();
                    var regencyName = $("#regency option:selected").text();
                    var provinceName = $("#province option:selected").text();
                    var villageName = $("#village option:selected").text();
                    $("#address").val(provinceName + ", " + regencyName + ", " + districtName + ", " + villageName);
                }else{
                    // Set district name
                    var districtName = $("#district option:selected").text();
                    var regencyName = $("#regency option:selected").text();
                    var provinceName = $("#province option:selected").text();
                    $("#address").val(provinceName + ", " + regencyName + ", " + districtName);
                }
            });
        })
    </script>

</body>

</html>
