<?php
include 's-head.php';
$unixtime = time()+$timezone;
$commands_id3=$_POST['value'];
$res4 = mysqli_query($con,"SELECT * FROM `commands` WHERE id IN ($commands_id3)");
			if($res4) {   while($row4 = mysqli_fetch_assoc($res4)) 
				   {		   
				  $mode_run=$row4['mode'];	
				  $address_run=$row4['address'];	
				  $vale_run="#".$address_run."#".$mode_run."#".$row4['vale']."##";	
				  mysqli_query($con,"INSERT INTO run (mode,vale,address,unixtime) VALUES ('$mode_run','$vale_run','$address_run','$unixtime')");	
					}	
				mysqli_free_result($res4); } 


?>