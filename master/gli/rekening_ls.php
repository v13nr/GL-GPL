<? session_start(); ?>
<? include "otentik_gli.php"; include ("../include/functions.php");?><head>
<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#frmijin").validate({
		rules: {
			password: "required",
			password_again: {
		equalTo: "#password"
			}
		},
		messages: {
			email: {
				required: "E-mail harus diisi",
				email: "Masukkan E-mail yang valid"
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo(element.parent("td"));
		}
	});
})
</script>
<script type="text/javascript">
function confirmDelete(delUrl) {
	if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css">
<!--
body {
	background-image: url(../images/bg.png);
}
.style1 {
	font-family: "Segoe UI";
	font-size: 12px;
	font-weight: bold;
	color: #0000FF;
}
-->
</style></head>



<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
</style>
<?  
	include "../include/globalx.php"; ?>
<?
	$SQL = "SELECT * FROM rek WHERE status = 1";
	if ($_GET['id']<>"") {
		$SQL = $SQL." and norek=".$_GET['id'];
	}
	$SQL = $SQL." ORDER BY norek ASC";
	//echo $SQL;
	$hasil=mysql_query($SQL);
?>
<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">SETUP REKENING 
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td><table border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <? if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><font color="white"><b>Edit Rekening </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="9" align="center"><strong><font color="white">MASTER REKENING </font></strong></td>
      </tr>
      <? } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td width="150" align="center"><strong>No. Rekening </strong></td>
        <td width="150" align="center"><strong>Nama Rekening </strong></td>
        <td width="104" align="center"><strong>Type</strong></td>
        <? if ($_GET['id']<>"") { ?>
        <td width="58" align="center"><b>Update</b></td>
        <td width="58" align="center"><b>Batal</b></td>
        <? } else { ?>
        <td width="58" align="center"><strong>Edit</strong></td>
        <td width="58" align="center"><b>Hapus</b></td>
        <? } ?>
      </tr>
      <? if ($_GET['id']=="") { ?>
      <tr bgcolor="yellow">
        <form name="frmijin" id="frmijin" method="post" action="submission_gli.php">
          <input type="hidden" name="cmd" value="add_rekening" />
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center"><input type="text" name="norek" size="20" class="required" title="*" maxlength="4"></td>
          <td align="center"><input type="text" name="namarek" size="50" class="required" title="*"></td>
          <td align="center"><select name="tipe" id="tipe" class="required" title="*">
            <option value="">-Pilih Type-</option>
			<option value="A">A</option>
			<option value="P">P</option>
			<option value="R">R</option>
			<option value="R">R2</option>
          </select></td>
          <td align="center" colspan="4"><input name="image" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
      <?	 
		$nRecord = 1;
		if (mysql_num_rows($hasil) > 0) { 
		while ($row=mysql_fetch_array($hasil)) { 
	?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<? } else {?> else="else" bgcolor="#CCCCCC"<? }?>>
        <form action="submission_gli.php" method="post" name="frmijin" id="frmijin">
          <input type="hidden" name="id" value="<?=$_GET['id']?>" />
          <input type="hidden" name="cmd" value="upd_rekening" />
          <td align="center"><?=$nRecord?></td>
          <td align="center"><? if ($_GET['id']<>"") { ?>
            <input type="text" name="norek" size="20" class="required" title="*" maxlength="4" value="<?=$row['norek']?>">
            <? } else { ?>
              <?=$row["norek"]?>
              <? } ?>
          </td>
          <td align="left"><? if ($_GET['id']<>"") { ?>
            <input type="text" name="namarek" size="50" class="required" title="*"  value="<?=$row['namarek']?>">
            <? } else { ?>
              <?=$row["namarek"]?>
              <? } ?></td>
          <td align="center"><? if ($_GET['id']<>"") { ?>
            <select name="tipe" id="tipe" class="required" title="*">
              <option value="A" <? if($row['tipe']=="A") {?> selected="selected" <? }?>>A</option>
              <option value="P" <? if($row['tipe']=="P") {?> selected="selected" <? }?>>P</option>
              <option value="R" <? if($row['tipe']=="R") {?> selected="selected" <? }?>>R</option>
			  <option value="R2" <? if($row['tipe']=="R2") {?> selected="selected" <? }?>>R2</option>
            </select>
            <? } else { ?>
              <?=$row["tipe"]?>
              <? } ?></td>
          <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="?mn=<?=$_GET['mn']?>&amp;id=<?=$row["norek"]?>"><img src="../images/edit.gif" alt="Edit" border="0" /></a></td>
          <td align="center"><a href="javascript:confirmDelete('submission_gli.php?id=<?=$row["norek"]?>&amp;cmd=del_rekening')"><img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <? } ?>
        </form>
      </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} 
	} else { ?>
      <tr>
        <td align="center" colspan="9"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
    </table></td>
  </tr>
</table>
