<?php
include "../include/globalx.php";
$q = strtolower($_GET["q"]);
//if (!$q) return;
//$db = new mysqli($host, $user ,$password, $database);

if(!$dbh1) {
        echo 'ERROR: Could not connect to the database.';
} else {
	//AND divisi = '".$_GET['divisi']."'
	$SQL = "SELECT kodebrg, namabrg FROM stock WHERE namabrg LIKE '%$q%' AND divisi = '".$_GET['divisi']."' LIMIT 20";
    $query = mysql_query($SQL);
    if($query) {
           
            while ($result = mysql_fetch_array($query)) {
                echo "$result[namabrg] - $result[kodebrg] |$result[kodebrg]\n";
            }
    } else {
            echo 'ERROR: There was a problem with the query.';
    }
}
?>
