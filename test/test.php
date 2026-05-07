<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'tambah-buku':
            include 'Tambah-buku.php';
            break;
        case 'tampilan-buku':
            include 'Tampilkan-buku.php';
            break;
        case 'tambah-anggota':
            include 'Tambah-bukup.php';
            break;
        case 'tampilan-anggota':
            include 'Tampil-anggota.php';
        default:
            echo "<script>alert('Data Tidak Tersedia');</script>";
    }
}
?>