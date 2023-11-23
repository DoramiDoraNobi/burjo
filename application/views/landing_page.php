<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Pencatatan Hutang</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #28a745;
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .jumbotron {
            background-color: #28a745;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .jumbotron h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .jumbotron p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .jumbotron .btn {
            background-color: #fff;
            color: #28a745;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .jumbotron .btn:hover {
            background-color: #fff;
            color: #218838;
        }

        .feature-card {
            border: none;
            margin: 20px 0;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-card .card-body {
            text-align: center;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Burjo Hutang</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth/register') ?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-left">
                    <h1>Selamat Datang di Pencatatan Hutang Burjo</h1>
                    <p>Nikmati kemudahan dalam mencatat hutang para pelanggan durjana.</p>
                    <a href="<?php echo site_url('auth/register') ?>" class="btn btn-success btn-lg">Daftar Sekarang</a>
                </div>
                <div class="col-md-6">
                    <img src="<?= base_url('assets/logo/hutang.png')?>" alt="Gambar" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Keuntungan -->
    <div class="container text-center mb-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h5 class="card-title">Pencatatan Mudah</h5>
                        <p class="card-text">Catat hutang dengan mudah dan cepat.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h5 class="card-title">Pantau Hutang</h5>
                        <p class="card-text">Pantau dan kelola hutang dengan efisien.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body">
                        <h5 class="card-title">Pemberitahuan</h5>
                        <p class="card-text">Dapatkan pemberitahuan tentang jatuh tempo hutang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Pencatatan Hutang. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Load Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
