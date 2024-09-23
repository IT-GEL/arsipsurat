<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Arsip Surat | {{ $detail->nama }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="arsip, surat, dokumen, QR code" name="keywords">
    <meta content="Detail surat yang terarsip beserta informasi terkait." name="description">

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

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(to right, #00c6ff, #ffffff);
            color: #333;
        }

        .hero-header {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .hero-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('path/to/your/background-image.jpg') no-repeat center center/cover;
            opacity: 0.3;
            z-index: -1;
        }

        .hero-header h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .hero-header p {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #fff;
        }

        .btn-primary {
            background: #00c6ff;
            border: none;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #00c6ff, #ffffff);
            transform: scale(1.05);
        }

        .animated {
            animation-duration: 1.5s;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #00c6ff;
        }
    </style>
</head>

<body>

    <!-- Header Start -->
<!-- Header Start -->
<div class="container-fluid hero-header py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 mb-4 animated slideInDown">Surat {{ $detail->nosurat }} Signed by,</h1>
                <div class="animated slideInDown">
                    <p>Nama: {{ $detail->nama }}</p>
                    <p>NIK: {{ $detail->NIK }}</p>
                    <p>Jabatan: {{ $detail->jabatan }}</p>
                    <p>Tanggal Approve: {{ \Carbon\Carbon::parse($detail->approve_at)->format('d F Y') }}</p>
                </div>

                <button onclick="closeTab()" class="btn btn-primary py-3 px-4 animated slideInDown">Close</button>
                <script>
                    function closeTab() {
                        // Use a fallback redirect if window.close() doesn't work
                        if (window.opener) {
                            window.close();
                        } else {
                            window.location.href = '{{ url()->previous() }}'; // Redirect to the previous page
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>

    <!-- Header End -->

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
