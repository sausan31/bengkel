<?php
include("sess_check.php");
include("dist/function/format_rupiah.php");

$tgl = date('Y-m-d');
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
$dataSend['pagedesc'] = $pagedesc;
$dataSend['haries'] = $haries;
$dataSend['bulans'] = $bulans;
$dataSend['bulans_count'] = $bulans_count;
$dataSend['hari_ini'] = $hari_ini;
$dataSend['bulan_ini'] = $bulan_ini;
$dataSend['tanggal'] = $tanggal;
$dataSend['bulan'] = $bulan;
$dataSend['tahun'] = $tahun;
$dataSend['tgl'] = $tgl;

$data = [];
$kasir = $sess_kasirid;
$grand = 0;
$sql = "SELECT tmp_trx.*, barangjasa.*, kasir.* FROM tmp_trx, barangjasa, kasir WHERE
													tmp_trx.id_brg=barangjasa.id_brg AND tmp_trx.id_kasir=kasir.id_kasir
													AND tmp_trx.status='On Process' AND tmp_trx.id_kasir='$kasir' ORDER BY barangjasa.nama ASC";
$ress = mysqli_query($conn, $sql);
while ($d = mysqli_fetch_array($ress)) {
    $ttl = $d['jml'] * $d['harga'];
    $grand += $ttl;
    $data[] = $d;
}


$konsumen = [];
$sql_brg = "SELECT * FROM konsumen WHERE id_kon!='0' ORDER BY nama_kon ASC";
$ress = mysqli_query($conn, $sql_brg);
while ($d = mysqli_fetch_array($ress)) {
    $konsumen[] = $d;
}

$dataSend['konsumen'] = $konsumen;
$dataSend['data'] = $data;
$dataSend['ttl'] = $grand;


echo json_encode($dataSend);
