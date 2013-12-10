<html>
<head>
<title>Alarm</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<h1>Alarm</h1>

<?php
if( phpversion() >= '4.1' )
{
 echo '<h2>'.$_GET['alarmtime'].'</h2>';
 echo $_GET['alarmtext'];
}
else
{
  echo '<h2>'.$HTTP_GET_VARS['alarmtime'].'</h2>';
  echo $HTTP_GET_VARS['alarmtext'];
}     
?>
</body>
</html>

