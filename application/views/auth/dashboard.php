<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pencatatan Hutang</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            color: #333;
        }

        .sidebar {
            background-color: #fff;
            border-right: 1px solid #ddd;
            height: 100vh;
        }

        .active {
            background-color: #28a745;
            color: #fff;
        }

        .btn-green {
            background-color: #28a745;
            color: #fff;
        }

        .btn-green:hover {
            background-color: #218838;
            color: #fff;
        }

        .btn-green:focus {
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.5);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <!-- Sidebar content here -->
                <div class="mt-3 ml-3">
                    <h5>Menu</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('auth/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('pelanggan') ?>">Data Pengutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('hutang') ?>">Catatan Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('hutang/history_hutang') ?>">History Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('payment') ?>">Beli Berlangganan</a>
                        </li>
                        <?php if ($this->session->userdata('ses_level') == 'Admin') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url('payment/manage_subscription') ?>">Kelola Berlangganan</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <!-- Dashboard content here -->
                <div class="mt-3 mr-3">
                    <h2>Catatan Hutang</h2>
                    <p>Selamat datang di aplikasi pencatatan hutang.</p>
                    <button class="btn btn-green">Tambah Catatan Hutang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
