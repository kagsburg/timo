<?php
administratorlog();

function administratorlog(){
   echo"<!DOCTYPE html>";
   echo"<html>";
   echo"<head>";
   echo"<style type='text/css'>";
   echo"div{";
   echo"padding-top:20pt;";
   echo"padding-bottom:20pt;";
   echo"}";
   echo"table{";
   echo"margin-left:310pt;";
   echo"}";
   echo"</style>";

   echo"</head>";
   echo"<body style='background-color:#e6ffe6'>";


echo"<div id='log' style='background-color:#4da6ff;height:20%'>";
echo"<form action='call.php?action=login' method='post' id='frm'>";
echo"<h2 style='text-align:center'>FAMILY SACCO LOGIN PAGE</h2>";
echo"</div>";
echo"<fieldset style='margin-top:5pt; background-color:#ffe6cc; >";
echo"<legend style=''><b>Login</b></legend>";
echo"<table border='0'cellspacing='15' id='' >";
echo"<tr>";
echo"<td>Administrator id:</td>";
echo"<td><input type='text' name='administratorid' required></td>";

echo"</tr>";
echo"<tr>";
echo"<td>Password:</td>";
echo"<td><input type='password' name='password' required></td>";

echo"</tr>";
echo"<tr>";

echo"<td><input type='submit' value='login' id='sub' style='margin-left:50pt;'></td>";
echo"</tr>";
echo"</table>";
echo"</fieldset>";
;
echo"</form>";
echo"</body>";
echo"</html>";
}


?>


