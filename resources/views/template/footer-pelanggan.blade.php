<footer class="bg-light text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->   
            <a class="btn text-white btn-floating m-1" style="background-color: #299d52;" href="https://api.whatsapp.com/send?phone=6281284139196&text=" target="_blank"  role="button"><i
                class="fa fa-whatsapp"></i></a>
            <!-- Facebook -->
            <a class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="#!" target="_blank" role="button"><i
                    class="fa fa-facebook"></i></a>

            <!-- Twitter -->
            <a class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!" target="_blank"  role="button"><i
                    class="fa fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn text-white btn-floating m-1" style="background-color: #dd4b39;" href="#!" target="_blank" 
                role="button"><i class="fa fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!" target="_blank" 
                role="button"><i class="fa fa-instagram"></i></a>

            {{-- <!-- Linkedin -->
            <a class="btn text-white btn-floating m-1" style="background-color: #0082ca;" href="#!" target="_blank" 
                role="button"><i class="fa fa-linkedin"></i></a>
            <!-- Github -->
            <a class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!" target="_blank" 
                role="button"><i class="fa fa-github"></i></a> --}}
        </section>
        <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white" href="https://dapurdigital.store/">dapurdigital.store</a>
    </div>
    <!-- Copyright -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-6.4829209, 106.8432076], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(map);

    L.marker([-6.4829209, 106.8432076]).addTo(map)
        .bindPopup('Dapur Digital')
        .openPopup();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- include summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 250, //set editable area's height
        });
        new Choices(document.querySelector(".choices-single"));
        
        var satuan = $('#satuan').val();
        if (satuan != 'PCS') {
            $('#form-panjang').show();
            $('#form-lebar').show();
        } else {
            $('#form-panjang').hide();
            $('#form-lebar').hide();
        }
        
    })
</script>


</body>

</html>
