<? session_start();
include("include/globalx.php");
include("include/functions.php");
include ("otentik.php");
?>
<script type="text/javascript" src="assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="assets/jquery.validate.pack.js"></script>
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
	function PopUp(url){
		window.open(url,'', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=400,left = 300,top = 150');
	}
</script>
<style type="text/css">
<!--
body {
	background-image: url(images/ok.jpg);	/*background-image: url(images/bg.png);*/
}
.style40 {
	font-family: "Segoe UI";
	font-size: 12px;
}
.style46 {font-family: "Segoe UI"; font-size: 12px; color: #333333; }
.style49 {font-family: "Segoe UI"; font-size: 12px; font-weight: bold; color: #0000FF; }
.style51 {color: #990000}
.style52 {
	color: #0000FF;
	font-weight: bold;
}
.style53 {font-family: "Segoe UI"; font-size: 12px; font-weight: bold; color: #990000; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
</style><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<table width="1140" border="0">
  <tr>
    <td colspan="5"><marquee  loop="-1" scrollamount="2" width="100%">
      <span class="style49">Selamat datang di Sistem Informasi Akuntansi PT. GLGPL      </span><span class="style52">
    - <span class="style40">Janganlah lupa untuk Klik <span class="style51">simbol Logout pada Menu disamping</span>, guna keluar dari sistem
    setelah anda selesai menggunakan sistem ini.. Terima Kasih </span></span>
    </marquee>      
    <hr /></td>
  </tr>
  
  <tr>
    <td width="24"><img src="images/notes.png" width="24" height="24" /></td>
    <td width="629"><span class="style49">Perhatian : </span>
    <hr /></td>
    <td width="22">&nbsp;</td>
    <td width="35"><img src="images/newsIcon.png" width="35" height="31" /></td>
    <td width="408"><span class="style49">Berita Terkini </span>
    <hr /></td>
  </tr>
  <tr>
    <td valign="top"><div align="center" class="style53">#</div></td>
    <td><div align="justify" class="style46">Agar keamanan sistem ini tetap terjaga, diharapkan kepada seluruh User Sistem ini untuk <em><strong><span class="style51">tidak memberikan Username dan Password kepada orang lain</span>. </strong></em></div></td>
    <td>&nbsp;</td>
    <td valign="top"><div align="center"><span class="style53">#</span></div></td>
    <td valign="top"><span class="style40">Untuk saat ini tidak ada berita terbaru.. </span></td>
  </tr>
  <tr>
    <td colspan="5" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2" valign="top"><div align="center" class="style53">#</div></td>
    <td rowspan="2"><div align="justify" class="style46">Sistem ini dilengkapi dengan <span class="style51"><strong><em>Log System dan Security System</em></strong></span>, guna dapat memantau segala aktivitas User terhadap sistem ini, <span class="style51"><em><strong>dengan memberikan Username dan Password anda kepada Orang lain maka anda bertanggung jawab penuh</strong></em></span> terhadap data yang anda kelola.</div></td>
    <td rowspan="2">&nbsp;</td>
    <td valign="top"><div align="center"><img src="images/agenda.png" width="24" height="24" /></div></td>
    <td rowspan="2"><p><span class="style49">Agenda Terkini </span></p>
    <p><span class="style40">Untuk saat ini tidak ada agenda kegiatan.. </span></p></td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><span class="style53">#</span></div></td>
  </tr>
  <tr>
    <td height="3" colspan="5" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><div align="center"><span class="style53">#</span></div></td>
    <td><div align="justify"><span class="style40">Setiap selesai menggunakan aplikasi ini diharapkan kepada seluruh user untuk selalu melakukan <span class="style51"><strong>&quot;Logout&quot;</strong> <strong>[ Menu ini terdapat pada Navigasi Menu sebelah kiri atas ]</strong></span> guna keamanan sistem ini tetap terjaga. </span></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/agenda.png" width="24" height="24" /></td>
    <td><span class="style49">Tanya Jawab</span>
    <hr /></td>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
  </tr>
  <form id="frmijin" name="frmijin" method="post" action="submission.php">
  <input type="hidden" name="cmd" value="add_pesan" /> 

  <tr>
    <td valign="top"><div align="center"><span class="style53">#</span></div></td>
    <td>
	
	Isikan Pesan/Pertanyaan Anda di bawah ini : <br /><textarea name="pesan" id="pesan" cols="50" rows="2" class="required" title="Harap mengisi pesan."></textarea><input type="submit" value="Kirim" />
	
	</td>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
  </tr>
  </form>
    <tr>
    <td valign="top">&nbsp;</td>
    <td>
	
		<table width="613">
		<?
			$SQL = "SELECT * FROM pesan WHERE status = 1 AND parent_id = 0 ORDER BY tanggal DESC";
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
			<tr>
				<td colspan="2"><span class="style51"><?=$baris['nama']?> <small>[ <?=$baris['tanggal']?> ]</small></span></td>
			</tr>
			<tr>
			  <td colspan="2"><?=$baris['pesan']?></td>
		  </tr>
			<tr>
			  <td width="23">&nbsp;&nbsp;&nbsp;</td>
		      <td width="578">
			  	<table width="100%">
					<?
						$SQLa = "SELECT * FROM pesan WHERE status = 1 AND parent_id = '".$baris['id']."' ORDER BY tanggal ASC";
						$hasila = mysql_query($SQLa);
						while($barisa = mysql_fetch_array($hasila)){
					?>
					<tr>
						<td colspan="2"><span class="style51"><?=$barisa['nama']?> <small>[ <?=$barisa['tanggal']?> ]</small></span></td>
					</tr>
					<tr>
						  <td colspan="2"><?=$barisa['pesan']?></td>
					  </tr>
					<? } ?>
			  	</table>
			  </td>
		  </tr>
			<tr>
			  <td colspan="2"><small>[ <a href='javascript:PopUp("balas.php?id=<?=$baris["id"]?>")'> Balas </a>]</small></td>
		  </tr>
		  <tr>
			  <td colspan="2">&nbsp;</td>
		  </tr>
		<? } ?>
		</table>

	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
