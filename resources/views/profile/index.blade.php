
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Arsip Surat | {{ $profiles->name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/iconWeb.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Header Start -->
    <div class="container-fluid hero-header bg-light py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 mb-3 animated slideInDown">Signed by,</h1>
                    <div class="animated slideInDown">
                        <p>Nama : {{ $profiles->name }}</p>
                        <p>NIK: {{ $profiles->NIK }}</p>
                        <p>Jabatan : {{ $profiles->Jabatan }}</p>
                    </div>

                    <button onclick="closeTab()" class="btn btn-primary py-3 px-4 animated slideInDown">Close</button>
                    <script>
                        function closeTab() {
                            
                                window.close(); // Menutup jendela yang dibuka oleh window.open()
                       
                        }
                    </script>


                </div>
            </div>
        </div>
    </div>

<!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('lib/wow/wow.min.js') }}"></script>
    <script src="{{ url('lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('js/main.js') }}"></script>
</body>

</html>
    





    