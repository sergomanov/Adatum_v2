<?php
include 's-head.php';
$commands_id3=trim($_POST['value']);
mysqli_query($con,"UPDATE users SET calendar='$commands_id3'  WHERE id_user = '$G_id_user'");
?>