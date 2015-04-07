<?php	
// подключение к базе mysql
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
// подключение к базе mysql

//настройка часового пояса
date_default_timezone_set('UTC');
$result= mysqli_query($con, "SELECT * FROM users WHERE id_user='$G_id_user'");$row=mysqli_fetch_array($result);if($row){$timezone = $row['timezone'];}
//настройка часового пояса
$weekdays = date('w');
$monthdays = date('d');
$month= date('n');

function utf8_to_win($string){
$out="";
	for ($c=0;$c<strlen($string);$c++)
	{
			$i=ord($string[$c]);
			if ($i <= 127) @$out .= $string[$c];
			if (@$byte2)
		{
			$new_c2=($c1&3)*64+($i&63);
			$new_c1=($c1>>2)&5;
			$new_i=$new_c1*256+$new_c2;
			if ($new_i==1025){$out_i=168;} else {if ($new_i==1105){$out_i=184;} else {$out_i=$new_i-848;}}
			@$out .= chr($out_i);
			$byte2 = false;
		}
	if (($i>>5)==6) {$c1 = $i;$byte2 = true;}
	}
return $out;
}

function send_r_mail($mail,$message,$titlemail) {
		if (mail($mail, $titlemail, $message, "From: support@adatum.ru\r\n"."Reply-To: support@adatum.ru\r\n"."X-Mailer: PHP/" . phpversion())) {
			return true;
		} else {
			return false;
			Echo "Что то не так";
		}
}

function add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name) {
	$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
	$con->set_charset("utf8"); // здесь
	if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
	$res4 = mysqli_query($con,"SELECT * FROM `commands` WHERE id IN ($number)");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$mode_run=$row4['mode'];	
			$address_run=$row4['address'];	
			$vale1_run=$row4['vale'];	
			$vale="#".$address_run."#".$mode_run."#".$vale1_run."##";
			$timereal=time();
			mysqli_query($con,"INSERT INTO run (mode,vale,address,unixtime) VALUES ('$mode_run','$vale','$address_run','$timereal')");
		}	
	mysqli_free_result($res4); } 
}


