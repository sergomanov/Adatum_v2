<?php
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
$unixtime=time();

 include_once  'runtime.php';
 ///echo $_GET['ID'];                      //http://online.adatum.ru/post.php?ID=74-69-69-2D-30-31&P=576.11

 
if(isset($_GET['ID'])&&!isset($_GET['QQ']))
{
    $address = $_GET['ID'];
	$cont = $_SERVER["REQUEST_URI"] ;
	$cont = substr($cont, 10);
	mysqli_query($con,"UPDATE namedev SET unixtime='$unixtime' WHERE address = '$address'");  //обновление времени доступа датчика в систему
	
$arr = explode('&',$cont);foreach($arr as $item) {
	$pieces = explode("=", $item);

	if($pieces[0]!="ID"){
		signal_run($address,$pieces[0],$pieces[1],$db_host,$db_login ,$db_passwd,$db_name);
		mysqli_query($con,"INSERT INTO developments (address,unixtime,mode,vale) VALUES ('$address','$unixtime','$pieces[0]','$pieces[1]')");
						}
}

}

else if(isset($_GET['ID'])&&isset($_GET['QQ']))
{
	$address = $_GET['ID'];
	mysqli_query($con,"UPDATE namedev SET unixtime='$unixtime' WHERE address = '$address'");  //обновление времени доступа датчика в систему
	$IDDN = mysqli_query($con,"SELECT * FROM run  WHERE address = '$address' AND run=0 ORDER BY id ASC limit 1");
		if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
		echo $mIDDN['vale']; 
		$mid=$mIDDN['id']; 
		mysqli_query($con,"UPDATE run SET run='1' WHERE id = '$mid'");  //отмечаем отработанными
		}}  
	//echo "#RF#2683969,24,190#0#";	
}


?>