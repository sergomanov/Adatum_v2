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
	
	
   
		if(isset($_GET['ID'])) {$address =  $_GET['ID']; $cont=$_GET;}
		if(isset($_POST['ID'])){$address = $_POST['ID']; $cont=$_POST;}
		
		mysqli_query($con,"UPDATE namedev SET unixtime='$unixtime' WHERE address = '$address'");  //обновление времени доступа датчика в систему
		
		foreach($cont as $namepar => $valpar) {
					if($namepar!="ID"){
					signal_run($address,$namepar,$valpar,$db_host,$db_login ,$db_passwd,$db_name);
					mysqli_query($con,"INSERT INTO developments (address,unixtime,mode,vale) VALUES ('$address','$unixtime','$namepar','$valpar')");
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


?>