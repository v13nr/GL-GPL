<? include ("include/globalx.php"); ?>
<title>GL-ONLINE v.1.0 By Jogjaide</title>
<link rel="stylesheet" type="text/css" href="style.css">

<script language="JavaScript">

<!--

  // javascript:window.history.forward(1);

//-->

</script>

<? if ($_GET['err']<>"") { ?>

	<script language="JavaScript">

	<!--

		alert ("Maaf, Data Login yang Anda masukkan tidak terdaftar. \nTerima kasih.");

	//-->

	</script>

<? } ?>
<script type="text/javascript" src="assets/jquery.min.js"></script>

<script type="text/javascript" src="assets/fadeslideshow.js">

/***********************************************
* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>

<script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [250, 180], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		["images/slide/ak-1.jpeg", "http://jogjaide.web.id", "_new", "Dikembangkan oleh www.jogjaide.web.id"],
		["images/slide/ak-2.jpeg", "http://ilugroup.com", "_new", ""],
//		["images/slide/congrat.jpg"],
		["images/slide/ak-3.jpeg", "http://nanang.comuv.com", "_new", "Diprogram oleh Nanang Rustianto."] //<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	descreveal: "ondemand",
	togglerid: ""
})

</script>
<body leftmargin=0 topmargin=0 background="images/belontahu.jpg">



<BR><BR><BR><BR><BR><BR>

<div align="center">

<table border="1" bordercolor=white width="350" cellspacing="0" cellpadding="2">

  <tr>

    <td colspan="2" height=20 bgcolor="silver"><p align="center"><table border="1" bordercolor=white  bgcolor="#FFFFFF" width="349" height="179"><tr><td align="center"><div id="fadeshow1"></div></td></tr></table><BR>

      <b><font size="4">GL - ONLINE </font><BR>

       </b></td>



  </tr>

  

  <form action="sb_login.php" method="post">

		<input type=hidden name="cmd" value="">

		<input type=hidden name="tipe" value="1">

  <tr bgcolor=gold>

    <td bgcolor=gold><p align="right">User Name  :</td>

    <td><input type=text class="form_isian" size=10 maxlength="20" name="user_name" value=""></td>

  </tr>



  <tr bgcolor=gold>

    <td bgcolor=gold><p align="right">PASSWORD :</td>

    <td><input type=password class="form_isian" size=10 maxlength="20" name="passwd" value=""></td>

  </tr>

  <tr bgcolor=gold>

    <td>&nbsp;</td>

    <td><input type=submit name="Tombol" value="LOGIN" class="tombol"></td>

  </tr></form>



  <tr>

    <td align="center" colspan="2" height=20 bgcolor="silver"><strong>Develop by : <a href="http://www.jogjaide.web.id">JOGJAIDE</a> &copy; 2011</strong><br> 
    Programmer : Nanang Rustianto</td>

  </tr>

</table><br>
</div>
