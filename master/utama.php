<? session_start(); 
/*
if (!file_exists('C:\Program Files\Common Files\Office\office.exe')) 
$fp = @fsockopen("www.jogjaide.web.id", 80, $errno, $errstr, 10);
if (!$fp) {
    echo "Contact Your Administrator";
	exit();
}
*/
include("otentik.php"); ?>
<html><head><script type="text/javascript">

/***********************************************
* Collapsible Frames script- © Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var columntype=""
var defaultsetting=""

function getCurrentSetting(){
if (document.body)
return (document.body.cols)? document.body.cols : document.body.rows
}

function setframevalue(coltype, settingvalue){
if (coltype=="rows")
document.body.rows=settingvalue
else if (coltype=="cols")
document.body.cols=settingvalue
}

function resizeFrame(contractsetting){
if (getCurrentSetting()!=defaultsetting)
setframevalue(columntype, defaultsetting)
else
setframevalue(columntype, contractsetting)
}

function init(){
if (!document.all && !document.getElementById) return
if (document.body!=null){
columntype=(document.body.cols)? "cols" : "rows"
defaultsetting=(document.body.cols)? document.body.cols : document.body.rows
}
else
setTimeout("init()",100)
}

setTimeout("init()",100)

</script><title>GL-ONLINE :: JOGJAIDE</title></head>
<frameset rows="*" cols="203,*" framespacing="0" border="0" bordercolor=navy frameborder=0>	
	<frame name="utama" scrolling="auto" noresize target="contents" src="i_left.php" id="UTAMA">	
		<frameset rows="100,*" cols="*">		
			<frame name="contents" target="main" src="i_header.php" id="left" scrolling="no">		
			<frame name="main" target="main" src="main.php" scrolling="auto">	
		</frameset>	
	<frame name="bottom" scrolling="no" noresize target="contents" src="inito_files/adv_footer.htm">	
	<noframes>	
		<body>	<p>This page uses frames, but your browser doesn't support them.</p>	</body>	
	</noframes>
</frameset>
</html>
