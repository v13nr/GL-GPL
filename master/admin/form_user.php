<? 
	if (!isset($_SESSION['is_login'])) { exit; }
	include "../include/otentik_admin.php"; 
	
	if($_GET['id']<>""){
		$SQL = "SELECT * FROM ml_user WHERE status = 1 AND id = ".$_GET['id'];
		$hasil = mysql_query($SQL, $dbh1);
		while($row=mysql_fetch_array($hasil)) {
			$id = $row['id'];
			$user = $row['user'];
			$nama = $row['nama'];
			$kelasuser = $row['kelasuser'];
			$aktif = $row['aktif'];
			$password = $row['pass2'];
			$tipe = $row['tipe'];
		}
	}
?>
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	
<? if($_GET['id']==""){ ?>	
    $("#username").val('');
	$("#password").val('');
	$("#password_again").val('');
<? } ?>
	
	$("#userForm").validate({
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
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input { padding: 3px; border: 1px solid #999; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
</style>
<br>
<form id="userForm" method="post" action="admin_submission.php">
<? if($_GET['id']<>""){ ?>
<input type="hidden" name="cmd" value="upd_user">
<input type="hidden" name="id" value="<?=$id?>" />
<? } else { ?>
<input type="hidden" name="cmd" value="add_user">
<? } ?>
<table align="center" class="x1">
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" id="username" name="username"  class="required"  title="Username harus diisi" value="<?=$user?>"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" id="password" name="password"  class="required"  title="Password harus diisi" value="<?=$password?>"/>		</td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td>:</td>
		<td><input type="password" name="password_again" id="password_again"   class="required"  title="isikan Password yg sama di atas" value="<?=$password?>" /></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" name="nama"  class="required"  title="Nama harus diisi" value="<?=$nama?>"/></td>
	</tr>
	<tr>
		<td>Kelas User</td>
		<td>:</td>
		<td><select name="slKelas" class="required"  title="Tipe Login harus diisi">
          <option value="">- Pilih Tipe Login -</option>
          <option value="User" <? if($kelasuser=="User") { ?>selected="selected" <? } ?>>User</option>
		  <option value="Admin" <? if($kelasuser=="Admin") { ?>selected="selected" <? } ?>>Admin</option>
		  <option value="Super Admin" <? if($kelasuser=="Super Admin") { ?>selected="selected" <? } ?>>Super Admin</option>
        </select></td>
	</tr>
	<tr>
	  <td>Divisi</td>
	  <td>:</td>
	  <td><select name="slTipe" class="required"  title="Tipe Akses harus diisi">
        <option value="">- Pilih -</option>
		<?
			$SQL = "SELECT * FROM divisi";
			$hasil = mysql_query($SQL);
			while($baris=mysql_fetch_array($hasil)){
		?>
	        <option value="<?=$baris['subdiv']?>" <? if($tipe==$baris['subdiv']) { ?>selected="selected" <? } ?>><?=$baris['namadiv']?></option>
		<? } ?>
      </select></td>
    </tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><input type="radio" name="status" value="1" <? if ($aktif == "1") {?> checked="checked" <? } ?>  class="required" title="Pilih On atau Off">On &nbsp;&nbsp;<input type="radio" name="status" value="0" <? if ($aktif == "0") {?> checked="checked" <? } ?>  class="required"  title="Pilih On atau Off">Off</td>
	</tr><tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
			<? if($_GET['id']<>""){ ?>
			<input type="submit" value="Update">
			<? } else { ?>
			<input type="submit" value="Tambah">
			<? } ?>
			<input type="button" value="Batal" onclick="javascript:history.back()">		</td>
	</tr>
</table>
</form>