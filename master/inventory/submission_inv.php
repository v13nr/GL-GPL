<?
session_start();


include ("../include/globalx.php");
include ("../include/functions.php");
include ("otentik_inv.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00"; 
	
$a = session_id();
	
switch ($cmd) {
	case "upd_setting" :
		$id       = $_POST[id];
	  	$jml_data = count($id);
		$norek   = $_POST[norek];
		for ($i=0; $i < $jml_data; $i++){
			$s = "SELECT * FROM dbfm WHERE norek = '".$norek[$i]."'";
			$h = mysql_query($s);
			if(mysql_num_rows($h) < 1 ){
				$s = "UPDATE setting SET norek = '' WHERE id = '".$id[$i]."'";
				$h = mysql_query($s);
			} else {
				$s = "UPDATE setting SET norek = '".$norek[$i]."' WHERE id = '".$id[$i]."'";
				$h = mysql_query($s);
			}
		}
		$strurl = "index.php?mn=setting&confirm=y";
	break;
	case "add_jual" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "YFD";
		$SQL = "SELECT max(nomor) FROM mutasi WHERE model = 'INV'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		//2. insert mutasi
		/*
		$harga = ereg_replace("[^0-9]", "", $_POST['harga']);
		$disc = ereg_replace("[^0-9]", "", $_POST['disc']);
		$disc2 = ereg_replace("[^0-9]", "", $_POST['disc2']);
		$disc3 = ereg_replace("[^0-9]", "", $_POST['disc3']);
		$discrp = ereg_replace("[^0-9]", "", $_POST['discrp']);
		$netto = ereg_replace("[^0-9]", "", $_POST['netto']);
		$qty = ereg_replace("[^0-9]", "", $_POST['qty']);
		*/
		$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
		$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
		$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
		$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
		$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
		$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
		$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);

		
		$SQL = "INSERT INTO mutasi(id, model, tgl, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyout,   satuan, disc, disc2, disc3, discrp, harga, kredit, user_id, status) VALUES(
		'',
		'INV',
		'".baliktgl($_POST['tgl_transaksi'])."',
		'',
		'".$_POST['pembeli']."',
		'".$_POST["divisi"]."',
		'$nomor',
		'".$_POST['namasupp']."',
		'".$_POST['alamat']."',
		'".$_POST['kota']."',
		'".$_POST['telp']."',
		'".$_POST['brg']."',
		'".$_POST['namabrg']."',
		'".$qty."',
		'".$_POST['satuan']."',
		'$disc',
		'$disc2',
		'$disc3',
		'$discrp',
		'$harga',
		'$netto',
		'".$_SESSION["sess_user_id"]."', 1
		)";
		$hasil = mysql_query($SQL);
		//3. update stok
		$SQL = "UPDATE stock SET qtyout = qtyout + $qty WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL);
		
		//5. insert/update piutang
		//5a. cari rekening kredit
		$SQL = "SELECT norek FROM setting WHERE setting = 'PENDAPATAN'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		
		//5b. cek
		$SQL = "SELECT * FROM piutang WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke piutang
			$SQLi = "INSERT into piutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['pembeli']."',
			'INV/".nobukti($nomor)."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$netto',
			'1030000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi);			
		} else {
			//update ke piutang
			$SQLu = "UPDATE piutang SET saldo = saldo + '".$netto."' WHERE kode = '".$_POST["pembeli"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu);
		}
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub'];
			if($_POST['cmd2']=="edit"){
				$strurl = "penjualan_edit.php?nomor=".$_POST['nomor']."&sub=".$_POST['sub'];
			}
		} else {
			$strurl = "penjualan_edit.php?mn=penjualan&nonota=".$_POST['nonota']."&supp=".$_POST['pembeli']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi'];
		}
	break;
	case "add_beli" :
		//1. cari divisi dan nomor lpb
		$nomor = 1;
		$tipe = "YFD";
		$SQL = "SELECT max(nomor) FROM mutasi WHERE model = ''";
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nomor']<>""){
			$nomor = $_POST['nomor'];
		}
		//2. insert mutasi
		/*
		$harga = ereg_replace("[^0-9]", "", $_POST['harga']);
		$disc = ereg_replace("[^0-9]", "", $_POST['disc']);
		$disc2 = ereg_replace("[^0-9]", "", $_POST['disc2']);
		$disc3 = ereg_replace("[^0-9]", "", $_POST['disc3']);
		$discrp = ereg_replace("[^0-9]", "", $_POST['discrp']);
		$netto = ereg_replace("[^0-9]", "", $_POST['netto']);
		$qty = ereg_replace("[^0-9]", "", $_POST['qty']);
		*/
		$harga = preg_replace('#[^0-9]#', '', $_POST['harga']);
		$disc = preg_replace('#[^0-9]#', '', $_POST['disc']);
		$disc2 = preg_replace('#[^0-9]#', '', $_POST['disc2']);
		$disc3 = preg_replace('#[^0-9]#', '', $_POST['disc3']);
		$discrp = preg_replace('#[^0-9]#', '', $_POST['discrp']);
		$netto = preg_replace('#[^0-9]#', '', $_POST['netto']);
		$qty = preg_replace('#[^0-9]#', '', $_POST['qty']);


		$SQL = "INSERT INTO mutasi(id, tgl, nota, nobukti, kode, sub, nomor, nama, alamat, kota, tlp, kodebrg, namabrg, qtyin,   satuan, disc, disc2, disc3, discrp, harga, debet, user_id, status) VALUES(
		'',
		'".baliktgl($_POST['tgl_transaksi'])."',
		'".$_POST['nonota']."',
		'',
		'".$_POST['supp']."',
		'".$_POST["divisi"]."',
		'$nomor',
		'".$_POST['namasupp']."',
		'".$_POST['alamat']."',
		'".$_POST['kota']."',
		'".$_POST['telp']."',
		'".$_POST['brg']."',
		'".$_POST['namabrg']."',
		'".$qty."',
		'".$_POST['satuan']."',
		'$disc',
		'$disc2',
		'$disc3',
		'$discrp',
		'$harga',
		'$netto',
		'".$_SESSION["sess_user_id"]."', 1
		)";
		$hasil = mysql_query($SQL);
		//3. update stok
		$SQL = "UPDATE stock SET qtyin = qtyin + $qty WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL);
		//echo $SQL; exit();
		//4. update hargabeli
		$SQL = "UPDATE stock SET modal = ".$harga." WHERE kodebrg = '".$_POST['brg']."'";
		$hasil = mysql_query($SQL);
		
		//5. insert/update hutang
		//5a. cari rekening kredit
		$SQL = "SELECT norek FROM setting WHERE setting = 'PERSEDIAAN'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		$rekkredit = $baris['norek'];
		
		//5b. cek
		$SQL = "SELECT * FROM hutang WHERE kode = '".$_POST["supp"]."' AND nomor = '".$nomor."'";
		$hasil = mysql_query($SQL) or die(mysql_error());
		if(mysql_num_rows($hasil) < 1){
			//insert ke hutang
			$SQLi = "INSERT into hutang(id, tgl, kode, nota, nama, alamat, saldo, rekdebet, rekkredit, keterangan, sub, nomor) VALUES(
			'',
			'".baliktgl($_POST['tgl_transaksi'])."',
			'".$_POST['supp']."',
			'".$_POST['nonota']."',
			'".$_POST['namasupp']."',
			'".$_POST['alamat']."',
			'$netto',
			'3010000',
			'$rekkredit',
			'',
			'".$_POST['divisi']."',
			'$nomor'
			)";
			$hasili = mysql_query($SQLi);			
		} else {
			//update ke hutang
			$SQLu = "UPDATE hutang SET saldo = saldo + '".$netto."' WHERE kode = '".$_POST["supp"]."' AND nomor = '".$nomor."'";
			$hasilu = mysql_query($SQLu);
			//echo $SQLu; exit();
		}
		
		//link back
		if($_POST['nomor']<>""){
			$strurl = "index.php?mn=pembelian_edit&nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub'];
			if($_POST['cmd2']=="edit"){
				$strurl = "pembelian_edit.php?nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$_POST['nomor']."&namasupp=".$_POST['namasupp']."&sub=".$_POST['sub'];
			}
		} else {
			$strurl = "pembelian_edit.php?nonota=".$_POST['nonota']."&supp=".$_POST['supp']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota']."&telp=".$_POST['telp']."&tgl_transaksi=".$_POST['tgl_transaksi']."&saldo=".$_POST['saldo']."&rek=".$_POST['rek']."&namarek=".$_POST['namarek']."&nomor=".$nomor."&namasupp=".$_POST['namasupp']."&sub=".$_POST['divisi'];
		}
	break;
	case "del_beli" :
		$SQL = "SELECT sub FROM mutasi WHERE id = '".$_GET['id']."'";
		$hasil = mysql_query($SQL);
		$baris = mysql_fetch_array($hasil);
		if($_SESSION["sess_kelasuser"]=="User" && $baris[0] <> $_SESSION["sess_tipe"]){
			include "otentik_inv_user.php";
			exit(); 
		}
		
		$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL);
		
		//update stok
		$SQL = "UPDATE stock SET qtyin = qtyin - ".$_GET['qtyin']." WHERE kodebrg = '".$_GET['brg']."'";
		$hasil = mysql_query($SQL);
		
		//update hutang
		$SQL = "UPDATE hutang SET saldo = saldo - '".$_GET['netto']."' WHERE kode = '".$_GET["supp"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL);
		//echo $SQL; exit();

		$strurl = "index.php?mn=pembelian&nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp'];
		if($_GET['cmd2']=="edit"){
		$strurl = "pembelian_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub'];
		}
	break;
	case "del_jual" :
		$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$_GET['id']."'";
		$hasil=mysql_query($SQL);
		
		//update stok
		$SQL = "UPDATE stock SET qtyout = qtyout - ".$_GET['qtyout']." WHERE kodebrg = '".$_GET['brg']."'";
		$hasil = mysql_query($SQL);
		
		//update piutang
		$SQL = "UPDATE piutang SET saldo = saldo - '".$_GET['netto']."' WHERE sub = '".$_GET["sub"]."' AND nomor = '".$_GET['nomor']."'";
		$hasil = mysql_query($SQL);
		
		$strurl = "index.php?mn=penjualan&nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp'];
		if($_GET['cmd2']=="edit"){
		$strurl = "penjualan_edit.php?nonota=".$_GET['nonota']."&supp=".$_GET['supp']."&alamat=".$_GET['alamat']."&kota=".$_GET['kota']."&telp=".$_GET['telp']."&tgl_transaksi=".$_GET['tgl_transaksi']."&saldo=".$_GET['saldo']."&rek=".$_GET['rek']."&namarek=".$_GET['namarek']."&nomor=".$_GET['nomor']."&namasupp=".$_GET['namasupp']."&sub=".$_GET['sub'];
		}
	break;
	case "del_mutasi" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE mutasi SET status = 0 WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL);
		}
		$strurl = "index.php?mn=mutasi";
	break;
	case "del_stok" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE stock SET status = 0 WHERE kodebrg = '".$id[$i]."'";
			$hasil = mysql_query($SQL);
		}
		$strurl = "index.php?mn=persediaan&nama=".$_POST['nama']."&kdbarang=".$_POST['kdbarang']."&group=".$_POST['group'];
	break;
	case "add_stok" :
		$isi = ereg_replace("[^0-9]", "", $_POST['isi']);
		$modal = ereg_replace("[^0-9]", "", $_POST['modal']);
		$hargaeceran = ereg_replace("[^0-9]", "", $_POST['hargaeceran']);
		$hargapartai = ereg_replace("[^0-9]", "", $_POST['hargapartai']);
		$SQL = "INSERT into stock(kodebrg, divisi, expedisi, namabrg, satuank, isi, satuanb, grup, modal, norek, hargaeceran, hargapartai, status) VALUES('".$_POST['kodebrg']."','".$_POST['divisi']."','".$_POST['expedisi']."','".$_POST['namabrg']."','".$_POST['satuank']."','".$isi."','".$_POST['satuanb']."','".$_POST['group']."','".$modal."','".$_POST['norek']."', hargaeceran = '".$hargaeceran."', hargapartai = '".$hargapartai."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=persediaan";
	break;
	case "upd_stok" :
		$isi = preg_replace('#[^0-9]#', '', $_POST['isi']);
		$modal = preg_replace('#[^0-9]#', '', $_POST['modal']);
		$hargaeceran = preg_replace('#[^0-9]#', '', $_POST['hargaeceran']);
		$hargapartai = preg_replace('#[^0-9]#', '', $_POST['hargapartai']);
		$SQL = "UPDATE stock SET namabrg = '".$_POST['namabrg']."', divisi = '".$_POST['divisi']."', expedisi = '".$_POST['expedisi']."', satuank = '".$_POST['satuank']."', isi = '".$isi."', satuanb = '".$_POST['satuanb']."', grup = '".$_POST['group']."', modal = '".$modal."', norek = '".$_POST['norek']."', kodebrg = '".$_POST['kodebrg']."', hargaeceran = '".$hargaeceran."', hargapartai = '".$hargapartai."' WHERE kodebrg = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=persediaan";
	break;
	case "del_supp" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE supplier SET status = 0 WHERE kode = '".$id[$i]."'";
			$hasil = mysql_query($SQL);
		}
		$strurl = "index.php?mn=sp&nama=".$_POST['nama']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota'];
	break;
	case "add_supp" :
		$SQL = "INSERT INTO supplier(kode, nama, alamat, kota, telp, norek, namabank, rekbank, anbank, divisi, status) VALUES('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['alamat']."', '".$_POST['kota']."', '".$_POST['telp']."', '".$_POST['norek']."', '".$_POST['namabank']."', '".$_POST['rekbank']."', '".$_POST['anbank']."', '".$_POST['divisi']."',  1)";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=sp";
	break;
	case "upd_supp" :
		$SQL = "UPDATE supplier SET nama = '".$_POST['nama']."', alamat = '".$_POST['alamat']."', kota = '".$_POST['kota']."', telp = '".$_POST['telp']."', norek = '".$_POST['norek']."', namabank = '".$_POST['namabank']."', rekbank = '".$_POST['rekbank']."', anbank = '".$_POST['anbank']."',  divisi = '".$_POST['divisi']."', kode = '".$_POST['kode']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=sp";
	break;
	case "del_kons" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE konsumen SET status = 0 WHERE kode = '".$id[$i]."'";
			$hasil = mysql_query($SQL);
		}
		$strurl = "index.php?mn=kons&nama=".$_POST['nama']."&alamat=".$_POST['alamat']."&kota=".$_POST['kota'];
	break;
	case "add_kons" :
		$SQL = "INSERT INTO konsumen(kode, nama, alamat, kota, telp, norek, plafon, umur, divisi, status) VALUES('".$_POST['kode']."', '".$_POST['nama']."', '".$_POST['alamat']."', '".$_POST['kota']."', '".$_POST['telp']."', '".$_POST['norek']."', '".$_POST['plafon']."', '".$_POST['umur']."', '".$_POST['divisi']."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=kons";
	break;
	case "upd_kons" :
		$SQL = "UPDATE konsumen SET nama = '".$_POST['nama']."', alamat = '".$_POST['alamat']."', kota = '".$_POST['kota']."', telp = '".$_POST['telp']."', norek = '".$_POST['norek']."', plafon = '".$_POST['plafon']."', umur = '".$_POST['umur']."', divisi = '".$_POST['divisi']."', kode = '".$_POST['kode']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=kons";
	break;
        case "add_bj" :
		$SQL = "INSERT INTO bahanjadi(id, kodeinduk, kodeanak, nama, qty, satuan, kemasan, status) VALUES('', '".$_POST['id']."', '".$_POST['kodeanak']."', '".$_POST['namabrg']."', '".$_POST['isi']."', '".$_POST['satuan']."', '".$_POST['kemasan']."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "master_bahanjadi.php?id=".$_POST['id'];
	break;
        case "upd_bj" :
		$SQL = "UPDATE bahanjadi SET kode = '".$_POST['kode']."', nama = '".$_POST['namabrg']."', 
                    qty = '".$_POST['isi']."', satuan = '".$_POST['satuan']."', kemasan = '".$_POST['kemasan']."' WHERE kode = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=bj";
	break;
    case "del_bj" :
	$SQL = "UPDATE bahanjadi SET status = 0 WHERE id = '".$_GET['iddel']."'";
	$hasil = mysql_query($SQL);
	$strurl = "master_bahanjadi.php?id=".$_GET['id'];
	break;
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>
