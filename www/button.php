<?php	
include 's-head.php';
include 'adatum.class.php';
include 's-lib.php'; 
$errors=NULL;if($G_id_user==2){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Изменения данных в демо режиме запрещенны !";}

if (isset($_POST['del'])) {
	$box_array = $_REQUEST['box']; 
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
	foreach($box_array as $key => $value) {
		mysqli_query($con,"DELETE FROM scheduler WHERE id='$value'"); 
				}
}
 
 
 
if (isset($_POST['save'])) {

	$name = $_POST['name'];
	$type = $_POST['type'];
	$conditions = $_POST['conditions'];
	$moddevice = $_POST['moddevice'];
	$icocolor = $_POST['icocolor'];
	$ico = $_POST['ico'];
	$drivers = $_POST['drivers'];
	foreach ($_POST['commands'] as $commandsb)   {  $commandsa=$commandsb.",";  $commandsc .= $commandsa;  } $commands = substr($commandsc, 0, strlen($commandsc)-1); 
	foreach ($_POST['typedev'] as $typedevb)   {  $typedeva=$typedevb.",";  $typedevc .= $typedeva;  } $typedev = substr($typedevc, 0, strlen($typedevc)-1);  
	if($type!=3){$commands ="";}
	if($type!=3){$conditions ="";}
	if($type==9){$icocolor = "";$ico = "";}
	if($type==10){$name =$moddevice;}
	if($type==10){$drivers =$typedev;}
	$idt=0; $rtype = mysqli_query($con,"SELECT * FROM scheduler WHERE name='$name' "); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}
	if($idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Запись с таким именем уже существует.";}

		if($errors==NULL){
		  mysqli_query($con,"INSERT INTO scheduler (name, switch, type,conditions,commands,color,ico,drivers,id_user) VALUES ('$name','0', '$type', '$conditions','$commands','$icocolor','$ico','$drivers','$G_id_user')");
		  header("Location: button.php");
		}
}



if (isset($_POST['edit'])) {

		$id = $_POST['id'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$img = $_POST['img'];
		$moddevice = $_POST['moddevice'];
		$conditions = $_POST['conditions'];
		$icocolor = $_POST['icocolor'];
		$ico = $_POST['ico'];
		$drivers = $_POST['drivers'];
		foreach ($_POST['commands'] as $commandsb)   {  $commandsa=$commandsb.",";  $commandsc .= $commandsa;  } $commands = substr($commandsc, 0, strlen($commandsc)-1); 
		foreach ($_POST['typedev'] as $typedevb)   {  $typedeva=$typedevb.",";  $typedevc .= $typedeva;  } $typedev = substr($typedevc, 0, strlen($typedevc)-1); 
		if($type!=3){$commands ="";}
		if($type!=3){$conditions ="";}
		if($type==9){$icocolor ="";$ico ="";}
		if($type==10){$name =$moddevice;}
		if($type==10){$drivers =$typedev;}
		
		
		$typedev=join(',', array_unique(preg_split('/[\s,]+/', $typedev)));
		$commands=join(',', array_unique(preg_split('/[\s,]+/', $commands)));


		if($errors==NULL){
			mysqli_query($con,"UPDATE scheduler SET  name='$name', switch='$switch',drivers='$drivers',color='$icocolor',ico='$ico',type='$type',conditions='$conditions',commands='$commands' WHERE id = '$id'");
			header("Location: button.php");
		}
}
 ?>
<!DOCTYPE html>
<html>
<head><?php	include 'head.php'; ?></head>
<body class="white">
<div  class="s2-content" id="paddi" style="padding-top: 70px;">
<?php	 include 'topmenu.php'; ?>
<?php	 include 'smenu.php'; ?>	
<div class="s2-map " id="map">
<div class="right-area -js-right-area Mscroll" style="display: block;  padding: 0px;  outline: none;" tabindex="0">
<div class="jspPane" style="padding: 0px; top: 0px;">
<div class="right-area-content -js-right-area-content">
<div class="profile row"><br>
<h2 style="text-align:center; padding-bottom: 30px;"> УПРАВЛЕНИЕ ПАНЕЛЬЮ ЗАДАЧ </h2>
<?php	 include 'icon.php'; ?>		
<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
<form name="myForm" method="post" >
    <div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							 <div class="row-fluid" >
			<br>

<input  type="hidden"  name="id" id="id" class="form-control"  placeholder="">
			
			
<p>Тип </p>
<select id="type" class="form-control" name="type" onChange="javascript: go(this);" style="width:100%"> 
	<option value="0"></option> 
	<option value="3">Кнопка</option> 
	<option value="10">Датчик</option> 
	<option value="9">Камера</option> 
</select>


<div id="i_webcam" style="display: none"> 
<p>Тип подключения </p>
<select id="webcam" class="form-control" name="webcam" onChange="javascript: gol(this);" style="width:100%"> 
	<option value="0"></option> 
	<option value="1">FTP папка</option> 
	<option value="2">Локальная сеть</option> 
	<option value="3">P2P</option> 
</select>
</div> 
	  
<div id="i_name" style="display: none"> 
	<p>Наименование </p>
    <input id="name" name="name" type="text" class="form-control" placeholder="Наименование">
</div> 
			 
<div id="i_icond" style="display: none"> 
<p>Иконка </p>
	<div  class="input-group">
		<span onclick="openDiv('icome');" class="input-group-addon primary">				  
		<span class="arrow"></span>
		<i id="icoclass" class="icon-dollar"></i>
		</span>
	<input type="text" class="form-control" id="ico" name="ico" style="height: 30px;" >
	</div>
				
<p>Цвет Иконки </p>
	<input type="text" id="icocolor" name="icocolor" class="Dcolor form-control demo demo-1 demo-auto form-control" value="#5367ce" />	
</div> 	
			
<div id="i_conditions" style="display: none;">	
<p>Устройство контроля состояния</p>				  
	<select id="conditions"  name="conditions" class="select2" style="width:100%">
	<option value=""></option> 
	<?php $resultel = mysqli_query($con,"SELECT * FROM commands WHERE controlir!='0' AND id_user = '$G_id_user'"); while($rowl = mysqli_fetch_assoc($resultel)) { $controlir = $rowl['controlir'];$addr_s = $rowl['address'];?> 
	
		<?php    $resulte = mysqli_query($con,"SELECT * FROM namedev WHERE address = '$addr_s'  ");while($rowe = mysqli_fetch_assoc($resulte)) {$namedeva = $rowe['name']; }?> 
	<option value="">Нет контроля</option> 
	<option value="<?php	echo $rowl['id']; ?>"><?php	echo $rowl['name']; ?> - #<?php echo $rowl['address']." : ".$namedeva; ?>#<?php echo $rowl['mode']; ?>#<?php echo $rowl['vale']; ?>##[Контроль по <?php echo $controlir; ?> значению]</option> 	
	<?php } ?> 
	</select>
</div>	
			
			
<div id="i_moddevice" style="display: none">	
<p>Номер устройства</p>
	<select id="moddevice" class="form-control" name="moddevice"> 
	<?php    $resulte = mysqli_query($con,"SELECT * FROM namedev WHERE id_user = '$G_id_user' GROUP BY address ");while($rowe = mysqli_fetch_assoc($resulte)) { ?> 
	<option value="<?php  echo $rowe['address'];?>"><?php  echo $rowe['address'];?> - <?php  echo $rowe['name'];?></option> 	
	<?php 					}					?> 
	</select>	
</div>	

			
<div id="i_typedev" style="display: none">	
<p>Типы датчиков</p>
	<select multiple class="select2" id="typedev" name="typedev[]" style="width:100%">
	<?php  $rtype = mysqli_query($con,"SELECT * FROM type WHERE id_user = '$G_id_user' AND type in ('1') "); while($rowr = mysqli_fetch_assoc($rtype)) {	?> 
	<option value="<?php echo $rowr['id']; ?>"><?php echo $rowr['mode']; ?> - <?php	echo $rowr['name']; ?></option> 	
	<?php } ?> 					
	</select>
</div>

		
<div id="i_drivers" style="display: none">	
<p>Путь до камеры</p>
<input id="drivers" name="drivers" type="text" class="form-control" placeholder="Наименование">
</div>	
				
<div id="i_commands" style="display: none">	
<p>Комманды </p>			 
	<select multiple class="select2" id="commands" name="commands[]" style="width:100%">
	<?php    
	$rtype = mysqli_query($con,"SELECT * FROM type WHERE type in ('2','3','4') "); while($rowr = mysqli_fetch_assoc($rtype)) { $rowr = $rowr['mode'];
	$resulte = mysqli_query($con,"SELECT mode FROM commands WHERE id_user = '$G_id_user' AND mode ='$rowr' GROUP BY mode "); while($rowe = mysqli_fetch_assoc($resulte)) { $moderow=$rowe['mode'];
	?> 
		<optgroup label="<?php $resultetype = mysqli_query($con,"SELECT name FROM type WHERE mode ='$moderow' GROUP BY type "); while($rowetype = mysqli_fetch_assoc($resultetype)) { echo $moderow." - ".$rowetype['name'];}?>">
		<?php $resultel = mysqli_query($con,"SELECT * FROM commands WHERE mode='$moderow' "); while($rowl = mysqli_fetch_assoc($resultel)) { ?> 
			<option value="<?php	echo $rowl['id']; ?>"><?php	echo $rowl['name']; ?>-<?php echo $rowl['mode']; ?>#<?php echo $rowl['address']; ?>#<?php echo $rowl['vale']; ?>##
			</option> 	
		<?php } ?> 
		</optgroup>
	<?php }} ?> 					
	</select>
</div>	
		   
<br><br>
			
<button type="submit" class="btn btn-sm btn-small btn-primary" name="save" value="" ><i class="icon-plus"></i> Добавить</button>
<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="edit" value="" ><i class="icon-edit"></i> Изменить</button>
<button type="button" disabled="disabled" onclick="clin()"  class="btn btn-sm btn-small btn-white" name="clinss" value="" >Очистить</button>
						
													
						</div>							
					</div>
				</div>	
			</div>
		</div>
	</div>
	
	
	
<div class="mainInfo form-horizontal col-md-9">
      
<button disabled="disabled" onclick="return confirm('Вы действительно хотите удалить запись?')" type="submit" class="btn btn-sm btn-small btn-danger" id="del" name="del"  title="Удалить"><i class=" icon-trash"></i>Удалить выделенные записи</button>   
  	<div class="col-xs-12"><div id="example2_filter" class="dataTables_filter"><label>Поиск: <input type="text" name="search" class="form-control input-sm" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" ></label></div></div>
	
	<button type="submit" class="btn btn-danger btn-sm btn-small"  name="find" style="background-color: #3F9635;  border-color: #548347;   position: absolute;  margin: -35px 0px 0px 182px;"><i class="icon-search-4"></i> Поиск</button> 
	
    
<section id="settings-notifications">
<table id="example2" class="example table table-striped table-bordered" cellspacing="0">
	<thead>
		<tr>
			<th style="width: 30px;">  </th>
			<th style="width: 30px;">  </th>
			<th data-class="expand">Наименование</th>
		</tr>
	</thead>
<tbody>
<?php
$_PAGING = new Paging($con);
$search = $_POST['search'];
$r = $_PAGING->get_page( "SELECT * FROM scheduler WHERE (name LIKE '%$search%' OR id LIKE '%$search%') AND (type = '3' OR type = '9' OR type = '10') AND id_user = '$G_id_user' " ); 
while($mIDDN = $r->fetch_assoc())
{
//$IDDN = mysqli_query($con,"SELECT * FROM scheduler WHERE (type = '3' OR type = '9' OR type = '10') AND id_user = '$G_id_user'");
//if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
?>
			
<tr>										

	<td>
	<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
	<input id="chbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='box[]' value=<?php	echo $mIDDN['id']; ?>>
	<?php	} else {echo "<i class='icon-lock-4 lock-tab'></i>";} ?>
	</td>

			
	<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php if($mIDDN['type']==9){?><i class="  icon-camera text-success" style="font-size: 20px; color: #BD8836; ?> !important;"></i>	<?php } ?>
	<?php if($mIDDN['type']==3){?><i class="icon-map-1 text-success" style="font-size: 20px; color:#50ADCF; ?> !important;"></i>	<?php } ?>
	<?php if($mIDDN['type']==10){?><i class="icon-temperatire text-success" style="font-size: 20px; color:#50ADCF; ?> !important;"></i>	<?php } ?>
	</td>
						
	<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php if($mIDDN['type']==10){echo "Датчик: ";}?>
	<i class="<?php	echo $mIDDN['ico']; ?> text-success" style="font-size: 15px; color: <?php	echo $mIDDN['color']; ?> !important;"></i>
	<b style="font-size: 13px;"><?php echo $mIDDN['name']; ?></b><br>
												
	<?php	if($mIDDN['commands']!=NULL){echo "Выполняемые комманды: ".$mIDDN['commands']."<br>";} ?>	
	<?php	if($mIDDN['conditions']!=NULL){echo "Контроль состояния: ".$mIDDN['conditions']."<br>"; } ?>
	<?php	if($mIDDN['drivers']!=NULL&$mIDDN['type']==10){echo "Типы датчиков: ".$mIDDN['drivers']."<br>";} ?>
	<?php	if($mIDDN['drivers']!=NULL&$mIDDN['type']==9){echo "Путь до камеры: <dr style='color: #00B3EE;'><b>".$mIDDN['drivers']."</b></dr><br>";} ?>
	

	<?php	
	    $con_R = $mIDDN['conditions'];	$re = mysqli_query($con,"SELECT * FROM `commands` WHERE id ='$con_R'");
		if($re) {   while($row_rt = mysqli_fetch_assoc($re)) 
		{
			$laststate_T=$row_rt['laststate'];	
	//		echo $laststate_T;
		} mysqli_free_result($re); } 
	?>
	
	
	
	<?php	if($laststate_T==1 AND $mIDDN['conditions']!=NULL){ ?><span class="label label-success">Включено</span><?php } ?>
	<?php	if($laststate_T==0 AND $mIDDN['conditions']!=NULL){ ?><span class="label label-info">Отключено</span><?php } ?>
	<?php	if($mIDDN['conditions']==NULL AND $mIDDN['type']==3){ ?><span class="label label-warning">Нет контроля</span><?php } ?>

	</td>								  
															  
	<script type="text/javascript">
	function getText<?php echo $mIDDN['id'];?>(){
		document.getElementById('name').value = '<?php	echo $mIDDN['name']; ?>';
		$('#conditions').val('<?php	echo $mIDDN['conditions']; ?>').change();
		document.getElementById('id').value = '<?php	echo $mIDDN['id']; ?>';
		<?php	if($mIDDN['type']==9){ ?>	
		document.getElementById('drivers').value = '<?php	echo $mIDDN['drivers']; ?>';
		<?php } else { ?>	
		$("#typedev").val([<?php	echo $mIDDN['drivers']; ?>]).select2();
		<?php }  ?>	
		$('#moddevice').val('<?php	echo $mIDDN['name']; ?>').change();
		document.getElementById('ico').value = '<?php	echo $mIDDN['ico']; ?>';
		document.getElementById('icocolor').value = '<?php	echo $mIDDN['color']; ?>';
		document.getElementById('icoclass').className  = '<?php	echo $mIDDN['ico']; ?>';
		$("#commands").val([<?php	echo $mIDDN['commands']; ?>]).select2();
		$('#type').val('<?php	echo $mIDDN['type']; ?>').change();
		document.myForm.edit.disabled = false;
		document.myForm.clinss.disabled = false;
	}
	</script>
  
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

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</form>
</body>
</html>

<script type="text/javascript">
var count = 0;
$(function() {  count = $('input[type=checkbox]:checked').length; displayCount();
 $('input[type=checkbox]').bind('click' , function(e, a) {if (this.checked) { count += a ? -1 : 1;} else { count += a ? 1 : -1;} displayCount();    });});
function displayCount() {
	if(count>0){document.getElementById('del').disabled = false;}	
	if(count==0){document.getElementById('del').disabled = true;}
	}
</script>

<script type="text/javascript">
function clin(){
		$('#conditions').val('').change();
		$('#type').val('').change();
		document.getElementById('id').value = '';
		document.getElementById('name').value = '';
		document.getElementById('drivers').value = '';
  		$("#commands").val(['']).select2();
		document.myForm.edit.disabled = true;
		document.myForm.clinss.disabled = true;
}
</script>

<script type="text/javascript">
 function go(i_page) 
  { 
    var val_i_page = i_page.value;
 
  if(val_i_page==0)
 {
 
	document.getElementById('i_name').style.display="none";
	document.getElementById('i_commands').style.display="none";
	document.getElementById('i_conditions').style.display="none";
	document.getElementById('i_icond').style.display="none";
	document.getElementById('i_drivers').style.display="none";
	document.getElementById('i_imgoff').style.display="none";
	document.getElementById('i_moddevice').style.display="none";
	document.getElementById('i_webcam').style.display="none";
	document.getElementById('i_typedev').style.display="none";
	}
	
 if(val_i_page==9)
 {
 
	document.getElementById('i_name').style.display="block";
	document.getElementById('i_commands').style.display="none";
	document.getElementById('i_conditions').style.display="none";
	document.getElementById('i_drivers').style.display="block";
	document.getElementById('i_moddevice').style.display="none";
	document.getElementById('i_typedev').style.display="none";
	document.getElementById('i_webcam').style.display="block";
	document.getElementById('i_icond').style.display="none";
	}
	
		
if(val_i_page==3)
 {
	document.getElementById('i_name').style.display="block";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="block";
	document.getElementById('i_drivers').style.display="none";
	document.getElementById('i_moddevice').style.display="none";
	document.getElementById('i_typedev').style.display="none";
		document.getElementById('i_webcam').style.display="none";
	document.getElementById('i_icond').style.display="block";
	}	
	
	if(val_i_page==10)
 {
	document.getElementById('i_name').style.display="none";
	document.getElementById('i_commands').style.display="none";
	document.getElementById('i_conditions').style.display="none";
	document.getElementById('i_drivers').style.display="none";
	document.getElementById('i_moddevice').style.display="block";
	document.getElementById('i_webcam').style.display="none";
	
	document.getElementById('i_typedev').style.display="block";
	document.getElementById('i_icond').style.display="none";
	}	
  } 
</script> 

<script>
window.onload=function(){
if(window.innerWidth<680) {
document.getElementById("pole").style.width="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("topmenu").style.width="0px";
document.getElementById("paddi").style.padding="0px";
document.getElementById("pole").style.display="none";

document.getElementById("topmenu").style.display="none";
}};
</script>