<? session_start(); include ("otentik.php");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Balas Pesan</title>
<script type="text/javascript">
	function CloseAndRefresh() 
{
    window.opener.location.href = window.opener.location.href;
    window.close();
}
</script>
</head>

<body onblur="CloseAndRefresh();">
<div align="center">
<?
	if($_GET['id'] == ""){
		echo '<input type="button" value="Pesan Telah Terkirim. Klik Tombol ini." onclick="window.close()" />';
		exit();
	}
?>
<form method="post" action="submission.php">
<input type="hidden" name="cmd" value="add_balaspesan" />
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<textarea name="pesan" rows="20" cols="30"></textarea><br />
<input type="submit" value="Kirim"  />
</form>
</div>
</body>
</html>
