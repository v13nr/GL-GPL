<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Waktu Server</title>
<?php

include 'inc_servertime.php';
$st = new servertime;
#$st->lang = 'eng'; 
$st->shortmonth = true;

$st->InstallClockHead();

?>
</head>
<body>
<?
$st->InstallClock();

//echo '<br><br>';

//$st->Help(); // <-- you need not call this one ;-)

$st->InstallClockBody();
?>
</body>
</html>