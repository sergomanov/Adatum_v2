<?php	
 include 's-head.php';
 include 'adatum.class.php';
 ?>
<!DOCTYPE html>
<html>
	<head>
		<?php	 include 'head.php'; ?>
	</head>
	
	<body class="white">

	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

							
 

					
<div class="s2-map " id="map">

<div class="right-area-content -js-right-area-content">

    <div id="settings">
        <header>

            <h1 style="padding-left: 50px;">История	</h1>
			
<?php
// проверка количества записей
$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE id_user='$G_id_user' "); 
while($rowr = mysqli_fetch_assoc($rtype)) {	$resadr="'".$rowr['address']; $resp=$resadr."',".$resp;}
$resp=	substr($resp, 0, -1);
if ($result=mysqli_query($con,"SELECT * FROM developments WHERE address IN ($resp)"))  {  $rowcount=mysqli_num_rows($result);  }
if($rowcount>2000){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;История содержит слишком много записей. Показаны последние 1000 записей!";}
?> 
			
        </header>
			<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
			<?php	if($G_id_user==1){ echo '<div class="alert alert-warning"> Вы вошли под учетной записью Администратора вам видны все события.</div>';} ?>	
			
		

		
      <div class="title">Журнал датчиков :</div>
		
        <section id="settings-notifications">
			      <table id="example2" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                             	<th data-class="expand" style="width: 40px;"></th>
												<th data-class="expand">Тип</th>
                                                <th data-hide="phone,tablet">MAC устройства</th>
												<th data-hide="phone,tablet">Значение</th>
										
                                                <th data-class="expand">Дата</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
			<?php
			if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM developments ORDER BY id DESC  LIMIT 1000");}
			else { $IDDN = mysqli_query($con,"SELECT * FROM developments  WHERE address IN ($resp,'00-00-00-00-00-00') ORDER BY id DESC  LIMIT 1000");}
			if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
			$M_address = $mIDDN['address'];
			?>
			
			<tr>
					<td>
						<?php $rowmode = $mIDDN['mode']; 
						if($G_id_user==1){$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' LIMIT 1");} 
									else {$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' AND id_user = '$G_id_user'");}
						if($resico){while($rowico = mysqli_fetch_assoc($resico)){$rowicon=$rowico['ico']; $rowcolor=$rowico['color'];?>
						<i class="<?php echo $rowicon; ?> text-success " style="font-size: 18px; color: <?php	echo $rowcolor; ?> !important;"></i> <?php }}  ?>
					</td>

					<td><?php	echo $mIDDN['mode']; ?></td>

					<td>
					<?php	echo $mIDDN['address'].": "; ?>
					<gcol><?php	$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$M_address' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['name'];} ?></gcol>
					</td>

					<td><?php	echo $mIDDN['vale']; ?></td>

					<td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:i", $mIDDN['unixtime']+$timezone);      ?></span></td>
			</tr>
											
			<?php  }}	?>													
		</tbody>
	</table>									
</section>

</div></div></div></div>
</body>
</html>
<script>
window.onload=function(){
if(window.innerWidth<680) {
document.getElementById("pole").style.width="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("topmenu").style.width="0px";
document.getElementById("pole").style.display="none";
document.getElementById("paddi").style.padding="0px";
document.getElementById("topmenu").style.display="none";
}};
</script>