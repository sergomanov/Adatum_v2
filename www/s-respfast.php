<?php
include 's-head.php';
$unixtime = time()+$timezone;
$commands_id3=$_POST['value'];
$comm = explode('#', $commands_id3);
mysqli_query($con,"INSERT INTO run (mode,vale,address,unixtime) VALUES ('$comm[2]','$commands_id3','$comm[1]','$unixtime')");	
?>