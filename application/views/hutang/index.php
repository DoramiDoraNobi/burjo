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
                            <a class="nav-link" href="<?php echo site_url('auth/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('pelanggan') ?>">Data Pengutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo site_url('hutang') ?>">Catatan Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('hutang/history_hutang') ?>">History Hutang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <!-- Dashboard content here -->
                <div class="mt-3 mr-3">
                    <h2>Hutang</h2>
                    <button class="btn btn-green" data-toggle="modal" data-target="#addHutangModal">Tambah Catatan Hutang</button>

                    <!-- Table for displaying data -->
                    <div class="mt-4">
                        <table class="table table-green">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Jumlah Hutang</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status Pembayaran</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($daftar_hutang as $index => $data) { ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $this->Hutang_model->GetPelanngganbyID($data->id_pelanggan); ?></td>
                                        <td><?php echo $data->jumlah_hutang; ?></td>
                                        <td><?php echo $data->tanggal; ?></td>
                                        <td><?php echo $data->status_pembayaran; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editHutangModal<?php echo $data->id_hutang; ?>">Edit</button>
                                            <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteHutangModal<?php echo $data->id_hutang; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Pelanggan -->
                                    <div class="modal fade" id="editHutangModal<?php echo $data->id_hutang; ?>" tabindex="-1" role="dialog" aria-labelledby="editHutangModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editHutangModalLabel">Edit Hutang</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo site_url('hutang/do_update/'.$data->id_hutang); ?>">
                                                    <input type="hidden" name="id_pemilik" value="<?php echo $data->id_pemilik; ?>">
                                                    <input type="hidden" name="id_hutang" value="<?php echo $data->id_hutang; ?>">
                                                    <input type="hidden" name="tanggal" value="<?php echo $data->tanggal; ?>">
                                                    <div class="form-group">
                                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                                        <select class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                                                            <?php foreach ($list_pelanggan as $pelanggan) { ?>
                                                                <option value="<?php echo $pelanggan->id_pelanggan ?>" <?php echo ($pelanggan->nama_pelanggan == $data->id_pelanggan) ? 'selected' : '' ?>>
                                                                    <?php echo $pelanggan->nama_pelanggan ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jumlah_hutang">Jumlah Hutang</label>
                                                        <input type="text" class="form-control" id="jumlah_hutang" name="jumlah_hutang" value="<?php echo $data->jumlah_hutang; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Status Pembayaran</label>
                                                        <select class="form-control" id="status_pembayaran" name="status_pembayaran">
                                                            <option value="SUDAH">SELESAI</option>
                                                            <option value="BELUM">BELUM</option>
                                                    </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal for Deleting Pelanggan -->
                                    <div class="modal fade" id="deleteHutangModal<?php echo $data->id_hutang; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteHutangModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteHutangModalLabel">Delete Hutang</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this customer?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="<?php echo site_url('hutang/do_delete'); ?>" method="POST">
                                                    <input type="hidden" name="id_hutang" value="<?php echo $data->id_hutang; ?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-green">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   


    <!-- Tambahkan kode modal setelah bagian Load Bootstrap JS -->

<!-- Modal for Adding Pelanggan -->
<div class="modal fade" id="addHutangModal" tabindex="-1" role="dialog" aria-labelledby="addHutangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHutangModalLabel">Tambah Hutang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('hutang/do_create'); ?>" method="POST">
                <div class="form-group">
                    <label for="nama_pelanggan">Pilih Pelanggan</label>
                    <select class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        <?php foreach ($list_pelanggan as $pelanggan) { ?>
                            <option value="<?php echo $pelanggan->id_pelanggan ?>">
                                <?php echo $pelanggan->nama_pelanggan ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="jumlah_hutang">Jumlah Hutang</label>
                        <input type="text" class="form-control" id="jumlah_hutang" name="jumlah_hutang" placeholder="Masukkan Jumlah Hutang">
                    </div><div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal">
                    </div>
                    <!-- Add more fields as needed -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-green">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>


<!-- Modal for Editing Pelanggan -->
<!-- Add similar modal structure for editing pelanggan -->

<!-- Modal for Deleting Pelanggan -->
<!-- Add similar modal structure for deleting pelanggan -->

</body>

</html>
