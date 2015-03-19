<?php
// подключение к базе mysql
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
// подключение к базе mysql

include_once 'conf.php';
$auth = new auth();
if ($auth->check()) {	$login_user = $_SESSION['login_user'];$G_id_user = $_SESSION['id_user'];} else {$login_user = NULL;$G_id_user = NULL;header("Location: index.php");}

//настройка часового пояса
date_default_timezone_set('UTC');
$result= mysqli_query($con, "SELECT * FROM users WHERE id_user='$G_id_user'");$row=mysqli_fetch_array($result);if($row){$timezone = $row['timezone'];}
//настройка часового пояса
$weekdays = date('w');
$monthdays = date('d');
$month= date('n');

$Gresult= mysqli_query($con, "SELECT * FROM users WHERE id_user='$G_id_user'");
$rowg=mysqli_fetch_array($Gresult);if($rowg){$fonimg = $rowg['img'];$G_calendar = $row['calendar'];}
?>