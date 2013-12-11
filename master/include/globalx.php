<?
$host ="localhost";
    $user="root";
    $password="";
    $database="erwin_nanang";
    $dbh1 = mysql_connect($host,$user,$password) or die("Koneksi server gagal");
    mysql_select_db($database);

	$site_path = "http://localhost/nanang";


?>
