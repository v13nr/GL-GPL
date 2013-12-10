<? include "otentik_gli.php"; 
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<SCRIPT language=javascript src="popcalendar.js"></SCRIPT>
</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
</script>
<style type="text/css">
<!--
body {
	background-image: url(../images/ok.jpg);
	background-repeat: repeat;
}
.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }
-->
</style></head>

<body>
<div align="center">

<form method="post" action="submission_gli.php">
<input type="hidden" name="cmd" value="del_rekp" />
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=input_rp"><img src="../draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"><input type="image" src="../draft/images/user_delete.png" width="32" height="32" /></div></td>
      <td width="50" rowspan="3"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href="exportrp.php"><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
      <td width="48" rowspan="3">&nbsp;</td>
      <td width="1" rowspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="17"><div align="center"><img src="../draft/images/calendar.png" width="16" height="16" /></div></td>
      <td width="4"><div align="center">:</div></td>
      <td width="722">&nbsp; 
	  <? date_default_timezone_set('Asia/Shanghai'); echo date('l, j F Y'); ?></td>
      </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/Gnome-Appointment-New-48.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left"> &nbsp;<?php echo gmdate(" H:i:s", time()+60*60*7); ?>  </div></td>
    </tr>
    <tr>
      <td class="style3"><div align="center"><img src="../draft/images/user.png" width="16" height="16" /></div></td>
      <td class="style3"><div align="center">:</div></td>
      <td class="style3"><div align="left">&nbsp;Admin General Ledger </div></td>
      <td class="style3"><div align="center" class="style5">Tambah</div></td>
      <td class="style3"><div align="center" class="style5">Hapus</div></td>
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="32" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="29" class="style3"><div align="center" class="style4">#</div></td>
      <td width="101" class="style3"><div align="center" class="style4">No. Rekening </div></td>
      <td width="272" class="style3"><div align="center" class="style4">Nama Rekening </div></td>
      <td width="38" class="style3"><div align="center" class="style4">Type</div></td>
	  <? if($macan==1){?>
	  <td width="92" class="style3"><div align="center" class="style4">Saldo Awal </div></td>
      <td width="108" class="style3"><div align="center" class="style4">Debet</div></td>
      <td width="118" class="style3"><div align="center" class="style4">Kredit</div></td>
	  <td width="103" class="style3"><div align="center" class="style4">Saldo Akhir</div></td>
	  <? }?>
      <td width="76" class="style3"><div align="center" class="style4">Edit</div></td>
    </tr>
	<?
		$SQL = "select * FROM dbfm WHERE status = 1" ;
		if($_GET['c_no']<>""){
			$SQL = $SQL . " AND noinduk LIKE '%".$_GET['c_no']."%'";
		}
		if($_GET['c_nama']<>""){
			$SQL = $SQL . " AND nama LIKE '%".$_GET['c_nama']."%'";
		}
		if($_GET['c_jk']<>""){
			$SQL = $SQL . " AND jkel = '".$_GET['c_jk']."'";
		}
		if($_GET['c_dep']<>""){
			$SQL = $SQL . " AND departemen = '".$_GET['c_dep']."'";
		}
		$SQL = $SQL." ORDER BY norek ASC";
		$hasil=mysql_query($SQL);
		$id = 0;
	?>
	<? 
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3"><?=++$No?></td>
	  <td class="style3" align="center">
	  <? if(substr($row['norek'],-3)<>"000"){ ?>
	  	<input type="checkbox" id="tambah" name="tambah[]" value="<?=$row['norek'] ?>" /></td>
		<? } ?>
	  <td class="style3" align="center"><?=$row['norek']?></td>
      <td class="style3"><?=$row['namarek']?></td>
      <td class="style3" align="center"><?=$row['tipe']?></td>
	  <? if($macan==1){?>
	  <td class="style3" align="center"><?=number_format($row['saldoawal'],2,'.',',')?></td>
      <td class="style3" align="center"><?=number_format($row['debet'],2,'.',',')?></td>
      <td class="style3" align="center"><?=number_format($row['kredit'],2,'.',',')?></td>
	  <td class="style3" align="center"><?=number_format($row['saldoakhir'],2,'.',',')?></td>
	  <? } ?>
      <td class="style3"><div align="center">
	  <? if(substr($row['norek'],-3)<>"000"){ ?>
	  <a href="index.php?mn=input_rp&id=<?=$row['norek'] ?>"><img src="../draft/images/user_go.png" border="0" width="16" height="16"></a>
	  <? } ?>
	  </div></td>
    </tr>
	<?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="17"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
  </table>
  </form>
</div>
</body>
</html>
