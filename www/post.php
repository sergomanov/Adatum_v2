<?php
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
$unixtime=time();

 include_once  'runtime.php';
 ///echo $_GET['ID'];                      //http://online.adatum.ru/post.php?ID=74-69-69-2D-30-31&P=576.11

 
//if(isset($_GET['ID'])&&!isset($_GET['QQ']))
if(isset($_GET['ID']) || isset($_POST['ID'])){
	
	
   
		if(isset($_GET['ID'])) {$address =  $_GET['ID'];}
		if(isset($_POST['ID'])){$address = $_POST['ID'];}
		
		mysqli_query($con,"UPDATE namedev SET unixtime='$unixtime' WHERE address = '$address'");  //обновление времени доступа датчика в систему
		
		$cont = $_SERVER["REQUEST_URI"] ;
		$cont = substr($cont, 10);
		$arr = explode('&',$cont);foreach($arr as $item) {
		$pieces = explode("=", $item);
			if($pieces[0]!="ID"){
			signal_run($address,$pieces[0],$pieces[1],$db_host,$db_login ,$db_passwd,$db_name);
			mysqli_query($con,"INSERT INTO developments (address,unixtime,mode,vale) VALUES ('$address','$unixtime','$pieces[0]','$pieces[1]')");
			}
		}
		
		// ИЩЕМ в базе есть ли команды для данного устройства и если есть то выводим
		$IDDN = mysqli_query($con,"SELECT * FROM run  WHERE address = '$address' AND run=0 ORDER BY id ASC limit 1");
		if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
		echo $mIDDN['vale']; 
		$mid=$mIDDN['id']; 
		mysqli_query($con,"UPDATE run SET run='1' WHERE id = '$mid'");  //отмечаем отработанными
		}}  
		// ИЩЕМ в базе есть ли команды для данного устройства и если есть то выводим
}

//else if(isset($_GET['ID'])&&isset($_GET['QQ']))
//{
//	$address = $_GET['ID'];
//	mysqli_query($con,"UPDATE namedev SET unixtime='$unixtime' WHERE address = '$address'");  //обновление времени доступа датчика в систему
//		$IDDN = mysqli_query($con,"SELECT * FROM run  WHERE address = '$address' AND run=0 ORDER BY id ASC limit 1");
//		if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
//		echo $mIDDN['vale']; 
//		$mid=$mIDDN['id']; 
//		mysqli_query($con,"UPDATE run SET run='1' WHERE id = '$mid'");  //отмечаем отработанными
//		}}  
//echo "#RF#2683969,24,190#0#";	
//}


?>