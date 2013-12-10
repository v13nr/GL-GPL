<? include "include/globalx.php"; 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title>jQuery treeView</title>
	
	<link rel="stylesheet" href="treeview/jquery.treeview.css" />
	<script type="text/javascript" src="treeview/jquery.min.js"></script>
	<script src="treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="treeview/demo/demo.js"></script>

<script type='text/javascript'>
function do_scroll(point)
{
	$('html').animate({
		scrollTop: point
	}, 500);
}
  function show(page, div){
    do_scroll(0);
	var site = "<?=$site_path?>";
    $.ajax({
      url: site+"/"+page,
      success: function(response){			
        $(div).html(response);
      },
      dataType:"html"  		
    });
    return false;
  }
  function showx(page, div){
    do_scroll(0);
	var site = "<?=$site_path?>";
    url= site+"/"+page;
	top.frames['main'].location.href = url; 	      
    return false;
  }  

</script>
</head>
	<body>

<? if(isset($_SESSION["is_login"])){?>	
<ul id="browser" class="filetree">
		<li><span class="folder">Profilku</span>
			<ul>
				<li><span class="file"><a href="user/index.php?mn=passwd" onclick='showx("user/index.php?mn=passwd","#content")' >Ubah Password</a></span></li>
			</ul>
		</li>
		<?
			$SQL = "SELECT *, a.id as ibu1 FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = 0 AND b.user_id = '".$_SESSION["sess_user_id"]."'";
			$hasil= mysql_query($SQL);
			while($baris = mysql_fetch_array($hasil)){
		?>
		<li><span class="folder"><?=$baris['title']?></span>
			<ul>
			<?
					$SQLa = "SELECT *, a.id as ibu2 FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = '".$baris['ibu1']."' AND b.user_id = '".$_SESSION["sess_user_id"]."'";
					//echo $SQLa; exit();
					$hasila= mysql_query($SQLa);
					while($barisa = mysql_fetch_array($hasila)){
				?>
				<li class="closed"><span class="folder"><?=$barisa['title']?></span>
					<ul id="adsen_setup main">
						<?
							$SQLab = "SELECT * FROM jo_menu a, jo_menu_detail b WHERE a.id = b.menu_id AND a.status = 1 AND a.aktif = 1 AND a.parent_id = '".$barisa['ibu2']."' AND b.user_id = '".$_SESSION["sess_user_id"]."'";
							$hasilab= mysql_query($SQLab);
							//echo $SQLab; exit();
							while($barisab = mysql_fetch_array($hasilab)){
						?>	
						<!--
						<li><span class="file"><a href="javascript:void(0)"  onclick='showx("<?=$barisab['url']?>","#content")'"><?=$barisab['title']?></a></span></li>
						-->
						<li><span class="file"><a href="<?=$barisab['url']?>"  onclick='showx("<?=$barisab['url']?>","#content")'"><?=$barisab['title']?></a></span></li>
						<? } // end of child 2?>
					</ul>
				</li>
				<? } // end of child 1?>
			</ul>
		</li>
		<? } //end of parent_id = 0?>
		
</ul>
<? } //endif login?>	
    <div id="content">

    </div>
</body></html>
