<?php
// подключение к базе mysql
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
// подключение к базе mysql


?>