function signal_run($address,$mode,$vale,$db_host,$db_login ,$db_passwd,$db_name) {
	$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
	$con->set_charset("utf8"); // здесь
	if (mysqli_connect_errno()) {  echo "-> Failed to connect to MySQL: " . mysqli_connect_error();}
	
	
		//----------------------- Включение выключение ------------------------------------------------------------------------------------------------
			$res_WE = mysqli_query($con,"SELECT * FROM commands WHERE mode = '$mode' AND address = '$address' AND controlir!=0");
			if($res_WE) {   while($row_WE = mysqli_fetch_assoc($res_WE)) 
			{
				$timereal=time();
				$nevs = $row_WE['id'];
				$vale_WE = $row_WE['vale'];
				$controlir_WE = $row_WE['controlir'];
				$arre = explode(',',$vale_WE); $va1 = $arre[0];$va2 = $arre[1];$va3 = $arre[2];
				
				if($controlir_WE==1){
				$arr = explode(',',$vale); $valem1 = $arr[0];$valem2 = $arr[1];$valem3 = $arr[2];
						if($valem2==$va2 AND $valem3==$va3){
							mysqli_query($con,"UPDATE commands SET laststate ='$valem1',unixtime ='$timereal' WHERE id = '$nevs'");	
						}
				}				
				
				if($controlir_WE==2){
				$arr = explode(',',$vale); $valem1 = $arr[0];$valem2 = $arr[1];$valem3 = $arr[2];
						if($valem1==$va1 AND $valem3==$va3){
						mysqli_query($con,"UPDATE commands SET laststate ='$valem2',unixtime ='$timereal' WHERE id = '$nevs'");	
						}
				}		
				
				if($controlir_WE==3){
				$arr = explode(',',$vale); $valem1 = $arr[0];$valem2 = $arr[1];$valem3 = $arr[2];
						if($valem1==$va1 AND $valem2==$va2){
						mysqli_query($con,"UPDATE commands SET laststate ='$valem3',unixtime ='$timereal' WHERE id = '$nevs'");
						}				
				}		

			}  mysqli_free_result($res_WE); } 		
		//----------------------- Включение выключение ------------------------------------------------------------------------------------------------
	
	
		//----------------------- Строго равно ------------------------------------------------------------------------------------------------
		$res4 = mysqli_query($con,"SELECT * FROM commands WHERE vale = '$vale' AND mode = '$mode' AND address = '$address' AND cond='0'");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$nev = $row4['id'];
			//echo $nev;
			$timereal=time();
			mysqli_query($con,"UPDATE commands SET unixtime ='$timereal' WHERE id = '$nev'");
			
				$G_conditions = mysqli_query($con,"SELECT * FROM `scheduler` WHERE switch = '1' AND FIND_IN_SET('$nev', conditions)");
				if($G_conditions) {   while($G_conditions_row = mysqli_fetch_assoc($G_conditions)) 
				{ 
					$number=$G_conditions_row['commands']; 
					$Cond_id=$G_conditions_row['id'];
					mysqli_query($con,"UPDATE scheduler SET timerun ='$timereal' WHERE id = '$Cond_id'");
					//$arr = explode(',',$number);foreach($arr as $item) { add_to_run($item,$db_host,$db_login ,$db_passwd,$db_name);	}
					 add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
				} 	
				mysqli_free_result($G_conditions); } 
		}  mysqli_free_result($res4); } 		
		//----------------------- Строго равно ------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------------
			$res4 = mysqli_query($con,"SELECT * FROM commands WHERE vale < '$vale' AND mode = '$mode' AND address = '$address' AND cond='2'");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$nev = $row4['id'];
				$G_conditions = mysqli_query($con,"SELECT * FROM `scheduler` WHERE switch = '1' AND FIND_IN_SET('$nev', conditions)");
				if($G_conditions) {   while($G_conditions_row = mysqli_fetch_assoc($G_conditions)) 
				{ 
					$Cond_id=$G_conditions_row['id'];
					mysqli_query($con,"UPDATE scheduler SET drivers = NULL WHERE id = '$Cond_id'");
					
				} 	
				mysqli_free_result($G_conditions); } 
				
		}  mysqli_free_result($res4); } 
		
		
		$res4 = mysqli_query($con,"SELECT * FROM commands WHERE vale > '$vale' AND mode = '$mode' AND address = '$address' AND cond='1'");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$nev = $row4['id'];
			$G_conditions = mysqli_query($con,"SELECT * FROM `scheduler` WHERE switch = '1' AND FIND_IN_SET('$nev', conditions)");
				if($G_conditions) {   while($G_conditions_row = mysqli_fetch_assoc($G_conditions)) 
				{ 
					$Cond_id=$G_conditions_row['id'];
					mysqli_query($con,"UPDATE scheduler SET drivers = NULL WHERE id = '$Cond_id'");
					
				} 	
				mysqli_free_result($G_conditions); } 
		
		}  mysqli_free_result($res4); } 
			
		//-----------------------------------------------------------------------------------------------------------
		
		//----------------------- Больше ------------------------------------------------------------------------------------------------
		$res4 = mysqli_query($con,"SELECT * FROM commands WHERE vale < '$vale' AND mode = '$mode' AND address = '$address' AND cond='1'");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$nev = $row4['id'];
			$timereal=time();
			mysqli_query($con,"UPDATE commands SET unixtime ='$timereal' WHERE id = '$nev'");
			
				$G_conditions = mysqli_query($con,"SELECT * FROM `scheduler` WHERE switch = '1' AND drivers!=1 AND FIND_IN_SET('$nev', conditions)");
				if($G_conditions) {   while($G_conditions_row = mysqli_fetch_assoc($G_conditions)) 
				{ 
			
					$number=$G_conditions_row['commands']; 
					$Cond_id=$G_conditions_row['id'];
					mysqli_query($con,"UPDATE scheduler SET timerun ='$timereal',drivers = 1 WHERE id = '$Cond_id'");
					//$arr = explode(',',$number);foreach($arr as $item) { add_to_run($item,$db_host,$db_login ,$db_passwd,$db_name);	}
					 add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
				} 	
				mysqli_free_result($G_conditions); } 
		}  mysqli_free_result($res4); } 		
		//----------------------- Больше ------------------------------------------------------------------------------------------------
		
			//----------------------- Меньше ------------------------------------------------------------------------------------------------
		$res4 = mysqli_query($con,"SELECT * FROM commands WHERE vale > '$vale' AND mode = '$mode' AND address = '$address' AND cond='2'");
		if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
		{
			$nev = $row4['id'];
			//echo $nev;
			$timereal=time();
			mysqli_query($con,"UPDATE commands SET unixtime ='$timereal' WHERE id = '$nev'");
			
				$G_conditions = mysqli_query($con,"SELECT * FROM `scheduler` WHERE switch = '1' AND drivers!=1 AND FIND_IN_SET('$nev', conditions)");
				if($G_conditions) {   while($G_conditions_row = mysqli_fetch_assoc($G_conditions)) 
				{ 
					$number=$G_conditions_row['commands']; 
					$Cond_id=$G_conditions_row['id'];
					mysqli_query($con,"UPDATE scheduler SET timerun ='$timereal',drivers = 1 WHERE id = '$Cond_id'");
					//$arr = explode(',',$number);foreach($arr as $item) { add_to_run($item,$db_host,$db_login ,$db_passwd,$db_name);	}
					 add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
				} 	
				mysqli_free_result($G_conditions); } 
		}  mysqli_free_result($res4); } 		
		//----------------------- Меньше ------------------------------------------------------------------------------------------------
		
		
}





