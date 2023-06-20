<?php
include("sess_check.php");

// deskripsi halaman
$pagedesc = "Transaksi Baru";
$menuparent = "transaksi";
if (isset($_POST['simpan'])) {
	$brg = $_POST['brg'];
	$jumlah = $_POST['jumlah'];
	$stt = "On Process";
	$id = $sess_kasirid;
	$null = "";
	$sql = "SELECT * FROM barangjasa WHERE id_brg='$brg'";
	$query = mysqli_query($conn, $sql);
	$res = mysqli_fetch_array($query);
	$stok = $res['stok'];
	if ($stok < $jumlah) {
		echo "<script>alert('Stok kurang dari jumlah yang diinginkan!');</script>";
		echo "<script type='text/javascript'> document.location = '../tmp_tambah.html'; </script>";
	} else {
		$sqli = "INSERT INTO tmp_trx(id_trx,id_brg,jml,id_kasir,status)VALUES('$null','$brg','$jumlah','$id','$stt')";
		$ressi = mysqli_query($conn, $sqli);
		echo "<script type='text/javascript'> document.location = '../trx_baru.html'; </script>";
	}
}
