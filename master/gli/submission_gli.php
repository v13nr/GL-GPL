<?
session_start();
include ("../include/globalx.php");
include ("../include/functions.php");
include ("otentik_gli.php");

$cmd = $_POST['cmd'];
if ($cmd==""){
	$cmd = $_GET['cmd'];
}

		date_default_timezone_set('Asia/Shanghai');
		$wkt_disimpan = Date("Y-m-d H:i:s");
		$xbulan = $_REQUEST['slBulan'];
		$xtanggal = $_REQUEST['slTanggal'];
		$TanggalLahir=$_REQUEST['slTahun']."-".$xbulan."-".$xtanggal." 00:00:00"; 
		
switch ($cmd) {
	case "upd_inv" :
		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
		$SQL = "UPDATE aktiva SET tgl = '".baliktgl($_POST['tgl'])."', nama = '".$_POST['nama']."', nilai = '".$nilai."', bagi = '".$_POST['bagi']."', susut = '".$susut."', tgl_akhir = '".baliktgl($_POST['tgl_akhir'])."', rekdebet = '".$_POST['rekdebet']."', rekkredit = '".$_POST['rekkredit']."' WHERE id = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=inv";
	break;
	case "add_inv" :
		$nilai = ereg_replace("[^0-9]", "", $_POST['nilai']);
		$susut = ereg_replace("[^0-9]", "", $_POST['susut']);
		$SQL = "INSERT INTO aktiva(id, tgl, nama, nilai, bagi, susut, tgl_akhir, rekdebet, rekkredit, divisi, user_id, status) VALUES('', '".baliktgl($_POST['tgl'])."', '".$_POST['nama']."', '".$nilai."', '".$_POST['bagi']."', '".$susut."', '".baliktgl($_POST['tgl_akhir'])."', '".$_POST['rekdebet']."', '".$_POST['rekkredit']."', '".$_SESSION["sess_tipe"]."', '".$_SESSION["sess_user_id"]."', 1)";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=inv";
	break;
	case "del_aktiva" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "UPDATE aktiva SET status = 0 WHERE id = '".$id[$i]."'";
			$hasil = mysql_query($SQL);
		}
		$strurl = "index.php?mn=inv";
	break;
	case "add_divisi" :
		$SQL = "Insert into divisi(subdiv, namadiv) VALUES('".$_POST['subdiv']."', '".$_POST['namadiv']."')";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=div";
	break;
	case "upd_divisi" :
		$SQL = "UPDATE divisi SET subdiv = '".$_POST['subdiv']."', namadiv = '".$_POST['namadiv']."' WHERE subdiv = '".$_POST['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=div";
	break;
	case "del_divisi" :
		$SQL = "DELETE FROM divisi WHERE subdiv = '".$_GET['id']."'";
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=div";
	break;
	case "add_rekeningp" :
		$SQL = "INSERT INTO dbfm(norek, namarek, tipe, saldoawal, debet, kredit, saldoakhir, status) VALUES('".$_POST['induk'].$_POST['norek']."', '".$_POST['namarekening']."', '".$_POST['tipe']."', '".$_POST['saldoawal']."', '".$_POST['debet']."', '".$_POST['kredit']."', '".$_POST['saldoakhir']."', 1)";
		$hasil = mysql_query($SQL, $dbh1);
		$strurl = "index.php?mn=rekp";
	break;
	case "upd_rekeningp" :
		$SQL = "UPDATE dbfm SET namarek = '".$_POST['namarekening']."', tipe = '".$_POST['tipe']."', saldoawal = '".$_POST['saldoawal']."', debet = '".$_POST['debet']."', kredit = '".$_POST['kredit']."', saldoakhir = '".$_POST['saldoakhir']."' WHERE norek = '".$_POST['induk'].$_POST['norek']."'";
		$hasil = mysql_query($SQL, $dbh1);
		$strurl = "index.php?mn=rekp";
	break;
	case "add_rekening" :
		$SQL = "INSERT INTO rek(norek, namarek, tipe, tglinput, status) VALUES('".$_POST['norek']."', '".$_POST['namarek']."', '".$_POST['tipe']."', '".$wkt_disimpan."', 1)";
		$hasil = mysql_query($SQL, $dbh1);
		//insert juga ke rek pembantu
		$SQL = "INSERT INTO dbfm(norek, namarek, tipe, status) VALUES('".$_POST['norek']."000', '".$_POST['namarek']."', '".$_POST['tipe']."', 1)";
		$hasil = mysql_query($SQL, $dbh1);
		$strurl = "index.php?mn=rek";
	break;
	case "upd_rekening" :
		$SQL = "UPDATE rek SET norek = '".$_POST['norek']."', namarek = '".$_POST['namarek']."', tipe = '".$_POST['tipe']."' WHERE norek = '".$_POST['id']."'";
		$hasil = mysql_query($SQL, $dbh1);
		//update juga ke rekning pembantu
		$SQL = "UPDATE dbfm SET namarek = '".$_POST['namarek']."', tipe = '".$_POST['tipe']."' WHERE norek = '".$_POST['id'].'000'."'";
		$hasil = mysql_query($SQL, $dbh1);
		$SQL = "UPDATE dbfm SET tipe = '".$_POST['tipe']."' WHERE norek LIKE '".$_POST['id']."%'";
		$hasil = mysql_query($SQL, $dbh1);
		$strurl = "index.php?mn=rek";
	break;
	case "del_rekening" :
		$SQL = "DELETE FROM rek WHERE norek = '".$_GET['id']."'";
		$hasil = mysql_query($SQL, $dbh1);
		//delete juga di rek pembantu
		$SQL = "DELETE FROM dbfm where norek = '".$_GET['id'].'000'."'";
		$hasil=mysql_query($SQL);
		$strurl = "index.php?mn=rek";
	break;
	case "del_rekp" :
		$id = $_POST[tambah];
		$banyaknya = count($id);
		for ($i=0; $i<$banyaknya; $i++) {
			$SQL = "DELETE FROM dbfm where norek = '".$id[$i]."'";
			$hasil=mysql_query($SQL);
		}
		$strurl = "index.php?mn=rekp";
	break;
	case "add_jurnal" :
		//1. cari divisi dan nomor jurnal
		$nomor = 1;
		$tipe = "YFD";
		//13/08/2011
		$bulan = substr($_POST['tgl_transaksi'],3,2).substr($_POST['tgl_transaksi'],6,4);
		$SQL = "SELECT max(nobukti) FROM dbfj WHERE bulan = '$bulan'";
		//echo $SQL; exit();
		$hasil = mysql_query($SQL) or die(mysql_error());
		$baris = mysql_fetch_array($hasil);
		if ($baris[0]>=0) {
			$nomor = $baris[0] + 1;
		}
		if($_POST['nobukti']<>""){
			$nomor = $_POST['nobukti'];
		}
		//2. input jurnal
			
			$jumlah = ereg_replace("[^0-9]", "", $_POST['jumlah']);
			if($_POST['dk']=="Kredit"){
				$SQL = "INSERT INTO dbfj(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'".$_POST['dk']."',
				'".$_POST['norek2']."',
				'".$_POST['norek']."',
				'".$_POST['keterangantransaksi']."',
				'".$_POST['keteranganheader']."',
				'".$jumlah."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
			}
			if($_POST['dk']=="Debet"){
				$SQL = "INSERT INTO dbfj(id, tanggal, jenis, kd, kk, ket, ket2, jumlah, dollar, sub, divisi, nobukti, bulan, user_id) VALUES (
				'',
				'".baliktgl($_POST['tgl_transaksi'])."',
				'".$_POST['dk']."',
				'".$_POST['norek']."',
				'".$_POST['norek2']."',
				'".$_POST['keteranganheader']."',
				'".$_POST['keterangantransaksi']."',
				'".$jumlah."',
				'".$_POST['dollar']."',
				'$tipe',
				'".$_POST['divisi']."',
				'$nomor',
				'$bulan',
				'".$_SESSION["sess_user_id"]."'
				)";
			}
			//echo $SQL;
			//exit();
			$hasil = mysql_query($SQL);
		
		
		//3. lempar nilai default
		if($_POST['nobukti']<>""){
			$strurl = "index.php?mn=trans_jurnal&nobukti=".$_POST['nobukti']
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$_POST['bulan']
			;
		} else {
			$strurl = "index.php?mn=trans_jurnal&nobukti=".$nomor
			."&tgl_transaksi=".$_POST['tgl_transaksi']
			."&divisi=".$_POST['divisi']
			."&dk=".$_POST['dk']
			."&norek=".$_POST['norek']
			."&namarek=".$_POST['namarek']
			."&keteranganheader=".$_POST['keteranganheader']
			."&bulan=".$bulan
			;	
		}
	break;
	case "del_jurnal" :
		$SQL = "DELETE FROM dbfj WHERE id = ".$_GET['id'];
		$hasil = mysql_query($SQL);
		$strurl = "index.php?mn=trans_jurnal&nobukti=".$_GET['nobukti']
			."&tgl_transaksi=".$_GET['tgl_transaksi']
			."&dk=".$_GET['dk']
			."&norek=".$_GET['norek']
			."&namarek=".$_GET['namarek']
			."&keteranganheader=".$_GET['keteranganheader'];
	break;
	
}
//echo $SQL; echo "<br>"; echo $strurl; echo "<br>"; echo $cmd; 
header("location: ".$strurl);
?>