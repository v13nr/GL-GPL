<?php
session_start();

include ("include/globalx.php");
date_default_timezone_set("Asia/Shanghai"); 

if( !isset($_SESSION['sess_user_id']) ) {
    header("location: index.php");
} else {
$tgl_skrg = Date("Y-m-d");
$wkt_disimpan = Date("Y-m-d H:i:s");
$query = "select * from ml_absen where IDUser=".$_SESSION["sess_user_id"]." and waktu_datang like '%".$tgl_skrg."%'";
$hasil = mysql_query($query, $dbh1);
	if (mysql_num_rows($hasil) > 0){
		$query = "update ml_absen set waktu_pulang='".$wkt_disimpan."' where IDUser='".$_SESSION["sess_user_id"]."' and waktu_datang like '%".$tgl_skrg."%'";
		$hasil = mysql_query($query, $dbh1);
	} else {}

unset($_SESSION["is_login"]);
unset($_SESSION["sess_kelasuser"]);
unset($_SESSION["sess_user_id"]);
unset($_SESSION["sess_name"]);
unset($_SESSION["sess_uname"]);

// echo $tsql0;

header("location: index.php");
}


?>