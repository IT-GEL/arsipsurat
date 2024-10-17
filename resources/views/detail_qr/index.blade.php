<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Arsip Surat | {{ $detail->nama }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="arsip, surat, dokumen, QR code">
    <meta name="description" content="Detail surat yang terarsip beserta informasi terkait.">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/iconWeb.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap & Libraries -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(to right, #00c6ff, #ffffff);
            color: #333;
            margin: 0;
            padding: 0;
        }

        .hero-header {
            display: grid;
            place-items: center;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
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
            background: url('path/to/your/background-image.jpg') no-repeat center/cover;
            opacity: 0.2;
            z-index: -1;
        }

        .content-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #fff;
    max-width: 100%; /* Limit size */
    overflow-wrap: anywhere; /* Allow breaking at any point */
    word-break: break-word; /* Break long words */
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Add ellipsis for overflowed text */
}

        p {
            font-size: 1rem;
            margin-bottom: 5px;
            color: #fff;
        }

        .btn-primary {
            background: #00c6ff;
            border: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #00c6ff, #ffffff);
            transform: scale(1.05);
        }

        @media (min-width: 768px) {
            h1 {
                font-size: 3.5rem;
            }

            p {
                font-size: 1.5rem;
            }

            .content-container {
                padding: 60px;
            }
        }

        @media (max-width: 576px) {
            .hero-header {
                padding: 30px;
            }

            h1 {
                font-size: 2rem;
            }

            .btn-primary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <div class="container-fluid hero-header">
        <div class="content-container">
            <h1 class="animated slideInDown">
                Surat {{ $detail->nosurat }} <br><br> Signed by
            </h1>
            <div class="animated slideInDown">
                <p>Nama: {{ $detail->nama }}</p>
                <p>NIK: {{ $detail->NIK }}</p>
                <p>Jabatan: {{ $detail->jabatan }}</p>
                <p>Tanggal Approve: {{ \Carbon\Carbon::parse($detail->approve_at)->format('d F Y') }}</p>
            </div>
            <button onclick="closeTab()" class="btn btn-primary py-2 px-4 animated slideInDown">Close</button>
        </div>
    </div>
    <!-- Header End -->

    <script>
        function closeTab() {
            if (window.opener) {
                window.close();
            } else {
                window.location.href = '{{ url()->previous() }}';
            }
        }
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('lib/wow/wow.min.js') }}"></script>
    <script src="{{ url('lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
</body>

</html>
