<? session_start(); ?>
<? include "otentik_inv.php"; include ("../include/functions.php");?>
<style type="text/css">
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
</style>
<style type="text/css">
* { font: 11px/20px Verdana, sans-serif; }
h4 { font-size: 18px; }
input.error, select.error { border: 1px solid red; }
label.error { color:red; margin-left: 10px; }
td { padding: 5px; }
input.kanan{ text-align:right; }
</style>

<script type="text/javascript" src="../assets/kalendar_files/jsCalendar.js"></script>
<link href="../assets/kalendar_files/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../assets/jquery-1.2.3.pack.js"></script>
<script type="text/javascript" src="../assets/jquery.validate.pack.js"></script>
 <script language="javascript" src="../assets/thickbox/thickbox.js"></script>
 <link href="../assets/thickbox/thickbox.css" rel="stylesheet" type="text/css" />

 <? 
 if($_SESSION["sess_kelasuser"]<>"User"){
 	include "load_sp.php"; 
 }
 ?>

 <script language="JavaScript">
<!--
	function confirmDelete(delUrl) {
		if (confirm("Data ini akan dihapus!\nApakah Anda yakin untuk menghapusnya ?")) {
			document.location = delUrl;
		}
	}
//--> 
</script>
 <script type="text/javascript">
 function selectBuku(no, nama){
  $('input[@name=norek]').val(no);
  $('input[@name=namarek]').val(nama);
  //tb_remove(); // hilangkan dialog thickbox
}
 </script>
 <script type="text/javascript">

$(document).ready(function(){

function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		disc2 = clearNum(document.getElementById("disc2").value) * 1;
		disc3 = clearNum(document.getElementById("disc3").value) * 1;
		discrp = clearNum(document.getElementById("discrp").value) * 1;
		if(disc != 0 || disc2 != 0 || disc3 != 0){
			netto = (qty * harga)-((disc + disc2 + disc3) / 100 * harga * qty);
			document.getElementById("discrp").value = formatCurrency((disc + disc2 + disc3) / 100 * harga * qty)
		} else {
			netto = (qty * harga) - discrp;
		}
		
		document.getElementById("netto").value = formatCurrency(netto);
	}

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
			
  $('#combobox_subcarabayar').change( // beri event pada saat onBlur inputan kode pegawai
	function(){			
	  var vNIP = $(this).val();
	  $.get('../include/cari.php?cari=supplier&mode=alamat',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=alamat]').val(nama_pegawai);	
		  }else {
			$('input[@name=alamat]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=kota',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=kota]').val(nama_pegawai);	
		  }else {
			$('input[@name=kota]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=telp',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=telp]').val(nama_pegawai);	
		  }else {
			$('input[@name=telp]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=rek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=rek]').val(nama_pegawai);	
		  }else {
			$('input[@name=rek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=namarek',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=namarek]').val(nama_pegawai);	
		  }else {
			$('input[@name=namarek]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=supplier&mode=nama',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#namasupp').attr("value", nama_pegawai);
		  }else {
			$('#namasupp').attr("value", "");
		   }
		}
	  );
	}
  );
  $('#brg').blur( // beri event pada saat onBlur inputan kode pegawai
	function(){			
	  var vNIP = $(this).val();
	  $('#satuan').empty();
	  //$('#satuan').append($('<option></option>').val("").text("-Pilih-"));
	  $.get('../include/cari.php?cari=barang&mode=harga',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('input[@name=harga]').val(formatCurrency(nama_pegawai));	
		  }else {
			$('input[@name=harga]').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=barang&mode=isi',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			outputisi = nama_pegawai;
		  }else {
			
		   }
		}
	  );
	  $.get('../include/cari.php?cari=barang&mode=satuanb',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#satuan').append($('<option></option>').val(nama_pegawai).text(nama_pegawai));	
			output = nama_pegawai;
		  }else {
			$('#satuanbn').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=barang&mode=satuank',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 	
			$('#satuan').append($('<option></option>').val(nama_pegawai).text(nama_pegawai));
			satuanx = nama_pegawai;
			//alert (satuanx);
			output = outputisi+" "+nama_pegawai+"/"+output;
			$("#output").html(output);
			//alert("ok");
		  }else {
			$('#satuankn').val("");
		   }
		}
	  );
	  $.get('../include/cari.php?cari=barang&mode=nama',{id: vNIP},
		function(nama_pegawai){
		  // jika response tidak kosong nilainya maka masukkan nilai ke inputan nama pegawai
		  if(nama_pegawai.length > 0){ 
			$('#namabrg').attr("value", nama_pegawai);
		  }else {
			$('#namabrg').attr("value", "");
		   }
		}
	  );
	}
  );
  
  // beri event pada saat keyup kode pegawai agar kode yang dimasukan font-nya UPPERCASE semua (optional)
  $('input[@name=namarekening]').keyup(
	function(){
	  $(this).val(String($(this).val()).toUpperCase());
	}
  );
});
	
