<?php
include("sess_check.php");
// deskripsi halaman
$pagedesc = "Data Supplier";
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");

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
$dataSend['pagedesc'] = $pagedesc;
$dataSend['chk_sess'] = $chk_sess;
$dataSend['sess_admid'] = $sess_admid;
$dataSend['sess_admuser'] = $sess_admuser;
$dataSend['sess_admname'] = $sess_admname;
$dataSend['sess_admfoto'] = $sess_admfoto;
$dataSend['pagedesc'] = $pagedesc;
$dataSend['haries'] = $haries;
$dataSend['bulans'] = $bulans;
$dataSend['bulans_count'] = $bulans_count;
$dataSend['hari_ini'] = $hari_ini;
$dataSend['bulan_ini'] = $bulan_ini;
$dataSend['tanggal'] = $tanggal;
$dataSend['bulan'] = $bulan;
$dataSend['tahun'] = $tahun;
$dataSend['tgl'] = date('Y-m-d');

$barang = [];
$sql_brg = "SELECT * FROM barangjasa WHERE jenis='barang' ORDER BY nama ASC";
$ress_brg = mysqli_query($conn, $sql_brg);
while ($li = mysqli_fetch_array($ress_brg)) {
    $barang[] = $li;
}
$supplier = [];
$sql_don = "SELECT * FROM supplier ORDER BY nama_spl ASC";
$ress_don = mysqli_query($conn, $sql_don);
while ($li = mysqli_fetch_array($ress_don)) {
    $supplier[] = $li;
}

$dataSend['barang'] = $barang;
$dataSend['supplier'] = $supplier;

echo json_encode($dataSend);