//---------------------------------------------------------------планировщик-----------------------------------------------------------
$timereal=time()+$timezone; 
// echo  "текущее время: ".$timereal."<br>";
 
$res = mysqli_query($con,"SELECT * FROM `scheduler` WHERE type IN (1,2,5,6,7,8)");
if($res) {   while($row = mysqli_fetch_assoc($res)) 
 {

$sch_id=$row['id'];
//echo  "<br><br>id:".$row['id'].$row['name']."<br>";
//if($row['timein']!=NULL){ echo  "время от: ".$row['timein']."<br>";}
//if($row['timeout']!=NULL){  echo  "время до: ".$row['timeout']."<br>";}
 
$timeone=strtotime($row['time']);
//if($row['time']!=NULL){ echo "Часы: ".$timeone;}


//По таймеру
//echo "Таймер".($row['timerun']+$row['timer']*60);
if($row['switch']==1 && $row['type']==1 && $row['timein'] < $timereal && $row['timeout'] > $timereal && ($row['timerun']+$row['timer']-1)<$timereal)
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal' WHERE id = '$sch_id'");
//echo "-> ".$date_today." ".$time_today."Таймер type 1.\n\r";
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
}
 

//Один раз
if($row['switch']==1 && $row['type']==2 && $row['timein'] <$timereal )
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal',switch ='0' WHERE id = '$sch_id'");
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
//echo "-> ".$date_today." ".$time_today."Один раз type 2.\n\r";
}



//Ежедневно
if($row['switch']==1 && $row['type']==5 && $timeone < $timereal && $row['timerun']+86400 < $timereal)
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal' WHERE id = '$sch_id'");
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
//echo "-> ".$date_today." ".$time_today." Ежедневно type 5 .\n\r";
}



//Еженедельно
if($row['switch']==1 && $row['type']==6 && $timeone < $timereal && (strpos($row['weekdays'], $weekdays)!== false) && $row['timerun']+86400 < $timereal)
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal' WHERE id = '$sch_id'");
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
//echo "-> ".$date_today." ".$time_today." Еженедельно type 6 .\n\r";
}


//Ежемесячно
if($row['switch']==1 && $row['type']==7 && (in_array($monthdays, explode(',',$row['monthdays']))!== false) && $timeone < $timereal && $row['timerun']+86400 < $timereal)
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal' WHERE id = '$sch_id'");
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
//echo "-> ".$date_today." ".$time_today."Ежемесячно type 7 .\n\r";
}

//Ежегодно
if($row['switch']==1 && $row['type']==8 && (in_array($monthdays, explode(',',$row['monthdays']))!== false)   && (in_array($month, explode(',',$row['month']))!== false) && $timeone < $timereal && $row['timerun']+86400 < $timereal)
{
mysqli_query($con,"UPDATE scheduler SET timerun='$timereal' WHERE id = '$sch_id'");
$number=$row['commands']; add_to_run($number,$db_host,$db_login ,$db_passwd,$db_name);
//echo "-> ".$date_today." ".$time_today."Ежегодно type 8.\n\r";
}
    }
 mysqli_free_result($res); } 
