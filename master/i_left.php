<? 

session_start();

?>

<html>



<head>


<title>Database </title>

<style>
BODY
{
	/*border: solid 2px #000000;*/
	background-color:#FFFFCC;
	font-family: "Segoe UI";
	font-size: 12px;
}
a {text-decoration:none}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style6 {font-size: 12px}
.style7 {
	color: #990000;
	font-weight: bold;
}
</style> 




<base target="main">



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>



<body leftmargin=3>
<table width="300" border="0">
  <tr>
    <td width="25"><a href="main.php"><img src="images/home.png" width="24" height="24" border="0"></a></td>
    <td width="49"><span class="style6"><a href="main.php">Home</a></span></td>
    <td width="9" valign="middle">|</td>
    <td width="26"><a target="_parent" href="sb_logout.php"><img src="images/door_open.png" alt="Logout" width="24" height="24" border="0" align="absmiddle"></a></td>
    <td width="169"><a target="_parent" href="sb_logout.php"><span class="style2 style6">Logout</span></a></td>
  </tr>
</table>
<div align="right"></div>
<hr size="1">

<div align="center"><span class="style2"> <span class="style7">User Login :</span> 
  <?=$_SESSION["sess_name"]?>
</span><br><span class="style7">Divisi :</span> 
  <?=$_SESSION["sess_tipe"]?>
</span></div>
<hr size="1">
<br>
<? include "treeview/demo/index.php"; ?>

		

		

</body>


</html>