</script>

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
	$(document).ready(function(){
		$("#satuan").change(onSelectChange);
	});

	function onSelectChange(){
		var selected = $("#satuan option:selected");		
		if(selected.val() == satuanx){
			//alert("ok");
			
			hitung();

		} else {
			//hitung();
		}
	}
	</script>
<script type="text/javascript">
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
function clearNum(number){
	while(String(number).indexOf(',') > -1){
	 number = String(number).replace(',','');
	}
	return number;
}
	function hitung(){
		qty = clearNum(document.getElementById("qty").value) * 1;
		harga = clearNum(document.getElementById("harga").value) * 1;
		disc = clearNum(document.getElementById("disc").value) * 1;
		disc2 = clearNum(document.getElementById("disc2").value) * 1;
		disc3 = clearNum(document.getElementById("disc3").value) * 1;
		discrp = clearNum(document.getElementById("discrp").value) * 1;
		if(disc != 0 || disc2 != 0 || disc3 != 0){
			netto = (qty * harga)-((disc + disc2 + disc3) / 100 * harga * qty);
			document.getElementById("discrp").value = formatCurrency((disc + disc2 + disc3) / 100 * harga * qty)
		} else {
			netto = (qty * harga) - discrp;
		}
		
		document.getElementById("netto").value = formatCurrency(netto);
	}
</script>
<link rel='stylesheet' type='text/css' href='jquery.autocomplete.css'/>
    <script type='text/javascript' src='jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}

	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	//nilaix = $('#combobox_carabayar option:selected').val();
	//nilaix = $('#combobox_carabayar').val();
	nilaix = "<?=$_SESSION["sess_tipe"]?>";

	$("#ppk").autocomplete("ajax_auto_barang.php?divisi="+nilaix, {
		width: 300,
		max: 20,
		matchContains: true,
		formatResult: function(row) {
			return row[0];
		}
	});
	$("#ppk").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[1]);
			//--- plus
			$("#brg").val(data[1]);
			// -----
	});
	

});