//---------------------------------------------------------------планировщик-----------------------------------------------------------



//----------------------------------Выполнение активации правил по команде ACT ---------------------------------------------------------                                                       
$res5 = mysqli_query($con,"SELECT * FROM `run` WHERE run ='0' AND mode ='ACT'  ORDER BY id DESC LIMIT 1");
if($res5) {   while($row5 = mysqli_fetch_assoc($res5)) 
   {	

	$vale=$row5['vale'];	
    $vale_id5=$row5['id'];		
	$comm = explode('#', $vale);
	$Valut = explode(',', $comm[3]);
	
	//echo $Valut[0];
    //echo $Valut[1];

	mysqli_query($con,"UPDATE scheduler SET switch ='$Valut[1]' WHERE id = '$Valut[0]'");
    
	//mysqli_query($con,"DELETE FROM run WHERE id='$vale_id5'");
	mysqli_query($con,"UPDATE run  SET run ='1' WHERE id='$vale_id5'");
   }
mysqli_free_result($res5); } 
//----------------------------------Выполнение активации правил по команде ACT ---------------------------------------------------------  



//----------------------------------Отправка Емайл по команде EML ---------------------------------------------------------                                                       
$res58 = mysqli_query($con,"SELECT * FROM `run` WHERE run ='0' AND mode ='EML'  ORDER BY id DESC LIMIT 1");
if($res58) {   while($row58 = mysqli_fetch_assoc($res58)) 
   {	

	$vale=$row58['vale'];	
    $vale_id5=$row58['id'];		
	$comm4 = explode('#', $vale);
	$emlcomm = explode(',', $comm4[3]);
	
	//echo $emlcomm[0];
    //echo $emlcomm[1];
	//echo $emlcomm[2];
	
	$message=utf8_to_win($emlcomm[2]);
	$titlemail=$emlcomm[1];
	send_r_mail($emlcomm[0], $message, $titlemail);

	mysqli_query($con,"UPDATE run  SET run ='1' WHERE id='$vale_id5'");
   }
mysqli_free_result($res58); } 
//----------------------------------Отправка Емайл по команде EML --------------------------------------------------------- 










//---------------------------------- Команда ONLINE ---------------------------------------------------------   
$time_period=time()-600;       
$unixtime=time();                                           
$res_W = mysqli_query($con,"SELECT * FROM `namedev` WHERE unixtime < '$time_period' AND unixtime!=0 AND state!=0");
if($res_W) {   while($row_W = mysqli_fetch_assoc($res_W)) 
   {	
    $vale_row_W=$row_W['id'];	
	$address_row_W=$row_W['address'];	
	//echo  $vale_row_W."<br>";
	mysqli_query($con,"UPDATE namedev SET state ='0' WHERE id = '$vale_row_W'");
	mysqli_query($con,"INSERT INTO developments (address,unixtime,mode,vale) VALUES ('$address_row_W','$unixtime','ONLINE','0')");
	signal_run($address_row_W,'ONLINE','0',$db_host,$db_login ,$db_passwd,$db_name);
   }
mysqli_free_result($res_W); } 

$res_X = mysqli_query($con,"SELECT * FROM `namedev` WHERE unixtime > '$time_period' AND unixtime!=0 AND state!=1");
if($res_X) {   while($row_X = mysqli_fetch_assoc($res_X)) 
   {	
    $vale_row_X=$row_X['id'];	
	$address_row_X=$row_X['address'];
	//echo  $vale_row_X."<br>";
	mysqli_query($con,"UPDATE namedev SET state ='1' WHERE id = '$vale_row_X'");
	mysqli_query($con,"INSERT INTO developments (address,unixtime,mode,vale) VALUES ('$address_row_X','$unixtime','ONLINE','1')");
	signal_run($address_row_X,'ONLINE','1',$db_host,$db_login ,$db_passwd,$db_name);	
   }
mysqli_free_result($res_X); } 
//---------------------------------- Команда ONLINE ---------------------------------------------------------  















?>
