<?php
	include("sess_check.php");
	include("dist/function/format_rupiah.php");

	$tgl = date('Y-m-d');
	$ttl=0;
	$sql = "SELECT * FROM trx WHERE tgl_trx='$tgl'";
	$ress = mysqli_query($conn, $sql);
	$jmltrx = mysqli_num_rows($ress);
	// query database mencari data admin
	while($data=mysqli_fetch_array($ress)){
		$tot=$data['total'];
		$ttl+=$tot;
	}
	// deskripsi halaman
	$pagedesc = "Beranda";
	// include("layout_top.php");

	// setting tanggal
	$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
	$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$bulans_count = count($bulans);
	// tanggal bulan dan tahun hari ini
	$hari_ini = $haries[date("l")];
	$bulan_ini = $bulans[date("n")];
	$tanggal = date("d");
	$bulan = date("m");
	$tahun = date("Y");

	$dataSend = [];
	$dataSend['chk_sess'] = $chk_sess;
	$dataSend['sess_kasirid'] = $sess_kasirid;
	$dataSend['sess_kasiruser'] = $sess_kasiruser;
	$dataSend['sess_kasirname'] = $sess_kasirname;
	$dataSend['sess_kasirfoto'] = $sess_kasirfoto;
	$dataSend['jmltrx'] = $jmltrx;
	$dataSend['ttl'] = format_rupiah($ttl);
	$dataSend['pagedesc'] = $pagedesc;
	$dataSend['haries'] = $haries;
	$dataSend['bulans'] = $bulans;
	$dataSend['bulans_count'] = $bulans_count;
	$dataSend['hari_ini'] = $hari_ini;
	$dataSend['bulan_ini'] = $bulan_ini;
	$dataSend['tanggal'] = $tanggal;
	$dataSend['bulan'] = $bulan;
	$dataSend['tahun'] = $tahun;

	echo json_encode($dataSend);
?>