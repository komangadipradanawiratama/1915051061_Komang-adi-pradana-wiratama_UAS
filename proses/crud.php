<?php
require 'panggil.php';

// proses tambah
if (!empty($_GET['aksi'] == 'tambah')) {
    $nama = strip_tags($_POST['nama']);
    $telepon = strip_tags($_POST['telepon']);
    $email = strip_tags($_POST['email']);
    $alamat = strip_tags($_POST['alamat']);
    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);
    $image = $_FILES['foto']['name'];
    $target = "../foto/" . basename($image);

    move_uploaded_file($_FILES['foto']['tmp_name'], $target);


    $tabel = 'tbl_user';
    # proses insert
    $data[] = array(
        'username'        => $user,
        'password'        => md5($pass),
        'nama_pengguna'   => $nama,
        'telepon'         => $telepon,
        'email'           => $email,
        'alamat'          => $alamat
                     
    );
    $proses->tambah_data($tabel, $data);
    echo '<script>alert("Tambah Data Berhasil");window.location="../index.php"</script>';
}

// proses edit
if (!empty($_GET['aksi']) && $_GET["aksi"] == 'edit') {
    $nama = strip_tags($_POST['nama']);
    $telepon = strip_tags($_POST['telepon']);
    $email = strip_tags($_POST['email']);
    $alamat = strip_tags($_POST['alamat']);
    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);
    $namaIbu = strip_tags($_POST['nama_ibu']);
    $jk = strip_tags($_POST['jenis_kelamin']);
    $agama = strip_tags($_POST['agama']);

    // jika password tidak diisi
    if ($pass == '') {
        $data = array(
            'username'        => $user,
            'nama_pengguna'    => $nama,
            'telepon'        => $telepon,
            'email'            => $email,
            'alamat'        => $alamat,
            'nama_ibu'      => $namaIbu,
            'jenis_kelamin' => $jk,
            'agama' => $agama,
        );
    } else {

        $data = array(
            'username'        => $user,
            'password'        => md5($pass),
            'nama_pengguna'    => $nama,
            'telepon'        => $telepon,
            'email'            => $email,
            'alamat'        => $alamat,
            'nama_ibu'      => $namaIbu,
            'jenis_kelamin' => $jk,
            'agama' => $agama,
        );
    }
    $tabel = 'tbl_user';
    $where = 'id_login';
    $id = strip_tags($_POST['id_login']);
    $proses->edit_data($tabel, $data, $where, $id);
    echo '<script>alert("Edit Data Berhasil");window.location="../index.php"</script>';
}

// hapus data
if (!empty($_GET['aksi'] == 'hapus')) {
    $tabel = 'tbl_user';
    $where = 'id_login';
    $id = strip_tags($_GET['hapusid']);
    $proses->hapus_data($tabel, $where, $id);
    echo '<script>alert("Hapus Data Berhasil");window.location="../index.php"</script>';
}

// login
if (!empty($_GET['aksi']) && $_GET["aksi"] == 'login') {
    session_start();

    // validasi text untuk filter karakter khusus dengan fungsi strip_tags()
    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);

    // panggil fungsi proses_login() yang ada di class prosesCrud()
    $result = $proses->proses_login($user, $pass);

    if ($result == 'sukses') {
        echo "<script>window.location='../index.php';</script>";
    } else {
        echo "<script>window.location='../login.php?get=gagal';</script>";
    }
}
