<?php
include("sess_check.php");

$pagedesc = "Transaksi Baru";
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
$kasir = $sess_kasirid;
$tgl = date('Y-m-d');

if (isset($_POST['simpan'])) {
	$kasir = $sess_kasirid;
	$grand = 0;
	$tg = $tgl;
	$kon = $_POST['kon'];
	$stt = "Done";
	$stts = "On Process";
	$no = date('dmYHis');
	$sql = "SELECT tmp_trx.*, barangjasa.* FROM tmp_trx, barangjasa WHERE tmp_trx.id_brg=barangjasa.id_brg 
		AND tmp_trx.id_kasir='$kasir' AND tmp_trx.status='On Process'";
	$query = mysqli_query($conn, $sql);
	while ($res = mysqli_fetch_array($query)) {
		$ttl = $res['jml'] * $res['harga'];
		$st = $res['stok'];
		$jml = $res['jml'];
		$newst = $st - $jml;
		$br = $res['id_brg'];
		$jns = $res['jenis'];
		if ($jns == 'barang') {
			$sqlbr = "UPDATE barangjasa SET
					stok='" . $newst . "'
					WHERE id_brg='" . $br . "'";
			$ressbr = mysqli_query($conn, $sqlbr);
		} else {
		}
		$grand += $ttl;
	}
	$sqltmp = "UPDATE tmp_trx SET
			id_trx='" . $no . "',
			status='" . $stt . "'
			WHERE id_kasir='" . $kasir . "' AND status='" . $stts . "'";
	$resstmp = mysqli_query($conn, $sqltmp);

	$sqltrx = "INSERT INTO trx(id_trx,id_kon,tgl_trx,total,id_kasir)
		  VALUES('$no','$kon','$tg','$grand','$kasir')";
	$resstrx = mysqli_query($conn, $sqltrx);

	if ($resstrx) {
		echo "<script type='text/javascript'> document.location = '../trx.html'; </script>";
	}
}
