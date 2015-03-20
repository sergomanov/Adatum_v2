<?php	
 include 's-head.php';
 include 'adatum.class.php';
 $errors=NULL;	

if (isset($_POST['del'])) 
{
	$box_array = $_REQUEST['box']; 
	foreach($box_array as $key => $value) {		mysqli_query($con,"DELETE FROM commands WHERE id='$value'"); 		}
	header("Location: run.php");
}



if (isset($_POST['save'])) 
{

 $name = $_POST['name'];
 $mode = $_POST['mode'];
 $address = $_POST['address'];
 $vale1 = $_POST['vale1'];
 $vale2 = $_POST['vale2'];
 $vale3 = $_POST['vale3'];
 $vale4 = $_POST['vale4'];
 $controlir = $_POST['controlir'];
 

$ftype = mysqli_query($con,"SELECT * FROM `type` WHERE mode='$mode'");  if($ftype){while($ftype = mysqli_fetch_assoc($ftype)){ $rowmode=$ftype['type']; }} 

if($rowmode==1){ $vale=rtrim($vale1," \t,");}
if($rowmode==2){ $vale=rtrim($vale1.",".$vale2, " \t,");}
if($rowmode==3){ $vale=rtrim($vale1.",".$vale2.",".$vale3, " \t,");}
if($rowmode==4){ $vale="";}
 
$idt=0; $rtype = mysqli_query($con,"SELECT * FROM commands WHERE address='$address' AND mode='$mode' AND vale='$vale'"); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}
if($idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Это действияе или условие уже есть в базе !";} 
 
 
if($errors==NULL){
mysqli_query($con,"INSERT INTO commands (name, mode, address,cond,vale,id_user,controlir) VALUES ('$name','$mode','$address','$vale4','$vale','$G_id_user','$controlir')");
header("Location: run.php");
}

}



if (isset($_POST['edit'])) {
 $id = $_POST['id'];
 $name = $_POST['name'];
 $mode = $_POST['mode'];
 $address = $_POST['address'];
 $vale1 = $_POST['vale1'];
 $vale2 = $_POST['vale2'];
 $vale3 = $_POST['vale3'];
 $vale4 = $_POST['vale4'];
 $controlir = $_POST['controlir']; 
 
 $ftype = mysqli_query($con,"SELECT * FROM `type` WHERE mode='$mode'");  if($ftype){while($ftype = mysqli_fetch_assoc($ftype)){ $rowmode=$ftype['type']; }} 

if($rowmode==1){ $vale=rtrim($vale1," \t,");}
if($rowmode==2){ $vale=rtrim($vale1.",".$vale2, " \t,");}
if($rowmode==3){ $vale=rtrim($vale1.",".$vale2.",".$vale3, " \t,");}
if($rowmode==4){ $vale="";}
 
 if($errors==NULL){
mysqli_query($con,"UPDATE commands SET name='$name',mode ='$mode',address ='$address',vale ='$vale',cond ='$vale4',controlir ='$controlir'  WHERE id = '$id'");
header("Location: run.php");
 }
}


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
<div class="jspPane" style="padding: 0px; top: 0px;">
<div class="right-area-content -js-right-area-content">
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;"> Действия и условия </h2>
	<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>			 
				<br>
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
<select id="mode" class="form-control" name="mode" onChange="javascript: go(this);" style="width:100%"> 
<option value="0"></option> 
<?php $restype = mysqli_query($con,"SELECT * FROM type WHERE id_user = '$G_id_user' OR id_user = '0'"); 
	  if($restype){while($rowtype = mysqli_fetch_assoc($restype)){ $rowmode=$rowtype['mode']; ?>
			<option value="<?php echo $rowtype['mode']?>"><?php echo $rowtype['mode']?> - <?php echo $rowtype['name']?></option> 

<?php		}}   ?>

</select>
	  




<div id="i_name" style="display: none"> 
	<p>Наименование </p>
	<input id="name" name="name" type="text" class="form-control" placeholder="Наименование">
</div> 	

<div id="i_address" style="display: none">
	<p>Номер устройства</p>
	<select id="address" class="form-control" name="address"> 
	<?php    $resulte = mysqli_query($con,"SELECT * FROM namedev WHERE id_user = '$G_id_user' OR id_user = '0' GROUP BY address ");while($rowe = mysqli_fetch_assoc($resulte)) { ?> 
	<option value="<?php  echo $rowe['address'];?>"><?php  echo $rowe['address'];?> - <?php  echo $rowe['name'];?></option> 	
	<?php } ?> 
	</select>	
