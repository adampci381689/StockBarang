<?php
session_start();    

//Membuat Koneksi ke Database
$conn = mysqli_Connect("localhost","root","","stockbarang");



//Menambah Barang Baru
if(isset($_POST['Masukanbarangbaru'])){
    $Nama_Barang = $_POST['Nama_Barang'];
    $Deskripsi = $_POST['Deskripsi'];
    $Stock = $_POST['Stock'];
    $Unit = $_POST['Unit'];

    $addtotable = mysqli_query($conn,"insert into stock (Nama_Barang, Deskripsi, Stock, Unit) values('$Nama_Barang','$Deskripsi','$Stock', '$Unit')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location:index.php');
    }
};



//Menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $Penerima_Barang = $_POST['Penerima_Barang'];
    $qty = $_POST['qty'];
    $Unit = $_POST['Unit'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where Id_Barang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['Stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk (Id_Barang, Penerima_Barang, qty, Unit) values('$barangnya', '$Penerima_Barang', '$qty','$Unit')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where Id_Barang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//Menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $Penerima = $_POST['Penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where Id_Barang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['Stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (Id_Barang, Penerima, qty) values('$barangnya', '$Penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where Id_Barang='$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}



//Update Info Barang 
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $Nama_Barang = $_POST['Nama_Barang'];
    $Deskripsi = $_POST['Deskripsi'];

    $update =mysqli_query($conn,"update stock set Nama_Barang='$Nama_Barang', Deskripsi='$Deskripsi' where Id_Barang ='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
    
}

//Mengahpus Barang daru stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus= mysqli_query($conn, "delete from stock where Id_Barang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }

};

//Mengubah Data Barang Masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $Penerima_Barang = $_POST['Penerima_Barang'];
    $qty  = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from stock where Id_Barang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrng = mysqli_query($conn, "select * from masuk where Id_Masuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtyskrng = $qtynya['qty'];

    if($qty>$qtyskrng){
        $selisih = $qty-$qtyskrng;
        $kurangin = $stockskrng - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where Id_Barang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty ='$qty', Penerima_Barang='$Penerima_Barang' where Id_Masuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    } else {
        $selisih = $qtyskrng-$qty;
        $kurangin = $stockskrng + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where Id_Barang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty ='$qty', Penerima_Barang='$Penerima_Barang' where Id_Masuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }
    }
}


//Menghapus Barang Masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where Id_Barang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['Stock'];

    $selisih = $stok-$qty;


    $update = mysqli_query($conn, "update stock set stock='$selisih' where Id_Barang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where Id_Masuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    }   else {
        header('location:masuk.php');
    }
};

//Mengahpus Barang Keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where Id_Barang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['Stock'];

    $selisih = $stok+$qty;


    $update = mysqli_query($conn, "update stock set stock='$selisih' where Id_Barang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where Id_Keluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    }   else {
        header('location:keluar.php');
    }
};

//Menambah Barang Baru
if(isset($_POST['masukanpengajuan'])){
    $Nama_Barang = $_POST['Nama_Barang'];
    $Jumlah_Barang = $_POST['Jumlah_Barang'];
    $Pemohon = $_POST['Pemohon'];
    $Unit = $_POST['Unit'];

    $addtopengajuan = mysqli_query($conn,"insert into pengajuanbarang (Nama_Barang, Jumlah_Barang, Pemohon, Unit) values('$Nama_Barang','$Jumlah_Barang','$Pemohon','$Unit')");

    if($addtopengajuan){
        header('location:PengajuanBarang.php');
    } else {
        echo 'gagal';
        header('location:PengajuanBarang.php');
    }
};


 
//Mengahpus Barang daru stock
if(isset($_POST['pengajuan'])){
    $idp = $_POST['idp'];

    $hapus= mysqli_query($conn, "delete from pengajuanbarang where Id_Pengajuan='$idp'");
    if($hapus){
        header('location:PengajuanBarang.php');
    } else {
        echo 'Gagal';
        header('location:PengajuanBarang.php');
    }

}
?>


