<? session_start();
include "otentik_inv.php"; ?>
<? 
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
	/* background-image: url(../images/ok.jpg);
	background-repeat: repeat; */
}
.style3 { font-family: "Segoe UI"; font-size: 12px; }
.style4 {color: #FFFFFF}
.style5 {color: #000000; }

-->
</style>

<style type="text/css">
.mystri {text-decoration: line-through;}
</style>
</head>

<body>
<div align="center">
<?
	$SQL = "select * FROM supplier where kode = '".$_GET['id']."'" ;
	$hasil = mysql_query($SQL);
	$baris = mysql_fetch_array($hasil)
?>
<div align="center">
	KARTU STOCK <BR />
	<?=$baris['nama'];?><br />
	
	<br />
</div>
<form method="post" action="ngaco">
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
	  <td width="31" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="107" class="style3"><div align="center" class="style4">Tanggal</div></td>
      <td width="71" class="style3"><div align="center" class="style4">Nota</div></td>
      <td width="247" class="style3"><div align="center" class="style4">No Bukti </div></td>
	  
	  <td width="135" class="style3"><div align="center" class="style4">KodeBrg</div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Nama Barang </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Qty In </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Qty Out </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Satuan </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc 2 </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Dis 3 </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Disc Rp </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Harga </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Debet </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">Kredit </div></td>
	  <td width="85" class="style3"><div align="center" class="style4">User </div></td>
     
    </tr>
	<?
		$SQL = "select * FROM mutasi where kode = '".$_GET['id']."'" ;
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
		$SQL = $SQL." ORDER BY tgl DESC, nota ASC, sub ASC, nomor DESC";
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
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=baliktglindo($row['tgl'])?></td>
	  <?
	  	$nota = $row['nota'];
	  	if($row['model']=="INV"){
			$nota = "INV/".$row['sub']."/".nobukti($row['nomor']);
		}
	  ?>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$nota?></td>
      <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="left"><?=$row['nobukti']?></td>
	  
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=auto($row['kodebrg'])?></td>
	  <td class="style3 <? if($row['status']=="0"){?> mystri <? }?>" align="center"><?=$row['namabrg']?></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['qtyin'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['qtyout'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="center">
	    <?=$row['satuan']?>
	    </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc2'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['disc3'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['discrp'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['harga'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['debet'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="right">
	    <?=number_format($row['kredit'],2,'.',',')?>
	  </div></td>
	  <td width="85" class="style3 <? if($row['status']=="0"){?> mystri <? }?>"><div align="center">
	  <?
			$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$row['user_id'];
			$hasiluser= mysql_query($SQLuser);
			$barisuser = mysql_fetch_array($hasiluser);
			echo $barisuser[0];
		?>
	   </div></td>
    </tr>
	<?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
	  <tr bgcolor="white">
		<td align="center" colspan="27"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
	  </tr>
	<?  } ?>
  </table>
  </form>
</div>
</body>
</html>
