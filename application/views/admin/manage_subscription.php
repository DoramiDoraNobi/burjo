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
                            <a class="nav-link" href="<?php echo site_url('pelanggan') ?>">Data Pengutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo site_url('hutang') ?>">Catatan Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('hutang/history_hutang') ?>">History Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('payment') ?>">Beli Berlangganan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <!-- Dashboard content here -->
                <div class="mt-3 mr-3">
                    <h2>Kelola Subscription Payments</h2>
                    <!-- Table for displaying data -->
                    <div class="mt-4">
                        <table class="table table-bordered table-green">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User_ID</th>
                                    <th>Amount</th>
                                    <th>Payment_Date</th>
                                    <th>Payment_Method</th>
                                    <th>Payment_Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= $payment->ID ?></td>
                                    <td><?= $payment->User_ID ?></td>
                                    <td><?= $payment->Amount ?></td>
                                    <td><?= $payment->Payment_Date ?></td>
                                    <td><?= $payment->Payment_Method ?></td>
                                    <td><?= $payment->Payment_Status ?></td>
                                    <td>
                                        <?php if ($payment->Payment_Status !== 'Accepted'): ?>
                                            <form action="<?= site_url('payment/change_status') ?>" method="post">
                                                <input type="hidden" name="payment_id" value="<?= $payment->ID ?>">
                                                <button type="submit" class="btn btn-success">Accept Payment</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
