<?php
// session start

if (!empty($_SESSION));
require 'proses/panggil.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Daftar Mahasiswa PTI Semester 1</title>
    <!-- BOOTSTRAP 4-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!-- DATATABLES BS 4-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <!-- DATATABLES BS 4-->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP 4-->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>
<style>
    .sidenav {
        height: 100%;
        width: 160px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: white;
        display: block;
    }

    .sidenav a:hover {
        color: white;
        background-color: #1e1e1e;
        cursor: pointer;
    }

    .sidenav a:active,
    .sidenav a:visited {
        color: white;
    }
</style>

<body style="background:#586df5;">
    <div class="sidenav">
        <a style="color: white;" id="home" selected='true'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            <u>Home</u></a>
        <a style="color: white;" id='bio' selected='false'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
            Biodata</a>
    </div>
    <div class="container">
    </div>
    <script>
        $('#mytable').dataTable();
        $(document).ready(function() {
            $(".container").html(`<div class="row">
            <div class="col-lg-12">
                <?php if (!empty($_SESSION['ADMIN'])) { ?>
                    <br />
                    <span style="color:#fff" ;>Selamat Datang, <?php echo $sesi['nama_pengguna']; ?></span>
                    <a href="logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    <br /><br />
                    <a href="tambah.php" class="btn btn-success btn-md"><span class="fa fa-plus"></span> Tambah</a>
                    <br /><br />
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="mytable" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Foto</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $hasil = $proses->tampil_data('tbl_user');
                                    foreach ($hasil as $isi) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi['nama_pengguna'] ?></td>
                                            <td><?php echo $isi['telepon']; ?></td>
                                            <td><?php echo $isi['email']; ?></td>
                                            <td><?php echo $isi['alamat']; ?></td>
                                            <td><?php echo $isi['username']; ?></td>
                                            <td>****</td>
                                            <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
                                            <td>
                                            <td><?php echo $isi['Foto']; ?></td>
                                            <td style="text-align: center;">
                                                <a href="edit.php?id=<?php echo $isi['id_login']; ?>" class="btn btn-success btn-md">
                                                    <span class="fa fa-edit"></span></a>
                                                <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="proses/crud.php?aksi=hapus&hapusid=<?php echo $isi['id_login']; ?>" class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <br />
                    <div class="alert alert-info">
                        <h3> Maaf Anda Belum Dapat Akses CRUD, Silahkan Login Terlebih Dahulu !</h3>
                        <hr />
                        <p><a href="login.php">Login Disini</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>`);
        });
        $("body").on("click", "#home", function() {
            $(".sidenav").html(`<a style="color: white;" id="home" selected='true'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            <u>Home</u></a>
        <a style="color: white;" id='bio' selected='false'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
            Biodata</a>`);

            $(".container").html(`<div class="row">
            <div class="col-lg-12">
                <?php if (!empty($_SESSION['ADMIN'])) { ?>
                    <br />
                    <span style="color:#fff" ;>Selamat Datang, <?php echo $sesi['nama_pengguna']; ?></span>
                    <a href="logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    <br /><br />
                    <a href="tambah.php" class="btn btn-success btn-md"><span class="fa fa-plus"></span> Tambah</a>
                    <br /><br />
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="mytable" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Foto</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $hasil = $proses->tampil_data('tbl_user');
                                    foreach ($hasil as $isi) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $isi['nama_pengguna'] ?></td>
                                            <td><?php echo $isi['telepon']; ?></td>
                                            <td><?php echo $isi['email']; ?></td>
                                            <td><?php echo $isi['alamat']; ?></td>
                                            <td><?php echo $isi['username']; ?></td>
                                            <td>****</td>
                                            <td style="text-align: center;"><img src="foto/<?php echo $row['foto']; ?>" style="width: 120px;"></td>
                                            <td>
                                            <td><?php echo $isi['Foto']; ?></td>
                                            <td style="text-align: center;">
                                                <a href="edit.php?id=<?php echo $isi['id_login']; ?>" class="btn btn-success btn-md">
                                                    <span class="fa fa-edit"></span></a>
                                                <a onclick="return confirm('Apakah yakin data akan di hapus?')" href="proses/crud.php?aksi=hapus&hapusid=<?php echo $isi['id_login']; ?>" class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <br />
                    <div class="alert alert-info">
                        <h3> Maaf Anda Belum Dapat Akses CRUD, Silahkan Login Terlebih Dahulu !</h3>
                        <hr />
                        <p><a href="login.php">Login Disini</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>`);
        });
        $("body").on("click", "#bio", function() {
            $(".sidenav").html(`<a style="color: white;" id="home" selected='true'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            Home</a>
        <a style="color: white;" id='bio' selected='false'>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
            <u>Biodata </u></a>`);

            $(".container").html(`<div class='card' style='margin-top: 10vh;'>
            <div class='card-header'><h4>Biodata</h4>
            <div style='text-align: right;'>
                <a href="edit.php?id=<?php echo $sesi['id_login']; ?>" class="btn btn-primary btn-md"> Edit Data </a>
            </div>
            </div>
            <div class='card-body'>
            <table class="table table-hover table-bordered"> 
                <tbody>
                    <tr>
                        <td> NIM </td>
                        <td> <?= $sesi['NIM'] ?></td>
                    </tr>
                    <tr>
                        <td> Username </td>
                        <td> <?= $sesi['username'] ?></td>
                    </tr>
                    <tr>
                        <td> Nama Pengguna </td>
                        <td> <?= $sesi['nama_pengguna'] ?></td>
                    </tr>
                    <tr>
                        <td> Jenis Kelamin </td>
                        <td> <?= $sesi['jenis_kelamin'] ?></td>
                    </tr>
                    <tr>
                        <td> Agama </td>
                        <td> <?= $sesi['agama'] ?></td>
                    </tr>
                    <tr>
                        <td> Nama Ibu Kandung </td>
                        <td> <?= $sesi['nama_ibu'] ?></td>
                    </tr>
                    <tr>
                        <td> Nomor KTP </td>
                        <td> <?= $sesi['KTP'] ?></td>
                    </tr>
                    <tr>
                        <td> Fakultas </td>
                        <td> <?= $sesi['fakultas'] ?></td>
                    </tr>
                    <tr>
                        <td> Jurusan / Prodi </td>
                        <td> <div><?= $sesi['jurusan'] ?></div>
                            <div><?= $sesi['prodi'] ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td> No Telepon / HP </td>
                        <td> <?= $sesi['telepon'] ?></td>
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td> <?= $sesi['email'] ?></td>
                    </tr>
                    <tr>
                        <td> Alamat </td>
                        <td> <?= $sesi['alamat'] ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>`);
        });
    </script>
</body>

</html>