function kosongtext(){
	document.frmijin.ip.value = "";
	document.frmijin.brg.value = "";
}
function kosongtextarray(){
	$('input[@name=text_array]').click(
	function(){
	  $(this).val('');
	}
  );
}
</script>
	<table width="1140" border="0">
  <tr>
    <td width="32"><img src="../images/calendar.png" width="32" height="32" /></td>
    <td width="1090"><span class="style1">PEMBELIAN / BARANG MASUK 
      </span>
      <hr /></td>
  </tr>
  <tr>
    <td width="32">&nbsp;</td>
    <td>
	
	<table width="663" class="x1">
	<form name="frmijin" id="frmijin" method="post" action="submission_inv.php">
          <input type="hidden" name="cmd" value="add_beli" />
		  <input type="hidden" name="nobukti" value="<?=$_GET['nobukti']?>" />
		  <input type="hidden" name="namasupp" value="<?=$_GET['namasupp']?>" id="namasupp" />
		  <input type="hidden" name="namabrg" value="" id="namabrg" />
		  <input type="hidden" name="nomor" value="<?=$_GET['nomor']?>" />
      <tr>
        <td width="143">No. Nota </td>
        <td width="205"><input type="text" name="nonota" value="<?=$_GET['nonota']?>" class="required" title="*" <? if($_GET['nomor']<>""){ ?>  readonly="true"  <? }?>/></td>
        <td width="107">Tanggal</td>
        <td width="188"><input type="text" name="tgl_transaksi" id="tgl_transaksi" size="10" class="required" title="*" value="<?=$_GET['tgl_transaksi']?>" <? if($_GET['nomor']<>""){ ?>  readonly="true"  <? }?>/>
          <a href="javascript:showCalendar('tgl_transaksi')"><img src="../assets/kalendar_files/calendar_icon.gif" border="0"></a></td>
      </tr>
      <tr>
        <td>Divisi</td>
        <td>
          
            <? if($_SESSION["sess_kelasuser"]<>"User"){?>
			<select name="divisi" id="combobox_carabayar"></select>
            <? } else { ?>
			<select name="divisi" id="divisi" class="required" title="Pilih Divisi">
            <?
			$SQL = "SELECT * FROM divisi WHERE subdiv <> ''";
				$SQL = $SQL . " AND subdiv = '".$_SESSION["sess_tipe"]."'";
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
            <option value="<?=$baris['subdiv']?>" <? if($_GET['divisi']==$baris['subdiv']){?> selected="selected" <? }?>>
            <?=$baris['namadiv']." -- ".$baris['subdiv']?>
            </option>
            <? } ?>
          </select>
		  <? } ?>
		  </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Supplier </td>
        <td>
		<? if($_SESSION["sess_kelasuser"]<>"User"){?>
		<select name="supp" id="combobox_subcarabayar" class="required" title="Harus pilih Supplier"></select>
		<? } else {?>
		<select name="supp" id="combobox_subcarabayar" class="required" title="Pilih Supplier">
		 <option value="">-Pilih-</option>
          <?
			$SQL = "SELECT * FROM supplier WHERE kode <> ''";
			$SQL = $SQL . " AND divisi = '".$_SESSION["sess_tipe"]."'";
				
			$hasil = mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
          <option value="<?=$baris['kode']?>" <? if($_GET['kode']==$baris['kode']){?> selected="selected" <? }?>>
          <?=$baris['nama']?>
          </option>
          <? } ?>
        </select>
		
		<? } ?>		</td>
        <td>Saldo</td>
        <td><input type="text" name="saldo" id="saldo" class="kanan" readonly="true"></td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input type="text" name="alamat" id="alamat" readonly="true" size="40"></td>
        <td>Rek</td>
        <td><input type="text" name="rek" id="rek" readonly="true"></td>
      </tr>
      <tr>
        <td>Kota</td>
        <td><input type="text" name="kota" id="kota" readonly="true"></td>
        <td>Nama Rek </td>
        <td><input type="text" name="namarek" readonly="true"></td>
      </tr>
      <tr>
        <td>Telp.</td>
        <td><input type="text" name="telp" id="telp" readonly="true"></td>
        <td>LPB</td>
        <td><input type="text" readonly="true" id="lpb" name="lpb" value="YFD/<?=nobukti($_GET['nomor'])?>"></td>
      </tr>
    </table>
	<br />
	<table border="1" align="left" cellpadding="3" cellspacing="0" bordercolorlight="silver" bordercolordark="#FFFFFF">
      <? if ($_GET['id']<>"") {?>
      <tr>
        <td background="../images/impactg.png" colspan="11" align="center"><font color="white"><b>Edit Transaksi </b></font></td>
      </tr>
      <? } else { ?>
      <tr>
        <td background="../images/impactg.png" colspan="11" align="center"><strong><font color="white"> TRANSAKSI </font></strong></td>
      </tr>
      <? } ?>
      <tr bgcolor="#FFCC00">
        <td width="34" align="center"><strong>No</strong></td>
        <td align="center">Nama Barang</td>
        <td align="center"><strong>Qty/Satuan</strong></td>
        <td align="center"><strong>Harga <div id="output"></div></strong></td>
		<td align="center"><strong>Disc(%)</strong></td>
		<td align="center"><strong>Disc2(%)</strong></td>
		<td align="center"><strong>Disc3(%)</strong></td>
		<td align="center"><strong>Disc Rp</strong></td>
		<td align="center"><strong>Netto</strong></td>
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
        
          <td align="center"><img src="../images/kal_next.gif" alt="Selanjutnya" border="0" /></td>
          <td align="center"><input name="ip" type="text" id="ppk" class="data-entry-kanan" onclick="kosongtext()" />
          <input name="brg" type="text" id="brg" value="" size="8" readonly="readonly" class="required" title="Kode Barang Harus Terisi !"/></td>
          <td align="center"><input type="text" name="qty" id="qty" size="5" class="required kanan" title="*" onkeyup="hitung()" />
		  <select name="satuan" id="satuan" class="required" title="Satuan Harus terisi"></select>
		  </td>
          <td align="center"><input type="text" name="harga" id="harga"  class="required kanan" title="*" onkeyup="hitung()" /></td>
		  <td align="center"><input type="text" name="disc" id="disc" size="10" class="required kanan" title="*" value="0" onkeyup="hitung()" /></td>
		  <td align="center"><input type="text" name="disc2" id="disc2" size="10" class="required kanan" title="*" value="0"  onkeyup="hitung()" /></td>
		  <td align="center"><input type="text" name="disc3" id="disc3" size="10" class="required kanan" title="*" value="0"  onkeyup="hitung()" /></td>
		  <td align="center"><input type="text" id="discrp" name="discrp" size="15" class="required kanan" title="*" value="0" onkeyup="hitung()" /></td>
		  <td align="center"><input type="text" id="netto" name="netto" size="15" class="required kanan" title="*" value="0" readonly="true" /></td>
          <td align="center" colspan="4"><input name="image" type="image" src="../images/add.gif" border="0" /></td>
        </form>
      </tr>
      <? } ?>
      <?
	  	
		$SQLj = "SELECT * FROM mutasi WHERE status = 1 AND nomor = '".$_GET['nomor']."'";
		//echo $SQLj; 		
		$hasilj = mysql_query($SQLj);
		$nRecord = 1;
		if (mysql_num_rows($hasilj) > 0) { 
		while ($row=mysql_fetch_array($hasilj)) { 
	?>
      <tr <?	 if (($nRecord % 2)==0) {?>bgcolor="#FFFFFF"<? } else {?> else="else" bgcolor="#CCCCCC"<? }?>>
        <form action="submission_inv.php" method="post" name="frmijin" id="frmijin">
          <input type="hidden" name="id" value="<?=$_GET['id']?>" />
          <input type="hidden" name="cmd" value="ngaco" />
          <td align="center"><?=$nRecord?></td>
          <td align="center"><?=($row['kodebrg'])?> - <?=$row['namabrg']?></td>
          <td align="left"><?=$row['qtyin']?>&nbsp;<?=$row['satuan']?></td>
          <td align="right"><?=number_format($row["harga"],2,'.',',');?></td>
		  <td align="right"><?=number_format($row["disc"],2,'.',',');?></td>
		  <td align="right"><?=number_format($row["disc2"],2,'.',',');?></td>
		  <td align="right"><?=number_format($row["disc3"],2,'.',',');?></td>
		   <td align="right"><?=number_format($row["discrp"],2,'.',',');?></td>
		  <td align="right"><?=number_format($row["debet"],2,'.',',');?></td>
		  <? $t_debet = $t_debet + $row["debet"]; ?>
          <? if ($_GET['id']<>"") { ?>
          <td align="center"><input name="image" type="image" src="../images/approve.gif" border="0" /></td>
          <td align="center"><a href="javascript:history.back()"><img src="../images/kal_prev.gif" alt="Sebelumnya" border="0" /></a></td>
          <? } else { ?>
          <td align="center"><a href="?mn=<?=$_GET['mn']?>&amp;id=<?=$row["norek"]?>"></a></td>
          <td align="center"><a href="javascript:confirmDelete('submission_inv.php?id=<?=$row["id"]?>&cmd=del_beli&nonota=<?=$_GET['nonota']?>&supp=<?=$_GET['supp']?>&alamat=<?=$_GET['alamat']?>&kota=<?=$_GET['kota']?>&telp=<?=$_GET['telp']?>&tgl_transaksi=<?=$_GET['tgl_transaksi']?>&saldo=<?=$_GET['saldo']?>&rek=<?=$_GET['rek']?>&namarek=<?=$_GET['namarek']?>&nomor=<?=$_GET['nomor']?>&namasupp=<?=$_GET['namasupp']?>&brg=<?=$row['kodebrg']?>&qtyin=<?=$row['qtyin']?>&netto=<?=$row["debet"]?>')">
		  <img src="../images/hapus.gif" alt="Hapus" border="0" /></a></td>
          <? } ?>
        </form>
      </tr>
      <?  
		 $nRecord = $nRecord + 1;
		} ?>
		<tr>
		  <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="center">&nbsp;</td>
	      <td align="right">&nbsp;</td>
	      <td align="right"><?=number_format($t_debet,2,'.',',');?></td>
	      <td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="20" align="center">
			<a href="index.php?mn=pembelian">[ SELESAI ATAU KE NOMOR LPB BERIKUTNYA ]</a>
		  </td>
		</tr>
		<?
	} else { ?>
      <tr>
        <td align="center" colspan="11"><font color="red">Mohon maaf, tidak ada Data dimaksud.</font></td>
      </tr>
      <?  } ?>
    </table>	
	<p>&nbsp;</p></td>
  </tr>
</table>
