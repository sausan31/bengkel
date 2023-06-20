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


$data = [];
if (isset($_GET['awal'])) {
    $mulai      = $_GET['awal'];
    $selesai = $_GET['akhir'];
    $sql = "SELECT trx.*, konsumen.*, kasir.* FROM trx, konsumen, kasir WHERE
                                            trx.id_kon=konsumen.id_kon AND trx.id_kasir=kasir.id_kasir AND 
                                            trx.tgl_trx BETWEEN '$mulai' AND '$selesai' ORDER BY trx.id_trx DESC";
    $ress = mysqli_query($conn, $sql);
    while ($d = mysqli_fetch_array($ress)) {
        $data[] = $d;
    }
}

$dataSend['data'] = $data;

echo json_encode($dataSend);
