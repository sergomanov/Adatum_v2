<?php	
 include 's-head.php';
 include 'adatum.class.php';
 ?>
<!DOCTYPE html>
<html>
	<head>
		<?php	
include 'head.php'; 
 
$errors=NULL;

$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE id_user='$G_id_user' "); 
while($rowr = mysqli_fetch_assoc($rtype)) {	$resadr="'".$rowr['address']; $resp=$resadr."',".$resp;}
$resp=	substr($resp, 0, -1);


if (isset($_POST['truncate'])) {
	mysqli_query($con,"DELETE FROM run WHERE address IN ($resp)"); 
	header("Location: monitoring.php");
	}

if (isset($_POST['del'])) {
	$box_array = $_REQUEST['box']; 
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
	foreach($box_array as $key => $value) {		mysqli_query($con,"DELETE FROM run WHERE id='$value'"); 		}
	header("Location: monitoring.php");
	}
		?>
	</head>
	
	<body class="white">
<form name="myForm" method="post" >
	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	
		
<div class="s2-map " id="map">
<div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">

    <div id="settings">
        <header><h1 style="padding-left: 50px;">Мониторинг</h1></header>
		<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	   
        
        <section id="settings-notifications">
			
			  <div class="title">Файловая система:</div>
          
		  <div class="control-row">
                <div class="on-off-switch-title"><span>Всего</span>

                </div>
                <div>
				<?php echo disktotal(2);  ?>
                 </div>
            </div>
			
			  <div class="control-row">
                <div class="on-off-switch-title"><span>Свободно</span>

                </div>
                <div>
				<?php echo disktotal(1);  ?>
                 </div>
            </div>
			
			  <div class="control-row">
                <div class="on-off-switch-title"><span>Занято</span>

		
                </div>
                <div>
				<?php echo disktotal(3);  ?>
                 </div>
            </div>
         
            <div class="control-row">
                <div class="on-off-switch-title"><span>Свободно <?php echo diskuse();  ?>%</span>

                </div>
                <div>
				<div class="progress" title="<?php echo 100-diskuse();  ?>%">
			<div class="progress_load" style="width: <?php echo 100-diskuse();  ?>px;"/></div>
			</div>
                 </div>
            </div>
			
			      <div class="control-row">
                <div class="on-off-switch-title"><span>Система работает:</span> </div>
                <div>
<?php     
if(PHP_OS=="WINNT"){
$winstats = shell_exec("net statistics server");
preg_match("(\d{1,2}/\d{1,2}/\d{4}\s+\d{1,2}\:\d{2}\s+\w{2})", $winstats, $matches);
$uptimeSecs = time() - strtotime(@$matches[0]);
$staticUptime = format_uptime($uptimeSecs);
echo $staticUptime;
}
else{
$uptime = shell_exec("cut -d. -f1 /proc/uptime");
$days = floor($uptime/60/60/24);
$hours = $uptime/60/60%24;
$mins = $uptime/60%60;
$secs = $uptime%60;
echo "Включено $days дней $hours часов $mins минут и $secs секунд";
}
?>
                 </div>
            </div>
			
<button disabled="disabled" id="del" onclick="return confirm('Вы действительно хотите удалить записи?')" type="submit" class="btn btn-danger btn-sm btn-small"  name="del"  title="Удалить записи" style="width: 202px;"><i class="icon-trash-8"></i> Удалить комманды</button> 

<button onclick="return confirm('Вы действительно хотите удалить записи?')" type="submit" class="btn btn-danger btn-sm btn-small"  name="truncate" style="background-color: #C29959;border-color: #AD7A78;" title="Очистить базу"><i class="icon-trash-8"></i> Очистить очередь заданий</button> 
		
	
		   
		
<table id="example" class=" table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                             <th width="30" data-class="expand"></th>
												<th width: 150px; data-class="expand">Состояние</th>
											    <th data-hide="phone,tablet">Режим</th>
                                                <th data-hide="phone,tablet">Комманда</th>
                                                <th data-class="expand">Дата</th>
                                               
                                            </tr>
                                        </thead>
	<tbody>
	<?php	$IDDN = mysqli_query($con,"SELECT * FROM run WHERE address IN ($resp) ORDER BY id DESC");	if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {	?>		
		<tr>
			<td>
			<input onchange="document.getElementById('del').disabled = false;" id="checkbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='box[]' value=<?php	echo $mIDDN['id']; ?>>
			</td>	
				  
			<td>
			<?php if($mIDDN['run']==0){?> <span class="label label-success">Ожидает выполнения</span> <?php }  ?>
			<?php if($mIDDN['run']==1){?> <span class="label label-info">Выполнено</span> <?php }  ?>
			</td>
			
			<td><?php	echo $mIDDN['mode']; ?></td>
			
			<td><?php	echo $mIDDN['vale']; ?></td>
			
			<td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:i", $mIDDN['unixtime']+$timezone);      ?></span></td>
													  
		</tr>
	<?php  }}	?>																				
	</tbody>
</table>	

			

</section>
		
</div></div></div>
	
</div>
				
</div>

</form>
	</body>
</html>



<script>
window.onload=function(){
if(window.innerWidth<680) {
document.getElementById("pole").style.width="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("paddi").style.padding="0px";
document.getElementById("topmenu").style.width="0px";
document.getElementById("pole").style.display="none";
document.getElementById("topmenu").style.display="none";
}};
</script>