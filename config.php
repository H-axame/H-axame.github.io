<?php


$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "romans_db";
$prefix = "";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
if (!$bd) {
    die("Could not connect database: " . mysqli_connect_error());
}






//mysql_connect() function, which is deprecated and removed in recent versions of PHP.
/*$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "romans_db";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");*/

?>