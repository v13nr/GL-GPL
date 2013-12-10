<? session_start(); ?><?php
require('../fpdf16/fpdf.php');
include("../include/globalx.php");
include("../include/functions.php");
include("../include/infoclient.php");
include "otentik_gli.php";

date_default_timezone_set('Asia/Shanghai');

$pdf = new FPDF();
$pdf->AddPage();

//inisialisasi baris untuk paging
$barisPerHalaman = 35;

$pdf->setY(14);
$pdf->setFont('Arial','',12);
$pdf->cell(190,6,'LAPORAN JURNAL', 0, 0, 'C');
$pdf->setY(20);
$pdf->setFont('Arial','',10);
$pdf->cell(190,6,$namaclient, 0, 0, 'C');
$pdf->setY(26);
$pdf->cell(190,6,$jalamclient, 0, 0, 'C');
$pdf->setY(32);
$pdf->cell(190,6,$telponclient, 0, 0, 'C');

$pdf->setY(40);
$pdf->cell(20,6,'Periode ', 0, 0, 'L');
$pdf->cell(50,6,': '.$_POST['tgl_awal'].' s/d '.$_POST['tgl_akhir'], 0, 0, 'L');
$pdf->setY(45);
$pdf->cell(20,6,'Divisi ', 0, 0, 'L');
	$divisi = "ALL";
	if($_POST['divisi']<>""){
		$SQL = "SELECT namadiv FROM divisi WHERE subdiv = '".$_POST['divisi']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$divisi = $baris[0];
	}
$pdf->cell(50,6,': '.$divisi, 0, 0, 'L');

$pdf->setFont('Arial','',8);
$pdf->setY(52);
$pdf->cell(8,5,'No.', 1, 0, 'C');
$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
$pdf->cell(15,5,'Norek', 1, 0, 'C');
$pdf->cell(25,5,'Nama', 1, 0, 'C');
$pdf->cell(40,5,'Uraian', 1, 0, 'C');
$pdf->cell(28,5,'Debet', 1, 0, 'C');
$pdf->cell(28,5,'Kredit', 1, 0, 'C');
$pdf->cell(19,5,'User', 1, 0, 'C');

$SQL = "SELECT * FROM dbfj where id <> ''";
if($_POST['tgl_awal']<>"" && $_POST['tgl_akhir']<>""){
	$SQL = $SQL . " AND tanggal between '".baliktgl($_POST['tgl_awal'])."' AND '".baliktgl($_POST['tgl_akhir'])."'";
}
if($_POST['divisi']<>""){
	$SQL = $SQL . " AND sub = '".$_POST['divisi']."'";
}
if($_POST['user']<>""){
	$SQL = $SQL . " AND user_id = '".$_POST['user']."'";
}
$SQL = $SQL . " ORDER BY tanggal ASC";
$hasil = mysql_query($SQL);

$y = 57;
while($baris = mysql_Fetch_array($hasil)){
	//looping
	$pdf->setY($y);
	$pdf->cell(8,5,++$no, 1, 0, 'C');
	$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
	$pdf->cell(15,5,$baris['sub'].'/'.nobukti($baris['nobukti']), 1, 0, 'C');
	$pdf->cell(15,5,$baris['kd'], 1, 0, 'C');
		$SQLuser = "SELECT namarek FROM dbfm WHERE norek = '".$baris['kd']."'";
		$hasiluser= mysql_query($SQLuser);
		$barisuser = mysql_fetch_array($hasiluser);
	$pdf->cell(25,5,substr($barisuser[0],0,14), 1, 0, 'L');
	$pdf->cell(40,5,substr($baris['ket'],0,21), 1, 0, 'L');
	$pdf->cell(28,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R');
		$TOTAL = $TOTAL + $baris['jumlah'];
	$pdf->cell(28,5,'0.00', 1, 0, 'R');
		$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$baris['user_id'];
		$hasiluser= mysql_query($SQLuser);
		$barisuser = mysql_fetch_array($hasiluser);
	$pdf->cell(19,5,$barisuser[0], 1, 0, 'C');
	$y = $y + 5;
	
	$pdf->setY($y);
	$pdf->cell(8,5,++$no, 1, 0, 'C');
	$pdf->cell(15,5,baliktglindo($baris['tanggal']), 1, 0, 'C');
	$pdf->cell(15,5,$baris['sub'].'/'.nobukti($baris['nobukti']), 1, 0, 'C');
	$pdf->cell(15,5,$baris['kk'], 1, 0, 'C');
		$SQLuser = "SELECT namarek FROM dbfm WHERE norek = '".$baris['kk']."'";
		$hasiluser= mysql_query($SQLuser);
		$barisuser = mysql_fetch_array($hasiluser);
	$pdf->cell(25,5,substr($barisuser[0],0,14), 1, 0, 'L');
	$pdf->cell(40,5,substr($baris['ket2'],0,21), 1, 0, 'L');
	$pdf->cell(28,5,'0.00', 1, 0, 'R');
	$pdf->cell(28,5,number_format($baris['jumlah'],2,'.',','), 1, 0, 'R');
		$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$baris['user_id'];
		$hasiluser= mysql_query($SQLuser);
		$barisuser = mysql_fetch_array($hasiluser);
	$pdf->cell(19,5,$barisuser[0], 1, 0, 'C');
	$y = $y + 5;
	
	//paging
	if(($no % $barisPerHalaman) == 0){
		$pdf->AddPage();
		$pdf->setY(52);
		$pdf->cell(8,5,'No.', 1, 0, 'C');
		$pdf->cell(15,5,'Tanggal', 1, 0, 'C');
		$pdf->cell(15,5,'Nobukti', 1, 0, 'C');
		$pdf->cell(15,5,'Norek', 1, 0, 'C');
		$pdf->cell(25,5,'Nama', 1, 0, 'C');
		$pdf->cell(40,5,'Uraian', 1, 0, 'C');
		$pdf->cell(28,5,'Debet', 1, 0, 'C');
		$pdf->cell(28,5,'Kredit', 1, 0, 'C');
		$pdf->cell(19,5,'User', 1, 0, 'C');
		$y = 57;
	} // end if paging
} // end looping jurnal

$pdf->setY($y);
$pdf->cell(8,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(15,5,'', 1, 0, 'C');
$pdf->cell(25,5,'', 1, 0, 'C');
$pdf->cell(40,5,'TOTAL', 1, 0, 'R');
$pdf->cell(28,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');
$pdf->cell(28,5,number_format($TOTAL,2,'.',','), 1, 0, 'R');
$pdf->cell(19,5,'', 1, 0, 'C');

$pdf->Output();
?>