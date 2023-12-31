<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pencatatan Hutang</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- Load Bootstrap JS -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        /* Added styles for the table */
        .table-green {
            background-color: #28a745;
            color: #fff;
        }

        .table-green th,
        .table-green td {
            border-color: #fff;
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
                            <a class="nav-link active" href="<?php echo site_url('pelanggan') ?>">Data Pengutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo site_url('hutang') ?>">Catatan Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo site_url('hutang/history_hutang') ?>">History Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                        </li>
                        <?php if ($this->session->userdata('ses_level') == 'Admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('payment/manage_subscription') ?>">Kelola Berlangganan</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('payment') ?>">Beli Langganan</a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <!-- Dashboard content here -->
                <div class="mt-3 mr-3">
                    
                <div class="mt-4">
                <h2>Konfirmasi Berlangganan</h2>
                        <p>Setelah berlangganan di Catet.in, Anda akan mendapatkan akses ke fitur-fitur premium seperti:</p>
                        <ul>
                            <li>Manajemen Pengutang yang Lebih Komprehensif</li>
                            <li>Analisis Hutang yang Lebih Mendalam</li>
                            <li>Fitur Notifikasi yang Lebih Lanjut</li>
                            <li>Dukungan Pelanggan Prioritas</li>
                        </ul>
                        <p>Untuk melakukan konfirmasi pembayaran, silakan mentransfer ke nomor bank berikut:</p>
                        <p><strong>Bank: Contoh Bank</strong></p>
                        <p><strong>Nomor Rekening: 1234567890</strong></p>
                        <p><strong>Atas Nama: Catet.in</strong></p>
                    <h2>Konfirmasi Berlangganan</h2>
                    <form action="<?php echo site_url('payment/process_payment_confirmation') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="payment_date">Payment Date:</label>
                            <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Method:</label>
                            <input type="text" class="form-control" id="payment_method" name="payment_method" required>
                        </div>
                        <div class="form-group">
                            <label for="payment_proof">Payment Proof (Screenshot/Foto):</label>
                            <input type="file" class="form-control-file" id="payment_proof" name="payment_proof" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-green">Submit</button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
