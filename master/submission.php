<?
session_start();
include ("include/globalx.php");
include ("include/functions.php");
include ("otentik.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00"; 
		
switch ($cmd) {
	case "add_pesan" :
		$SQL = "INSERT INTO pesan(id, tanggal, user_id, nama, pesan, status) VALUES ('', '".$wkt_disimpan."', '".$_SESSION["sess_user_id"]."', '".$_SESSION["sess_name"]."', '".$_POST["pesan"]."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "main.php";
	break;
	case "add_balaspesan" :
		$SQL = "INSERT INTO pesan(id, parent_id, tanggal, user_id, nama, pesan, status) VALUES ('', '".$_POST['id']."', '".$wkt_disimpan."', '".$_SESSION["sess_user_id"]."', '".$_SESSION["sess_name"]."', '".$_POST["pesan"]."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "balas.php";
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>