<? include "otentik_gli.php"; 
include ("../include/functions.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery.js"></script>
<style type="text/css">
input.kanan{ text-align:right; }
</style>

</SCRIPT>
	<script language"javascript" type="text/javascript">
	function PopUp(url){
	window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=100,left = 200,top = 200');
	}
	$(document).ready(function(){
		$("#divisi").change(onSelectChange);
		$("#user").change(onSelectChange);
		$("#tgl_awal").focus(onSelectChange);
		$("#tgl_akhir").focus(onSelectChange);

	function formatCurrency(num) {
		num = num.toString().replace(/\$|\,/g,'');
		if(isNaN(num))
		num = "0";
		sign = (num == (num = Math.abs(num)));
		num = Math.floor(num*100+0.50000000001);
		cents = num%100;
		num = Math.floor(num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
		num.substring(num.length-(4*i+3));
		//return (((sign)?'':'-') + '$' + num + '.' + cents);
		return (((sign)?'':'-') + num);
	}
	
    $.each($('.kanan'), function()
    {
       $(this).keyup( function(){ 
	   		$(this).val(formatCurrency($(this).val()));
		} );
    });
	
	});
	function onSelectChange(){
		$("#cari").attr("href", "index.php?divisi="+$("#divisi").val()+"&mn=jurnal&user="+$("#user").val()+"&tgl_awal="+$("#tgl_awal").val()+"&tgl_akhir="+$("#tgl_akhir").val());
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

<form method="post" action="">
  <table width="1024" border="0" cellspacing="1" class="style3">
    <tr>
      <td width="2" rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="53" rowspan="3" valign="bottom"><div align="center" class="style4"><a href="index.php?mn=trans_jurnal"><img src="../draft/images/user_add.png" width="32" height="32" border="0" align="absbottom" class="style3" /></a></div></td>
      <td width="51" rowspan="3" valign="bottom"><div align="center" class="style4"></div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center" class="style4"><a id="cari">
        <img src="../images/cari.png" width="32" height="32" /></a>
      </div></td>
      <td width="50" rowspan="3" valign="bottom"><div align="center"><a href=""><img src="../images/fileex.png" border="0" width="32" height="32" /></a></div></td>
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
      <td class="style3"><div align="center" class="style5"></div></td>
      <td class="style3"><div align="center" class="style5">Cari</div></td>
      <td class="style3" colspan="2"><div align="left"><span class="style5"></span>Export To MS-Excell</div></td>
      <td><span class="style5"></span></td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </table>
  <table width="1000" border="0" bgcolor="#000000" cellspacing="1">
    <tr height="30" background="../images/impactg.png">
      <td colspan="2" class="style3"><div align="center" class="style4">Filter : </div></td>
      <td colspan="3" class="style3"><input type="text" name="tgl_awal" id="tgl_awal" size="10" value="<?=$_GET['tgl_awal']?>" class="required" title="Harap Mengisi Tanggal Awal Dahulu" />
      <a href="javascript:showCalendar('tgl_awal')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a>
s/d      
<input type="text" name="tgl_akhir" id="tgl_akhir"  value="<?=$_GET['tgl_akhir']?>" size="10" class="required" title="Harap Mengisi Tanggal Akhir Dahulu" />
        <a href="javascript:showCalendar('tgl_akhir')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0" /></a></td>
      <td class="style3">
	  <select name="user" id="user">
	  <option value="">-ALL User-</option>
	  <?
	  	$SQLu = "SELECT * FROM ml_user WHERE id <> 1 AND status = 1";
		$hasilu = mysql_query($SQLu);
		while($barisu=mysql_fetch_array($hasilu)){
	  ?>
	  	<option value="<?=$barisu['id']?>" <? if($_GET['user']==$barisu['id']){ ?> selected="selected" <? }?>><?=$barisu['nama'].' -- '.$barisu['id']?></option>
	  <? } ?>
	  </select>	  </td>
      <td colspan="3" class="style3"><select name="divisi" id="divisi">
        <option value="">-ALL Divisi-</option>
        <?
			$SQL = "SELECT * FROM divisi WHERE subdiv <> ''";
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
        <option value="<?=$baris['subdiv']?>" <? if($_GET['divisi']==$baris['subdiv']){?> selected="selected" <? }?>> <?=$baris['namadiv'].' -- '.$baris['subdiv']?>         </option>
        <? } ?>
      </select></td>
      <td class="style3">&nbsp;</td>
      <td class="style3">&nbsp;</td>
	   <td class="style3" colspan="2">&nbsp;</td>
    </tr>
    <tr height="30" background="../images/impactg.png">
	  <td width="29" class="style3"><div align="center" class="style4">No.</div></td>
      <td width="26" class="style3"><div align="center" class="style4">#</div></td>
      <td width="90" class="style3"><div align="center" class="style4">Tanggal</div></td>
      <td width="90" class="style3"><div align="center" class="style4">Rekening Debet </div></td>
      <td width="103" class="style3"><div align="center" class="style4">Rekening Kredit </div></td>
	  <td width="155" class="style3"><div align="center" class="style4">Keterangan Debet </div></td>
      <td width="152" class="style3"><div align="center" class="style4">Keterangan Kredit </div></td>
      <td width="118" class="style3"><div align="center" class="style4">Jumlah</div></td>
	  <td width="63" class="style3"><div align="center" class="style4">No Bukti </div></td>
	  <td width="64" class="style3"><div align="center" class="style4">User</div></td>
      <td width="76" class="style3"><div align="center" class="style4">Divisi</div></td>
	  <? if ($_GET['id']<>"") { ?>
        <td width="58" align="center"><b>Update</b></td>
        <td width="58" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="76" class="style3"><div align="center" class="style4">Edit</div></td>
        <? } ?>
	  
    </tr>
	<?
		$SQL = "select * FROM dbfj WHERE id <> ''" ;
		if($_GET['divisi']<>""){
			$SQL = $SQL . " AND divisi = '".$_GET['divisi']."'";
		}
		if($_GET['user']<>""){
			$SQL = $SQL . " AND user_id = '".$_GET['user']."'";
		}
		if($_GET['tgl_awal']<>"" && $_GET['tgl_akhir']<>""){
			$SQL = $SQL . " AND tanggal BETWEEN '".baliktgl($_GET['tgl_awal'])."' AND '".baliktgl($_GET['tgl_akhir'])."'";
		}
		if($_GET['id']<>""){
			$SQL = $SQL . " AND id = '".$_GET['id']."'";
		}
		//$SQL = $SQL." ORDER BY tanggal DESC";
		//echo $SQL;
		//echo $_GET['mn'];
		$hasil=mysql_query($SQL) or die(mysql_error());
		$id = 0;
	?>
	<? 
		 $nRecord = 1;
			if (mysql_num_rows($hasil) > 0) { 
			while ($row=mysql_fetch_array($hasil)) { 
 	?>
    <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#e4e4e4"<? }  else {?>bgcolor="#FFFFCC"<? } ?>>
      <td align="center" class="style3"><?=++$No?></td>
      <td class="style3" align="center"><input type="checkbox" id="tambah" name="tambah[]" value="<?=$row['id'] ?>" /></td>
      <td class="style3" align="center"><?=baliktglindo($row['tanggal'])?></td>
      <td class="style3" align="center"><?=$row['kd']?></td>
      <td class="style3" align="center"><?=$row['kk']?></td>
      <td class="style3" align="left"><?=$row['ket']?></td>
      <td class="style3" align="left"><?=$row['ket2']?></td>
      <td class="style3" align="right">
	  	<? if ($_GET['id']=="") { ?>
	  	<?=number_format($row['jumlah'],2,'.',',')?>
		<? } else { ?>
		<input type="text" name="harga" value="<?=number_format($row['jumlah'])?>"  class="required kanan" title="*" />
		<? } ?>
		</td>
      <td class="style3" align="center"><a href="cetak_pdf.php?divisi=<?=$row['sub']?>&nobukti=<?=$row['nobukti']?>&tanggal=<?=baliktglindo($row['tanggal'])?>"><?=$row['sub']?>/<?=nobukti($row['nobukti'])?></a></td>
      <td class="style3" align="center">
	  	<?
			$SQLuser = "SELECT nama FROM ml_user WHERE id = ".$row['user_id'];
			//$hasiluser= mysql_query($SQLuser);
			//$barisuser = mysql_fetch_array($hasiluser);
			//echo $barisuser[0];
			echo $row['user_id'];
		?>		</td>
      <td class="style3" align="center">
	  <?
	  	$SQLuser = "SELECT namadiv FROM divisi WHERE subdiv = '".$row['divisi']."'";
			//$hasiluser= mysql_query($SQLuser);
			//$barisuser = mysql_fetch_array($hasiluser);
			//echo $barisuser[0];
			echo $row['divisi'];
	  ?></td>
	   <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="index.php?mn=jurnal&id=<?=$row['id']?>"><img src="../draft/images/user_go.png" border="0" width="16" height="16" /></a></td>
          <? } ?>
	  
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