</div> 
		
		<div id="i_vale4" style="display: none"><p>Условие</p><div class="radio radio-success">
                        <input id="radio0" type="radio" name="vale4" value="0">
                        <label for="radio0">Равно =</label><br>
                        <input id="radio1" type="radio" name="vale4" value="1" >
                        <label for="radio1">Больше ></label><br>
						<input id="radio2" type="radio" name="vale4" value="2">
                        <label for="radio2">Меньше <</label>
                      </div>
		</div> 
				
<div class="radio radio-success" style="padding: 6px;  margin-top: 8px;  background: #D5D5D5;  border-radius: 6px;">
                        
     <div style="font-size: 11px;  color: #3F47CB;  padding: 3px;">
	 Для отображения датчика в списке 'Устройство контроля состояния' УПРАВЛЕНИЯ ПАНЕЛЬЮ ЗАДАЧ необходимо выбрать контролируемое значение <br>(должно принимать значения <gcol>0</gcol> либо <gcol>1</gcol>)
	 </div>                
		<input id="Mradio0" checked="checked" type="radio" name="controlir" value="0" style="margin-left: 5px;  margin-bottom: 4px;"><label for="Mradio0">&nbsp; Нет контроля</label>				

		<p id="i_vale1_name" style=" font-size: 11px;"></p>
		<div id="i_vale1" style="display: none">
		<input id="Mradio1" type="radio" name="controlir" value="1" style="margin-left: 5px;  margin-bottom: 4px;"><label for="Mradio1">&nbsp; Контроль по этому значению</label><br>
		<input type="text" name="vale1" id="vale1" class="form-control" placeholder=""> 
		</div> 

		<p id="i_vale2_name" style=" font-size: 11px;"></p>
		<div id="i_vale2" style="display: none">
		   <input id="Mradio2" type="radio" name="controlir" value="2" style="margin-left: 5px;  margin-bottom: 4px;"><label for="Mradio2">&nbsp; Контроль по этому значению</label><br>
		<input type="text" name="vale2" id="vale2" class="form-control" placeholder=""> 
		</div> 
		
		<p id="i_vale3_name" style=" font-size: 11px;"></p>
		<div id="i_vale3" style="display: none">
		<input id="Mradio3" type="radio" name="controlir" value="3" style="margin-left: 5px;  margin-bottom: 4px;"><label for="Mradio3">&nbsp; Контроль по этому значению</label><br>
		<input type="text" name="vale3" id="vale3" class="form-control" placeholder="">
		</div> 
			
</div>				
		
	
				   
			<br>
				<br>
			
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
      
      
<button id="del" disabled="disabled" onclick="return confirm('Вы действительно хотите удалить записи?')" type="submit" class="btn btn-danger btn-sm btn-small"  name="del" title="Удалить записи"><i class="icon-trash-8"></i> Удалить записи</button> 
		   
     
<section id="settings-notifications">

<table id="example2" class="example table table-striped table-bordered" cellspacing="0">
<thead>
                <tr>
                    <th data-class="expand" width="30"> </th>
					<th data-class="expand" width="30"> </th>
					<th data-class="expand">Тип</th>
				    <th data-class="expand"> </th>
                    <th data-class="expand">Наименование</th>
				    <th data-hide="phone,tablet" style="width:130px">MAC устройства</th>
				    <th data-hide="phone,tablet">Действие (условие)</th>		
					<?php if($G_id_user==1){ ?> <th data-hide="tablet">Пользователь</th><?php } ?>					
                </tr>
</thead>

