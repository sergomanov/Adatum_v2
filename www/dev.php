<?php	
 include 's-head.php';
 include 'adatum.class.php';
 include 's-lib.php'; 
 $errors=NULL;if($G_id_user==2){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Изменения данных в демо режиме запрещенны !";}
 
 if (isset($_POST['addname'])) {
$name = $_POST['name2'];
$address = $_POST['address2'];

$idt=0; $rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$address' "); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}
if($idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Устройство с таким MAC адресом уже есть в базе !";}

if($errors==NULL){
mysqli_query($con,"INSERT INTO namedev (name, address,id_user) VALUES ('$name', '$address','$G_id_user')");
header("Location: dev.php");	
 }
}



if (isset($_POST['editname'])) {
$id = $_POST['id2'];
$name = $_POST['name2'];
$address = $_POST['address2'];


$idt=0; $rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$address' "); while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}

$rtype = mysqli_query($con,"SELECT * FROM namedev WHERE address='$address'"); while($rowr = mysqli_fetch_assoc($rtype)) {$id_r = $rowr['id'];}
if($id_r!=$id AND $idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Устройство с таким MAC адресом уже есть в базе !";}


if($errors==NULL){
mysqli_query($con,"UPDATE namedev SET name='$name',address ='$address'  WHERE id = '$id'");
header("Location: dev.php");	
 }
}
 
 
 if (isset($_POST['delname'])) {
$box_array = $_REQUEST['boxname'];
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
if($errors==NULL){
 foreach($box_array as $key => $value) { 
 mysqli_query($con,"DELETE FROM namedev WHERE id='$value'"); 
 } 
header("Location: dev.php");	
 } }
 
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

<script type="text/javascript">
var count = 0;
$(function() {  count = $('input[type=checkbox]:checked').length; displayCount();
 $('input[type=checkbox]').bind('click' , function(e, a) {if (this.checked) { count += a ? -1 : 1;} else { count += a ? 1 : -1;} displayCount();    });});
function displayCount() {
	if(count>0){document.getElementById('del').disabled = false;}	
	if(count==0){document.getElementById('del').disabled = true;}
	}
</script>

			
							
<div class="s2-map map" id="map">
<div class="right-area -js-right-area Mscroll" style="display: block;  padding: 0px;  outline: none;" tabindex="0">
                
            <div class="jspContainer" >
			
			<div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">


<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;">  Имена устройств  </h2>
	<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
	
    <div class=" form-horizontal col-md-3"> 
 <div class="section">
			<br>
			<input  type="hidden"  name="id2" id="id2" class="form-control"  placeholder="">
			
			

		 
			<p>Наименование </p>
            <input id="name2" name="name2" type="text" class="form-control" maxlength="27" placeholder="Наименование">
		

	
<p>MAC адрес устройства</p>
<?php	 
$resp=""; 
$rtype = mysqli_query($con,"SELECT * FROM developments GROUP BY address "); 
while($rowr = mysqli_fetch_assoc($rtype)) {
$resadr="'".$rowr['address'];
$resp=$resadr."',".$resp;
} 
if($G_id_user!=1){$resp=NULL;}
?>	

<script>
$(document).ready(function (){	$('#address2').autocomplete({
source: [<?php	echo $resp; ?>],
minLength: 0,delay: 0});$('#address2').bind('focus', function() {if ($(this).val() == '') $(this).autocomplete('search', '');	});});
</script>
<input name="address2" class="form-control" id="address2" type="text">

				   
			<br>
				<br>
			
<button type="submit" class="btn btn-sm btn-small btn-primary" name="addname"  value="" ><i class="icon-plus"></i> Добавить</button>
<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="editname" id="editname" value="" ><i class="icon-edit"></i> Изменить</button>
<button type="button" disabled="disabled" onclick="clin2()"  class="btn btn-sm btn-small btn-white" name="clinss2" id="clinss2" value="" >Очистить</button>
		   
        </div>
	</div>
	
	
    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
       <button id="del" disabled="disabled" onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-sm btn-small btn-danger"  name="delname" title="Удалить записи"><i class=" icon-trash"></i> Удалить выделенные записи</button> 	
 	<div class="col-xs-12"><div id="example2_filter" class="dataTables_filter"><label>Поиск: <input type="text" name="search" class="form-control input-sm" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" ></label></div></div>
	
	<button type="submit" class="btn btn-danger btn-sm btn-small"  name="find" style="background-color: #3F9635;  border-color: #548347;   position: absolute;  margin: -35px 0px 0px 182px;"><i class="icon-search-4"></i> Поиск</button> 
	     
		        <section id="settings-notifications">
			   <table id="example" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
												<th style="width: 30px;">  </th>
												<th data-class="expand">MAC адрес устройства</th>
                                                <th data-hide="tablet">Наименование</th>
											<?php if($G_id_user==1){ ?> <th data-hide="tablet">Пользователь</th><?php } ?>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
									//	if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM namedev  ORDER BY id DESC");} 
									//				else {$IDDN = mysqli_query($con,"SELECT * FROM namedev  WHERE id_user = '$G_id_user' OR id_user = '0' ORDER BY id DESC");}
									//	if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
									$_PAGING = new Paging($con);
									$search = $_POST['search'];
									if($G_id_user==1){$r = $_PAGING->get_page( "SELECT * FROM namedev WHERE (name LIKE '%$search%' OR address LIKE '%$search%') ORDER BY id DESC" ); }
									else {$r = $_PAGING->get_page( "SELECT * FROM namedev  WHERE (name LIKE '%$search%' OR address LIKE '%$search%') AND (id_user = '$G_id_user' OR id_user = '0') ORDER BY id DESC" );}
									while($mIDDN = $r->fetch_assoc())
									{
									$M_id_user = $mIDDN['id_user'];
										?>
			
<tr>

<td>
<?php	if(($mIDDN['id_user']==$G_id_user OR $G_id_user==1) AND $mIDDN['id_user']!=0){ ?>
<input id="Gchbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='boxname[]' value=<?php	echo $mIDDN['id']; ?>>
<?php	} else {echo "<i class='icon-lock-4 lock-tab'></i>";} ?>
</td>		

<td onclick="getText2<?php echo $mIDDN['id'];?>()" style="cursor: pointer;"><?php	echo $mIDDN['address']; ?></td>									
<td onclick="getText2<?php echo $mIDDN['id'];?>()" style="cursor: pointer;"><?php	echo $mIDDN['name']; ?></td>

<?php if($G_id_user==1){ ?> 
<td>
<?php	$rtype = mysqli_query($con,"SELECT * FROM users WHERE id_user='$M_id_user' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['login_user'];} ?>
</td>
<?php } ?>											
											  
											  			  
<script type="text/javascript">
function getText2<?php echo $mIDDN['id'];?>(el){

	document.getElementById('id2').value = '<?php	echo $mIDDN['id']; ?>';
	document.getElementById('name2').value = '<?php	echo $mIDDN['name']; ?>';
	document.getElementById('address2').value = '<?php	echo $mIDDN['address']; ?>';

<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
document.getElementById('editname').disabled = false;
document.getElementById('clinss2').disabled = false;
<?php	} else { ?>
	document.getElementById('editname').disabled = true;
	document.getElementById('clinss2').disabled = true;

<?php	}  ?>

}
</script>
		<script type="text/javascript">
function clin2(){
	document.getElementById('id2').value = '';
	document.getElementById('name2').value = '';
	document.getElementById('address2').value = '';
	document.getElementById('editname').disabled = true;
	document.getElementById('clinss2').disabled = true;
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