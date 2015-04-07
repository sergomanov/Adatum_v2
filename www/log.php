<?php	
 include 's-head.php';
 include 'adatum.class.php';
 include 's-lib.php'; 
 ?>
<!DOCTYPE html>
<html>
<head><?php	 include 'head.php'; ?></head>

<body class="white">
<form method="POST" action="">
	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">
				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>					
<div class="s2-map " id="map">
<div class="right-area-content -js-right-area-content">
    <div id="settings">
        <header><h1 style="padding-left: 50px;">История	</h1></header>
			<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
			<?php	if($G_id_user==1){ echo '<div class="alert alert-warning"> Вы вошли под учетной записью Администратора вам видны все события.</div>';} ?>						
    <div class="title">Журнал датчиков :</div>
	<div class="col-xs-12"><div id="example2_filter" class="dataTables_filter"><label>Поиск: <input type="text" name="search" class="form-control input-sm" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" ></label></div></div>

	<button type="submit" class="btn btn-danger btn-sm btn-small"  name="find" style="background-color: #3F9635;  border-color: #548347;   position: absolute;  margin: -35px 0px 0px 182px;"><i class="icon-search-4"></i> Поиск</button> 

<section id="settings-notifications">
	<?php
	$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE id_user='$G_id_user' "); 
	while($rowr = mysqli_fetch_assoc($rtype)) {	$resadr="'".$rowr['address']; $resp=$resadr."',".$resp;}
	$resp=	substr($resp, 0, -1);  
	$_PAGING = new Paging($con);
	$search = $_POST['search'];
	$r = $_PAGING->get_page( "SELECT * FROM developments  WHERE (mode LIKE '%$search%' OR address LIKE '%$search%') AND address IN ($resp) ORDER BY id DESC " ); 
	?>	
	<table class=" table table-striped table-bordered" cellspacing="0">
		<thead>
			<tr>
				<th data-class="expand" style="width: 40px;"></th>
				<th data-class="expand">Описание</th>
				<th data-class="expand">Дата</th>
			</tr>
		</thead>

		<tbody>		
		<?php	while($row = $r->fetch_assoc()){	$M_address = $row['address'];  ?>
			<tr>
					<td>
						<?php $rowmode = $row['mode']; 
						if($G_id_user==1){$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' LIMIT 1");} 
									else {$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' AND (id_user = '$G_id_user' OR id_user = '0') LIMIT 1");}
						if($resico){while($rowico = mysqli_fetch_assoc($resico)){$rowicon=$rowico['ico']; $rowcolor=$rowico['color'];?>
						<i class="<?php echo $rowicon; ?> text-success " style="font-size: 18px; color: <?php	echo $rowcolor; ?> !important;"></i> <?php }}  ?>
					</td>

					<td>
					<?php	echo "Тип: ".$row['mode']."<br>"; ?>
					<?php	echo $row['address'].": "; ?>
					<gcol><?php	$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$M_address' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo ": ".$rowr['name'];} ?></gcol><br>
					<?php	echo "Значение: ".$row['vale']; ?>
					</td>

					<td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:i", $row['unixtime']+$timezone);      ?></span></td>
			</tr>		
			<?php  }	?>													
		</tbody>
	</table>									
</section>

<div class="dataTables_info hidden-xs" id="example_info"><?php echo $_PAGING->get_result_text().' записей';?></div>

<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
	<ul class="pagination">
		<li class="paginate_button previous" aria-controls="example2" tabindex="0" id="example2_previous"><a href="?p=1"><<</a></li>
		<li class="paginate_button " aria-controls="example2" tabindex="0"><?php echo  $_PAGING->get_prev_page_link();?></li>
		<?php echo $_PAGING->get_page_links();?>
		<li class="paginate_button next disabled" aria-controls="example2" tabindex="0" id="example2_next"><?php echo $_PAGING->get_next_page_link();?></li>
	</ul>
</div>							

</div></div></div></div>
</form>
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