<tbody>
<?php
if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM commands  ORDER BY id DESC");}
else { $IDDN = mysqli_query($con,"SELECT * FROM commands  WHERE id_user = '$G_id_user' OR id_user = 1 ORDER BY id DESC");}
if($IDDN) { while($row= mysqli_fetch_assoc($IDDN)) {
$timein=$row['timein'];  if($timein!=NULL){$timein=date('Y-m-d / H:i:s',$timein);}
$timeout=$row['timeout'];  if($timeout){$timeout=date('Y-m-d / H:i:s',$timeout);}
$M_address = $row['address'];
$M_id_user = $row['id_user'];
$rowmode = $row['mode']; 

$Str = mysqli_query($con,"SELECT * FROM type WHERE mode='$rowmode' AND id_user = '$G_id_user'"); while($rowrT = mysqli_fetch_assoc($Str)) {$G_regim = $rowrT['regim'];} 
?>
			
<tr>
	
	<?php	$Mcommands="#".$row['address']."#".$row['mode']."#".$row['vale']."##";  ?>

	<?php if($G_regim==0 OR $G_regim==3 OR $G_regim==2){ ?>
	<td onclick="$.ajax({type: 'POST',url: 's-respfast.php',data: 'value=<?php	echo $Mcommands; ?>',success: function(data){$('.results').html(data);}});" class="mycursor">
	<i class="icon-flash " style="color:#E9AE16;font-size: 20px;"></i><sm>0<sm>
	</td>
	<?php } else { ?>
	<td><i class="icon-block-4" style="color:#FF0000;font-size: 20px;"></i><sm>1<sm></td>
	<?php } ?>
	

	<td onclick="getText<?php echo $row['id'];?>()" style="cursor: pointer;">
	<?php
	 
	 if($G_id_user==1){$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' LIMIT 1");} 
				 else {$resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode' AND (id_user = '$G_id_user' OR id_user = '0')");}
	 if($resico){while($rowico = mysqli_fetch_assoc($resico)){$rowicon=$rowico['ico']; $rowcolor=$rowico['color'];?>
	 <i class="<?php echo $rowicon; ?> text-success " style="font-size: 18px; color: <?php	echo $rowcolor; ?> !important;"></i> <?php }}  ?>

     
<?php if($row['controlir']==0){?> <i class="icon-eye-off" style="font-size: 18px; color: #E4E4E4 !important;"></i> <?php }  ?>
<?php if($row['controlir']!=0){?><i class="icon-eye" style="font-size: 18px; color: #6851D2 !important;"></i> <?php }  ?>
			
	 
	 
	  
	 </td>


	<td onclick="getText<?php echo $row['id'];?>()" style="cursor: pointer;">
	<?php	echo $row['mode']; ?>
	</td>  

						  
	<td> 
	<div class="checkbox check-default"><input id="checkbox<?php	echo $row['id']; ?>" type="checkbox"  name='box[]' value=<?php	echo $row['id']; ?>><label for="checkbox<?php	echo $row['id']; ?>"></label></div>
	</td>		
		
	<td onclick="getText<?php echo $row['id'];?>()" style="cursor: pointer;">
	<span style="color: #2271D8;"><?php	echo $row['name']; ?><br></span>
	</td>



	<td width="90" onclick="getText<?php echo $row['id'];?>()" style="cursor: pointer;">
	<?php	echo $row['address']; ?>
	<gcol><?php	$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$M_address' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['name'];} ?></gcol>
	</td>
		
		
		
	<td onclick="getText<?php echo $row['id'];?>()" style="cursor: pointer;">
	
			<?php if($row['cond']==1){?>Выполняется если значение больше: <?php }  ?>
			<?php if($row['cond']==2){?>Выполняется если значение меньше: <?php }  ?>
					
	<?php	echo $row['vale']; ?>

	<br><span style="color: #2271D8;">
	<?php	if($row['unixtime']!=0){echo "Выполнялось: ".date("Y-m-d H:m:s", $row['unixtime']+$timezone); }  else { echo "Не выполнялось";}   ?> 
	<br><span style="color: #A4CA2A;"><?php	if($row['laststate']!=NULL){echo "Последнее значение: ".$row['laststate']; }?></span> 

	</td>

<?php if($G_id_user==1){ ?> 
<td>
<?php	$rtype = mysqli_query($con,"SELECT * FROM users WHERE id_user='$M_id_user' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['login_user'];} ?>
</td>
<?php } ?>	

	
<?php		$Pval  = $row['vale'];	$Pvalue = explode(",", $Pval);	?>
<script type="text/javascript">
function getText<?php echo $row['id'];?>(el){
		document.myForm.edit.disabled = false;
		document.myForm.clinss.disabled = false;
		$('#mode').val('<?php	echo $row['mode']; ?>').change();
		$('#mode').val('<?php	echo $row['mode']; ?>').change();
		document.getElementById('id').value = '<?php	echo $row['id']; ?>';
		document.getElementById('name').value = '<?php	echo $row['name']; ?>';
		document.getElementById('address').value = '<?php	echo $row['address']; ?>';
		document.getElementById('vale1').value = '<?php	echo $Pvalue[0]; ?>';
		document.getElementById('vale2').value = '<?php	echo $Pvalue[1]; ?>';
		document.getElementById('vale3').value = '<?php	echo $Pvalue[2]; ?>';
		document.getElementById("radio<?php	echo $row['cond']; ?>").checked = true; 
		document.getElementById("Mradio<?php	echo $row['controlir']; ?>").checked = true; 
	}
</script>
					  
</tr>
											
										<?php  }}	?>													
		  </tbody>
			</table>	
        </section>
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
function go(i_page) 
  { 
    var val_i_page = i_page.value;

  if(val_i_page==0)
 {
 
	document.getElementById('i_name').style.display="none";
    document.getElementById('i_address').style.display="none";
	document.getElementById('i_vale1').style.display="none";
	document.getElementById('i_vale2').style.display="none";
	document.getElementById('i_vale3').style.display="none";
	document.getElementById('i_vale4').style.display="none";
	document.getElementById('i_vale1_name').innerHTML='';
	document.getElementById('i_vale2_name').innerHTML='';
	document.getElementById('i_vale3_name').innerHTML='';
	
	
	}
	
<?php    $resscr = mysqli_query($con,"SELECT * FROM type");while($rowscr = mysqli_fetch_assoc($resscr)) { ?> 
		
 if(val_i_page=='<?php echo $rowscr['mode'];?>')
 {
	
	document.getElementById('i_vale1_name').innerHTML='<?php echo $rowscr['namevalue1'];?>';
	document.getElementById('i_vale2_name').innerHTML='<?php echo $rowscr['namevalue2'];?>';
	document.getElementById('i_vale3_name').innerHTML='<?php echo $rowscr['namevalue3'];?>';
 
 <?php if($rowscr['type']==1){ ?>
	document.getElementById('i_name').style.display="block";
    document.getElementById('i_address').style.display="block";
	document.getElementById('i_vale1').style.display="block";
	document.getElementById('i_vale2').style.display="none";
	document.getElementById('i_vale3').style.display="none";
	document.getElementById('i_vale4').style.display="block";
<?php } ?> 

 <?php if($rowscr['type']==2){ ?>
	document.getElementById('i_name').style.display="block";
    document.getElementById('i_address').style.display="block";
	document.getElementById('i_vale1').style.display="block";
	document.getElementById('i_vale2').style.display="block";
	document.getElementById('i_vale3').style.display="none";
	document.getElementById('i_vale4').style.display="none";
<?php } ?> 

 <?php if($rowscr['type']==3){ ?>
	document.getElementById('i_name').style.display="block";
    document.getElementById('i_address').style.display="block";
	document.getElementById('i_vale1').style.display="block";
	document.getElementById('i_vale2').style.display="block";
	document.getElementById('i_vale3').style.display="block";
	document.getElementById('i_vale4').style.display="none";
<?php } ?> 

 <?php if($rowscr['type']==4){ ?>
	document.getElementById('i_name').style.display="block";
    document.getElementById('i_address').style.display="block";
	document.getElementById('i_vale1').style.display="none";
	document.getElementById('i_vale2').style.display="none";
	document.getElementById('i_vale3').style.display="none";
	document.getElementById('i_vale4').style.display="none";
<?php } ?> 

	}
	 	
<?php } ?> 

  } 
</script> 

<script type="text/javascript">
	function clin(){
		document.myForm.edit.disabled = true;
		document.myForm.clinss.disabled = true;
		$('#mode').val('').change();
		$('#mode').val('').change();
		document.getElementById('id').value = '';
		document.getElementById('name').value = '';
		document.getElementById('address').value = '';
		document.getElementById('vale1').value = '';
		document.getElementById('vale2').value = '';
		document.getElementById('vale3').value = '';
		document.getElementById("radio0").checked = true; 
	}
</script>

<script type="text/javascript">
var count = 0;
$(function() {  count = $('input[type=checkbox]:checked').length; displayCount();
 $('input[type=checkbox]').bind('click' , function(e, a) {if (this.checked) { count += a ? -1 : 1;} else { count += a ? 1 : -1;} displayCount();    });});
function displayCount() {
	if(count>0){document.getElementById('del').disabled = false;}	
	if(count==0){document.getElementById('del').disabled = true;}
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