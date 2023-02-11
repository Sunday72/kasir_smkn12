<?php
// include "config.php";

$conn = mysqli_connect("localhost", "root", "", "db_kasir");

function editData($data){
    global $conn;
    
    $idproduk1 = htmlspecialchars($data['idproduk1']);
    $kodeproduk1 = htmlspecialchars($data['Edit_Kode_Produk1']);
    $namaproduk1 = htmlspecialchars($data['Edit_Nama_Produk1']);
    $harga_modal1 = htmlspecialchars($data['Edit_Harga_Modal1']);
    $harga_jual1 = htmlspecialchars($data['Edit_Harga_Jual1']);
    $stok = htmlspecialchars($data['stok1']);
    $kategori = htmlspecialchars($data['kategori1']);

    $cekDataUpdate =  mysqli_query($conn, "UPDATE produk SET kode_produk='$kodeproduk1',nama_produk='$namaproduk1',harga_modal='$harga_modal1',harga_jual='$harga_jual1', stok='$stok', kategori='$kategori' WHERE idproduk='$idproduk1'");

    return mysqli_affected_rows($conn);
}