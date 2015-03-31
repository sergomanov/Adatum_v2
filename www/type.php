<?php	
 include 's-head.php';
 include 'adatum.class.php';
 include 's-lib.php'; 
 
$errors=NULL;if($G_id_user==2){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Изменения данных в демо режиме запрещенны !";}

if (isset($_POST['testdata'])) {
	
mysqli_query($con,"
INSERT INTO `type` (`id`, `mode`, `name`, `namevalue1`, `namevalue2`, `namevalue3`, `id_user`, `type`, `ico`, `symbol`, `regim`, `color`, `tchart`, `control`) VALUES
(NULL, 'LUM', 'Освещённость', 'Овещённость', '', '', '$G_id_user', 1, 'icon-lamp', 'L', 1, '#78cf50', 0, 0),
(NULL, 'TEM', 'Температура', 'Температура', '', '', '$G_id_user', 1, ' icon-temperatire', 'С°', 1, '#c23c2a', 0, 0),
(NULL, 'HUM', 'Влажность', 'Влажность', '', '', '$G_id_user', 1, 'icon-tint', '%', 1, '#3f2ac2', 0, 0),
(NULL, 'P', 'Давление', 'Давление', '', '', '$G_id_user', 1, 'icon-hammer', 'Па', 1, '#9c7d30', 0, 0),
(NULL, 'MU', 'Звуковой сигнал', 'Частота сигнала', 'Длительность', '', '$G_id_user', 2, 'icon-bullhorn', '', 3, '#435cd9', 0, 0),
(NULL, 'MIC', 'Уровень шума', 'Уровень шума', '', '', '$G_id_user', 1, 'icon-sound-1', '', 1, '#23222b', 0, 0),
(NULL, 'IR', 'ИК Пульт', 'Производитель', 'Код устройства', 'Частота шины', '$G_id_user', 3, 'icon-keyboard', '', 0, '', 0, 0),
(NULL, 'KEY', 'Нажатие кнопки', 'Номер реле', 'Состояние устройства (ON , OFF, Яркость от 0 до 10000)', 'Длительность ', '$G_id_user', 3, 'icon-keyboard', '', 0, '', 1, 0),
(NULL, 'LED', 'Световая сигнализация', 'Длительность(милсек)', 'Количество', '', '$G_id_user', 2, 'icon-lamp-1', '', 3, '#bbc452', 0, 0),
(NULL, 'iBN', 'iButton ключ', 'Тип ключа', 'Код устройства', '', '$G_id_user', 2, 'icon-key', '', 1, '#2ec7ab', 1, 0),
(NULL, 'PIR', 'Движение', 'Движение', '', '', '$G_id_user', 1, 'icon-ticket-2', '', 1, '', 0, 0),
(NULL, 'RF', 'Радиомодуль 315Мгц.', 'Код устройства', 'Частота шины', 'Длительность сигнала', '$G_id_user', 3, 'icon-signal-3', '', 0, '', 0, 0);
");
header("Location: type.php");
}



if (isset($_POST['addtype'])) {

$name = $_POST['nametype'];
$type = $_POST['typetype'];
$ico = $_POST['ico'];
$mode = $_POST['modetype'];
$symbol = $_POST['symbol'];
$namevalue1 = $_POST['namevalue1'];
$namevalue2 = $_POST['namevalue2'];
$namevalue3 = $_POST['namevalue3'];

$regim = $_POST['regim'];
$tchart = $_POST['tchart'];
$colorss = $_POST['icocolor'];

if($type == '1') {  $namevalue2='';  $namevalue3=''; };
if($type == '2') {  $namevalue3='';  };
if($type == '4') {  $namevalue1=''; $namevalue2='';  $namevalue3='';  };

$idt=0; $rtype = mysqli_query($con,"SELECT * FROM type WHERE (mode='$mode' AND id_user = '$G_id_user') OR (mode='$mode' AND id_user = '0') "); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}
if($idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Датчик с таким типом уже есть в базе !";}

if($errors==NULL){
mysqli_query($con,"INSERT INTO type (name,type,ico,mode,symbol,namevalue1,namevalue2,namevalue3,regim,tchart,color,id_user) VALUES ('$name','$type','$ico','$mode','$symbol','$namevalue1','$namevalue2','$namevalue3','$regim','$tchart','$colorss','$G_id_user')");
header("Location: type.php");
}
}




if (isset($_POST['edittype'])) {
	$id = $_POST['idtype'];
	$name = $_POST['nametype'];
	$type = $_POST['typetype'];
	$ico = $_POST['ico'];
	$mode = $_POST['modetype'];
	$symbol = $_POST['symbol'];
	$namevalue1 = $_POST['namevalue1'];
	$namevalue2 = $_POST['namevalue2'];
	$namevalue3 = $_POST['namevalue3'];
	$regim = $_POST['regim'];
	$tchart = $_POST['tchart'];
	$colorss = $_POST['icocolor'];
	if($type == '1') {  $namevalue2='';  $namevalue3=''; };
	if($type == '2') {  $namevalue3=''; };
	if($type == '4') {  $namevalue1=''; $namevalue2='';  $namevalue3=''; };
	
$idt=0; $rtype = mysqli_query($con,"SELECT * FROM type WHERE mode='$mode' "); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++; $id_r = $rowr['id'];}

if($id_r!=$id AND $idt>0 ){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Датчик с таким типом уже есть в базе !";}
	
if($errors==NULL){
	mysqli_query($con,"UPDATE type SET name='$name',type='$type',ico='$ico',mode='$mode',symbol='$symbol',namevalue1='$namevalue1',namevalue2='$namevalue2',namevalue3='$namevalue3',regim='$regim',tchart='$tchart',color='$colorss'  WHERE id = '$id'");
	header("Location: type.php");
}
}
 
	
	
if (isset($_POST['deltype'])) {
	$box_array = $_REQUEST['boxtype'];
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
		foreach($box_array as $key => $value) {  
		mysqli_query($con,"DELETE FROM type WHERE id='$value'"); 
		} 
	header("Location: type.php");
 }
 ?>
 
<!DOCTYPE html>
<html>
	<head>
		<?php	 include 'head.php'; ?>
	</head>
	
	<body class="white">
	<form name="myForm" method="post" >
	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

							
							
<div class="s2-map " id="map">
<div class="right-area -js-right-area Mscroll" style="display: block;  padding: 0px;  outline: none;" tabindex="0">
<div class="jspContainer" >
<div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;">  Типы датчиков   </h2>
	<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
	<?php	 include 'icon.php'; ?>	
	
	
<div class=" form-horizontal col-md-3"> 
 <div class="section">
	
			<br>
			<input  type="hidden"  name="idtype" id="idtype" class="form-control"  placeholder="">
		 
			<p>Наименование </p>
            <input id="nametype" name="nametype" type="text" class="form-control" maxlength="27" placeholder="Наименование">

			<p>Режим </p>

<select id="typetype" class="form-control" name="typetype" onChange="javascript: go(this);" style="width:100%"> 
	<option value="0"></option> 
	<option value="1">1 - Модуль (1 параметр)</option> 
	<option value="2">2 - Модуль (2 параметра)</option>
	<option value="3">3 - Модуль (3 параметра)</option>
	<option value="4">4 - Модуль (Без параметров)</option> 
</select>

 <div id="i_chart" style="display: none"><p>Тип Графика</p>
 	<div class="radio radio-success">
	
                        <input id="mradio0" type="radio" name="tchart" value="0">
                        <label for="mradio0"><i style="font-size: 16px; color: #AE87F2  !important;" class="icon-chart-area"></i> Линейный</label>
						<br>
                        <input id="mradio1" type="radio" name="tchart" value="1">
                        <label for="mradio1"><i style="font-size: 16px; color: #83A64E  !important;" class="icon-chart-bar"></i> Бары</label><br>
    </div>
 
 </div>
 
 
	<div id="i_vale4"><p>Условие</p>
	<div class="radio radio-success">
	
                        <input id="radio0" type="radio" name="regim" value="0">
                        <label for="radio0"> <> прием - отправка</label><br>
						
                        <input id="radio1" type="radio" name="regim" value="1">
                        <label for="radio1"> > только прием</label><br>
						
						<input id="radio3" type="radio" name="regim" value="3">
                        <label for="radio3"> < только отправка</label><br>
						
                      </div>
					  </div> 



	<div id="i_all" style="display: none">
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


<p>Тип</p>
	
     

<?php  $rp="";	$resulte = mysqli_query($con,"SELECT mode FROM developments GROUP BY mode ");while($rowe = mysqli_fetch_assoc($resulte)) {  $rp="'".$rowe['mode']."',".$rp;		}	?> 
 

<script>
$(document).ready(function (){	$('#modetype').autocomplete({source: [<?php echo $rp; ?>],
minLength: 0,delay: 0});$('#modetype').bind('focus', function() {if ($(this).val() == '') $(this).autocomplete('search', '');	});});
</script>

<input class="form-control" type="text" id="modetype" name="modetype" maxlength="4" value="" />

</div>
	
<div id="i_simvol" style="display: none">
	<p>Символ</p>
	<?php   $rp="";		$resulte = mysqli_query($con,"SELECT symbol FROM type GROUP BY symbol ");while($rowe = mysqli_fetch_assoc($resulte)) {   $rp="'".$rowe['symbol']."',".$rp;		}	?> 
	<script>$(document).ready(function (){	$('#symbol').autocomplete({source: [<?php echo $rp; ?>],minLength: 0,delay: 0});$('#symbol').bind('focus', function() {if ($(this).val() == '') $(this).autocomplete('search', '');	});});</script>
	<input class="form-control" type="text" id="symbol" name="symbol"  />
</div>

<div style="  background: #EBEBEB;  padding: 7px;margin-top: 7px;  border-radius: 8px;">	
 <div id="i_parm1" style="display: none"><p>Параметр 1</p><input id="namevalue1" name="namevalue1" type="text" class="form-control"  placeholder="Наименование 1"></div>
 <div id="i_parm2" style="display: none"><p>Параметр 2</p><input id="namevalue2" name="namevalue2" type="text" class="form-control"  placeholder="Наименование 2"></div>	
 <div id="i_parm3" style="display: none"><p>Параметр 3</p><input id="namevalue3" name="namevalue3" type="text" class="form-control"  placeholder="Наименование 3"></div>
</div>		   
			<br>
				<br>
			

<button type="submit" class="btn btn-sm btn-small btn-primary" name="addtype" value="" ><i class="icon-plus"></i> Добавить</button>
<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="edittype" value="" ><i class="icon-edit"></i> Изменить</button>
<button type="button" disabled="disabled" onclick="clintyper()"  class="btn btn-sm btn-small btn-white" name="clintype" value="" >Очистить</button>

        </div>
	</div>
	


    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
<button id="del" disabled="disabled" onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-sm btn-danger btn-small"  name="deltype"title="Удалить записи"><i class=" icon-trash"></i> Удалить выделенные записи</button> 

<?php
if ($result=mysqli_query($con,"SELECT * FROM type WHERE id_user = '$G_id_user'"))  {
  $rowcount=mysqli_num_rows($result);  
}
if($rowcount==0){
?>

<button id="testdata" type="submit" class="btn btn-sm btn-danger btn-small"  name="testdata"  title="Добавить типы датчиков по умолчанию" style="background: #4386A0; border-color: #38CDB1;"><i class="icon-database-3"></i> Добавить типы датчиков по умолчанию</button> 
<?php } ?>



	
      	<div class="col-xs-12"><div id="example2_filter" class="dataTables_filter"><label>Поиск: <input type="text" name="search" class="form-control input-sm" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" ></label></div></div>
	
	<button type="submit" class="btn btn-danger btn-sm btn-small"  name="find" style="background-color: #3F9635;  border-color: #548347;   position: absolute;  margin: -35px 0px 0px 182px;"><i class="icon-search-4"></i> Поиск</button> 
	
<section id="settings-notifications">
<table id="example84" class="example table table-striped table-bordered" cellspacing="0">
	<thead>
		<tr>
			<th data-class="expand" style="width: 30px;">  </th>
			<th data-class="expand" style="width: 30px;">  </th>
			<th data-hide="phone,tablet">Тип</th>
			<th data-class="expand">Наименование</th>
			<th data-hide="phone,tablet">Наименование </th>
			<?php if($G_id_user==1){ ?> <th data-hide="tablet">Пользователь</th><?php } ?>
		</tr>
	</thead>
<tbody>
<?php
$_PAGING = new Paging($con);
$search = $_POST['search'];
if($G_id_user==1){
$r = $_PAGING->get_page( "SELECT * FROM type WHERE (mode LIKE '%$search%' OR name LIKE '%$search%' OR namevalue1 LIKE '%$search%' OR namevalue2 LIKE '%$search%' OR namevalue2 LIKE '%$search%') " ); 	
	} else {
$r = $_PAGING->get_page( "SELECT * FROM type WHERE (id_user = '$G_id_user' OR id_user = '0') AND (mode LIKE '%$search%' OR name LIKE '%$search%' OR namevalue1 LIKE '%$search%' OR namevalue2 LIKE '%$search%' OR namevalue2 LIKE '%$search%') " ); 
	}
while($mIDDN = $r->fetch_assoc())
{
//if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM type");}
//			else {$IDDN = mysqli_query($con,"SELECT * FROM type WHERE id_user = '$G_id_user' OR id_user = '0'");}
//if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
$M_id_user = $mIDDN['id_user'];
?>
			
<tr>

<td  style="cursor: pointer;" onclick="getText3<?php echo $mIDDN['id'];?>()">
<i class="<?php	echo $mIDDN['ico']; ?> text-success" style="font-size: 20px; color: <?php	echo $mIDDN['color']; ?> !important;"></i>
</td>


<td>
<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
<input id="Fbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='boxtype[]' value=<?php	echo $mIDDN['id']; ?>>
<?php	} else {echo "<i class='icon-lock-4 lock-tab'></i>";} ?>
</td>	
	
<td style="cursor: pointer;" onclick="getText3<?php echo $mIDDN['id'];?>()"><?php	echo $mIDDN['mode']; ?></td>

<td style="cursor: pointer;" onclick="getText3<?php echo $mIDDN['id'];?>()"><?php	echo $mIDDN['name']; ?></td>									
										
<td onclick="getText3<?php echo $mIDDN['id'];?>()" style="cursor: pointer;">
	
	<?php	if($mIDDN['tchart']==1&&$mIDDN['type']==1){ ?> <i style="font-size: 20px; color: #83A64E  !important;" class="icon-chart-bar"></i><?php	} ?>
	<?php	if($mIDDN['tchart']==0&&$mIDDN['type']==1){ ?> <i style="font-size: 20px; color: #AE87F2  !important;" class="icon-chart-area"></i><?php	} ?>
	<dv style="color: #F90A0A;"><b><?php	echo "[ ".$mIDDN['type']." - параметр ]<br>"; ?></b></dv>
	<?php	if($mIDDN['namevalue1']!=NULL){ echo "- ".$mIDDN['namevalue1'].".<br>";} ?>
	<?php	if($mIDDN['namevalue2']!=NULL) {echo "- ".$mIDDN['namevalue2'].".<br>"; }?>
	<?php	if($mIDDN['namevalue3']!=NULL) {echo "- ".$mIDDN['namevalue3'].".<br>"; }?>
	<div style="color: #337198;"><b>
	<?php	if($mIDDN['regim']==0){ ?>[<> Приём - отправка]<?php	} ?>
	<?php	if($mIDDN['regim']==1){ ?>[> Только прием]<?php	} ?>
	<?php	if($mIDDN['regim']==3){ ?>[< Только отправка]<?php	} ?>
	</b></div>
	<?php	if($mIDDN['symbol']!=NULL){echo "Символ: ".$mIDDN['symbol'];} ?>
</td>
																			 
<?php if($G_id_user==1){ ?> 
<td>
<?php	$rtype = mysqli_query($con,"SELECT * FROM users WHERE id_user='$M_id_user' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['login_user'];} ?>
</td>
<?php } ?>												
														  
<script type="text/javascript">
function getText3<?php echo $mIDDN['id'];?>(el){

	document.getElementById('idtype').value = '<?php	echo $mIDDN['id']; ?>';
	document.getElementById('nametype').value = '<?php	echo $mIDDN['name']; ?>';
	document.getElementById('modetype').value = '<?php	echo $mIDDN['mode']; ?>';
	document.getElementById('ico').value = '<?php	echo $mIDDN['ico']; ?>';
	document.getElementById('icocolor').value = '<?php	echo $mIDDN['color']; ?>';
	<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
	document.myForm.edittype.disabled = false;
	document.myForm.clintype.disabled = false;
	<?php	} else { ?>
	document.myForm.edittype.disabled = true;
	document.myForm.clintype.disabled = true;
	<?php	}  ?>

	document.getElementById('symbol').value = '<?php	echo $mIDDN['symbol']; ?>';
	document.getElementById('icoclass').className  = '<?php	echo $mIDDN['ico']; ?>';
	document.getElementById("radio<?php	echo $mIDDN['regim']; ?>").checked = true; 
	document.getElementById("mradio<?php	echo $mIDDN['tchart']; ?>").checked = true; 
	document.getElementById('namevalue1').value = '<?php	echo $mIDDN['namevalue1']; ?>';
	document.getElementById('namevalue2').value = '<?php	echo $mIDDN['namevalue2']; ?>';
	document.getElementById('namevalue3').value = '<?php	echo $mIDDN['namevalue3']; ?>';
	$('#typetype').val('<?php	echo $mIDDN['type']; ?>').change();
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
				
		</div>

	</form>
	</body>
</html>

<script type="text/javascript">
function clintyper(){
	document.getElementById('idtype').value = '';
	document.getElementById('nametype').value = '';
	document.getElementById('modetype').value = '';
	document.getElementById('ico').value = '';
	document.getElementById('icocolor').value = '';
	document.getElementById('symbol').value = '';
	document.getElementById('icoclass').className  = '';
	$('#typetype').val('').change();
	document.getElementById('namevalue1').value = '';
	document.getElementById('namevalue2').value = '';
	document.getElementById('namevalue3').value = '';
	document.myForm.edittype.disabled = true;
	document.myForm.clintype.disabled = true;
}
</script>	
	   
<script type="text/javascript">
function go(i_page) 
{ 
    var val_i_page = i_page.value;
 

if(val_i_page==0)
 {
document.getElementById('i_all').style.display="none";
document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm1').style.display="none";
document.getElementById('i_parm2').style.display="none";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_chart').style.display="none";
}
	
 if(val_i_page==1)
 {
document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
document.getElementById('i_simvol').style.display="block";
document.getElementById('i_parm2').style.display="none";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_chart').style.display="block";
	
	}
	
	 if(val_i_page==2)
 {
document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="block";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_chart').style.display="none";
	}		
		 if(val_i_page==3)
 {
document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="block";
document.getElementById('i_parm3').style.display="block";
document.getElementById('i_chart').style.display="none";
	}	
if(val_i_page==4)
 {
document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="none";
document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="none";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_chart').style.display="none";
	}
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