<?php	
 include 's-head.php';
 include 'adatum.class.php';
 
 $errors=NULL;if($G_id_user==2){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Изменения данных в демо режиме запрещенны !";}

if (isset($_POST['deluser'])) {
	$box_array = $_REQUEST['box']; 
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
	foreach($box_array as $key => $value) { 
	mysqli_query($con,"DELETE FROM users WHERE id_user='$value'"); 
	}  
	header("Location: setting.php");
}
	
	
 if (isset($_POST['setting'])) {
$user_imgfon = $_POST['imgfon'];
$user_timezone = $_POST['timezone'];

mysqli_query($con,"UPDATE users SET timezone  ='$user_timezone',img ='$user_imgfon' WHERE id_user = '$G_id_user'");
header("Location: setting.php");	
 }
 
 
 
 if (isset($_POST['edituser'])) {



 $unixtime=time();
 
 $id_user = $_POST['id_user'];
 $passwd = $_POST['passwd'];
 $passwd2 = $_POST['passwd2'];
 $login = $_POST['login'];
 $mail_user = $_POST['mail'];
 


$login = trim($login);


if(isset($_POST['cbx'])){

if ($passwd != $passwd2 OR $passwd==NULL ) {	$errors ="Введенные пароли не совпадают";} else {
$passwd = md5(trim($passwd).'7seR#21rrTE6'); //~ хеш пароля с солью
//mysqli_query($con,"UPDATE users SET passwd_user='$passwd',login_user ='$login',mail_user ='$mail_user',rule1 ='$rule1' ,rule2 ='$rule2' ,rule3 ='$rule3' ,rule4 ='$rule4',rule5 ='$rule5'  WHERE id_user = '$id_user'");
header("Location: setting.php");	
}
} else {
//mysqli_query($con,"UPDATE users SET login_user ='$login',mail_user ='$mail_user',rule1 ='$rule1' ,rule2 ='$rule2' ,rule3 ='$rule3' ,rule4 ='$rule4' ,rule5 ='$rule5' WHERE id_user = '$id_user'");
header("Location: setting.php");	
}

}



if (isset($_POST['adduser'])) {
 $unixtime=time();
 $id_user = $_POST['id_user'];
 $passwd = $_POST['passwd'];
 $passwd2 = $_POST['passwd2'];
 $login = $_POST['login'];
 $mail_user = $_POST['mail'];
 if(isset($_POST['checkbox1'])){ $rule1 = $_POST['checkbox1'];} else {$rule1 = 0;}
  if(isset($_POST['checkbox2'])){ $rule2 = $_POST['checkbox2'];}else {$rule2 = 0;}
   if(isset($_POST['checkbox3'])){ $rule3 = $_POST['checkbox3'];}else {$rule3 = 0;}
    if(isset($_POST['checkbox4'])){ $rule4 = $_POST['checkbox4'];}else {$rule4 = 0;}
	 if(isset($_POST['checkbox5'])){ $rule5 = $_POST['checkbox5'];}else {$rule5 = 0;}
	 
//mysqli_query($con,"INSERT INTO `logs` (`cont`, `stat`,`unixtime`) VALUES ('Созданна новая учётная запись.  (".$login.")', '1','".$unixtime."')");
header("Location: setting.php");	

} ;
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
<div class="right-area -js-right-area Mscroll scroll-pane" style="display: block; padding: 0px;  outline: none;" tabindex="0">
                
           
			
			<div class="right-area-content -js-right-area-content">

<div class="profile row">
   
    <div class="col-md-2">    </div>
    <div class="mainInfo form-horizontal col-md-6" autocomplete="off">
	
	
		
        <h2 style="text-align:center; padding-bottom: 30px;">Настройки профиля</h2>
		
       	<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	
		
        <div class="section">
		<script charset="utf-8" src="./feditor/kindeditor.js"></script>
		<script charset="utf-8" src="./feditor/ru_Ru.js"></script>
		
	
<script>
KindEditor.ready(function(K) {
var editor = K.editor({		allowFileManager : true	});
K('#image3').click(function() {	editor.loadPlugin('image', function() {
editor.plugin.imageDialog({showRemote : false,imageUrl : K('#imgfon').val(),
clickFn : function(url, title, width, height, border, align) {K('#imgfon').val(url);editor.hideDialog();}
});});});});
</script>


<div class="row">
		<label class="col-sm-3 control-label" style="    margin-top: -8px;">План помещения</label>	
		<div class="col-sm-9">
<div class="input-group">
      <input type="text" id="imgfon" name="imgfon" class="form-control" value="<?php	echo $fonimg; ?>	" /> 
      <span class="input-group-btn">
      <button type="button" id="image3" class="btn btn-success" ><i class="icon-download-5"></i></button>
      </span>
    </div>
	  </div>
	  </div>	
			
			
			
			
			
			<br>
			
			
            <div class="form-group">
                <label class="col-sm-3 control-label" style="    margin-top: -8px;">Часовой пояс		</label>
                <div class="col-sm-9">
                   <select name="timezone" id="timezone" style="width:100%" class="form-control">
		<option <?php if($timezone==-43200){echo "selected";}?> title="[UTC - 12] 	 Меридиан смены дат (запад)" value="-43200">[UTC - 12] Меридиан смены дат (запад)</option>
		<option <?php if($timezone==-39600){echo "selected";}?> title="[UTC - 11]    о. Мидуэй, Самоа" value="-39600">[UTC - 11] о. Мидуэй, Самоа</option>
		<option <?php if($timezone==-36000){echo "selected";}?> title="[UTC - 10]    Гавайи" value="-36000">[UTC - 10] Гавайи</option>
		<option <?php if($timezone==-34200){echo "selected";}?> title="[UTC - 9:30]  Маркизские острова" value="-34200">[UTC - 9:30] Маркизские острова</option>
		<option <?php if($timezone==-23400){echo "selected";}?> title="[UTC - 9]     Аляска" value="-23400">[UTC - 9] Аляска</option>
		<option <?php if($timezone==-28800){echo "selected";}?> title="[UTC - 8]     Тихоокеанское время (США и Канада) и Тихуана" value="-28800">[UTC - 8] Тихоокеанское время (США и Канада) и Тихуана</option>
		<option <?php if($timezone==-25200){echo "selected";}?> title="[UTC - 7]     Аризона" value="-25200">[UTC - 7] Аризона</option>
		<option <?php if($timezone==-21600){echo "selected";}?> title="[UTC - 6] 	 Мехико, Центральная Америка, Центральное время (США и Канада)" value="-21600">[UTC - 6] Мехико, Центральная Америка, Центральное время (США и Канада)</option>
		<option <?php if($timezone==-18000){echo "selected";}?> title="[UTC - 5]  	 Индиана (восток), Восточное время (США и Канада)" value="-18000">[UTC - 5] Индиана (восток), Восточное время (США и Канада)</option>
		<option <?php if($timezone==-16200){echo "selected";}?> title="[UTC - 4:30]  Венесуэла" value="-16200">[UTC - 4:30] Венесуэла</option>
		<option <?php if($timezone==-14400){echo "selected";}?> title="[UTC - 4] 	 Каракас, Сантьяго, Атлантическое время (Канада)" value="-14400">[UTC - 4] Каракас, Сантьяго, Атлантическое время (Канада)</option>
		<option <?php if($timezone==-12600){echo "selected";}?> title="[UTC - 3:30]  Ньюфаундленд" value="-12600">[UTC - 3:30] Ньюфаундленд</option>
		<option <?php if($timezone==-10800){echo "selected";}?> title="[UTC - 3] 	 Бразилия, Гренландия" value="-10800">[UTC - 3] Бразилия, Гренландия</option>
		<option <?php if($timezone==-7200){echo "selected";}?> title="[UTC - 2] 	 Среднеатлантическое время" value="-7200">[UTC - 2] Среднеатлантическое время</option>
		<option <?php if($timezone==-3600){echo "selected";}?> title="[UTC - 1]	 Азорские острова, острова Зеленого мыса" value="-3600">[UTC - 1] Азорские острова, острова Зеленого мыса</option>
		<option <?php if($timezone==0){echo "selected";}?> title="[UTC] 		 Время по Гринвичу: Дублин, Лондон, Лиссабон, Эдинбург" value="0">[UTC] Время по Гринвичу: Дублин, Лондон, Лиссабон, Эдинбург</option>
		<option <?php if($timezone==3600){echo "selected";}?> title="[UTC + 1] 	 Берлин, Мадрид, Париж, Рим, Западная Центральная Африка" value="3600">[UTC + 1] Берлин, Мадрид, Париж, Рим, Западная Центральная Африка</option>
		<option <?php if($timezone==7200){echo "selected";}?>  title="[UTC + 2] 	 Афины, Вильнюс, Киев, Минск, Рига, Таллин, Центральная Африка" value="7200">[UTC + 2] Афины, Вильнюс, Киев, Минск, Рига, Таллин, Центральная Африка</option>
		<option <?php if($timezone==10800){echo "selected";}?> title="[UTC + 3] 	 Волгоград, Москва, Санкт-Петербург" value="10800">[UTC + 3] Волгоград, Москва, Санкт-Петербург</option>
		<option <?php if($timezone==12600){echo "selected";}?> title="[UTC + 3:30]  Тегеран" value="12600">[UTC + 3:30] Тегеран</option>
		<option <?php if($timezone==14400){echo "selected";}?> title="[UTC + 4] 	 Баку, Ереван, Самара, Тбилиси" value="14400">[UTC + 4] Баку, Ереван, Самара, Тбилиси</option>
		<option <?php if($timezone==16200){echo "selected";}?> itle="[UTC + 4:30]  Кабул" value="16200">[UTC + 4:30] Кабул</option>
		<option <?php if($timezone==18000){echo "selected";}?> title="[UTC + 5]	 Екатеринбург, Исламабад, Карачи, Оренбург, Ташкент" value="18000">[UTC + 5] Екатеринбург, Исламабад, Карачи, Оренбург, Ташкент</option>
		<option <?php if($timezone==19800){echo "selected";}?> title="[UTC + 5:30]  Бомбей, Калькутта, Мадрас, Нью-Дели" value="19800">[UTC + 5:30] Бомбей, Калькутта, Мадрас, Нью-Дели</option>
		<option <?php if($timezone==20700){echo "selected";}?> title="[UTC + 5:45]  Катманду" value="20700">[UTC + 5:45] Катманду</option>
		<option <?php if($timezone==21600){echo "selected";}?> title="[UTC + 6] 	 Алматы, Астана, Новосибирск, Омск" value="21600">[UTC + 6] Алматы, Астана, Новосибирск, Омск</option>
		<option <?php if($timezone==23400){echo "selected";}?> title="[UTC + 6:30]  Рангун" value="23400">[UTC + 6:30] Рангун</option>
		<option <?php if($timezone==25200){echo "selected";}?> title="[UTC + 7] 	 Бангкок, Красноярск" value="25200">[UTC + 7] Бангкок, Красноярск</option>
		<option <?php if($timezone==28800){echo "selected";}?> title="[UTC + 8] 	 Гонконг, Иркутск, Пекин, Сингапур" value="28800" >[UTC + 8] Гонконг, Иркутск, Пекин, Сингапур</option>
		<option <?php if($timezone==31500){echo "selected";}?> title="[UTC + 8:45]  Юго-восточная Западная Австралия" value="31500">[UTC + 8:45] Юго-восточная Западная Австралия</option>
		<option <?php if($timezone==32400){echo "selected";}?> title="[UTC + 9] 	 Токио, Сеул, Чита, Якутск" value="32400">[UTC + 9] Токио, Сеул, Чита, Якутск</option>
		<option <?php if($timezone==34200){echo "selected";}?> title="[UTC + 9:30]  Дарвин" value="34200">[UTC + 9:30] Дарвин</option>
		<option <?php if($timezone==36000){echo "selected";}?> title="[UTC + 10]	 Владивосток, Канберра, Мельбурн, Сидней" value="36000">[UTC + 10] Владивосток, Канберра, Мельбурн, Сидней</option>
		<option <?php if($timezone==37800){echo "selected";}?> title="[UTC + 10:30] Лорд-Хау" value="37800">[UTC + 10:30] Лорд-Хау</option>
		<option <?php if($timezone==39600){echo "selected";}?> title="[UTC + 11] 	 Магадан, Сахалин, Соломоновы о-ва" value="39600">[UTC + 11] Магадан, Сахалин, Соломоновы о-ва</option>
		<option <?php if($timezone==41400){echo "selected";}?> title="[UTC + 11:30] Остров Норфолк" value="41400">[UTC + 11:30] Остров Норфолк</option>
		<option <?php if($timezone==43200){echo "selected";}?> title="[UTC + 12]	 Камчатка, Новая Зеландия, Фиджи" value="43200">[UTC + 12] Камчатка, Новая Зеландия, Фиджи</option>
		<option <?php if($timezone==45900){echo "selected";}?> title="[UTC + 12:45] Острова Чатем" value="45900">[UTC + 12:45] Острова Чатем</option>
		<option <?php if($timezone==46800){echo "selected";}?> title="[UTC + 13] 	 Острова Феникс, Тонга" value="46800">[UTC + 13] Острова Феникс, Тонга</option>
		<option <?php if($timezone==50400){echo "selected";}?> title="[UTC + 14]	 Остров Лайн" value="50400">[UTC + 14] Остров Лайн</option>
	</select>               
           
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-12">
              
                <button type="submit" class="btn btn-primary" name="setting"><i class="icon-floppy"></i> Сохранить</button>
			
				
            </div>
        </div>
	
    </div>
    <div class="contactsContainer col-md-4">
       
    </div>
	
</div>



 	<hr>
	
	 
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;"> Пользователи и права доступа </h2>
	
	
	
    <div class=" form-horizontal col-md-3"> 
 <div class="section">
           
		   
		   
		<div>		



			<input  type="hidden"  name="id_user" id="id_user" class="form-control"  placeholder="">
			<input  type="hidden"  name="rowtypen" id="rowtypen" class="form-control"  placeholder="">
			
			
				<p>Логин </p>
				<input id="login" name="login" type="text" class="form-control" value="<?php echo @$_POST['login'] ?>" placeholder="Логин">
	

				<p>Почта </p>
				<input id="mail" name="mail" type="text" class="form-control" value="<?php echo @$_POST['mail'] ?>" placeholder="Почта">

				
<div id="checkedit" style="display:none">
<br>
<div style="padding-left: 20px;">
				<div  class="checkbox check-default" >
                      <input onclick="showHide('passdiv');" id="cbx" name="cbx" type="checkbox" value="1">
                      <label for="cbx">Сменить пароль</label>
   
                  </div>
 </div> </div>
			


		<div id="passdiv" style="display:block">

				<p>Пароль </p>
				<input id="passwd" name="passwd" type="password" class="form-control" >
				
				<p>Повторите Пароль </p>
				<input id="passwd2" name="passwd2" type="password" class="form-control">

		</div>
				
				
 
  
<script type="text/javascript">
function showHide (id)
{
var style = document.getElementById(id).style
if (style.display == "none")
style.display = "block";
else
style.display = "none";
} 
</script>
   
   
  
				<br>
		
<button type="submit" class="btn btn-sm btn-small btn-primary" name="adduser"><i class="icon-plus"></i> Добавить</button>
<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="edituser" id="edituser"  value="" ><i class="icon-edit"></i> Изменить</button>
<button type="button" disabled="disabled" onclick="clin()"  class="btn btn-sm btn-small btn-white" name="clinss" id="clinss" value="" >Очистить</button>

		   
		   
							 </div>	 

		   		   
		   
   
		   
		   
		   
		   
		   
        </div>
	</div>
	
	


	
    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
       <button id="del" disabled="disabled" onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-sm btn-small btn-danger"  name="deluser" title="Удалить записи"><i class=" icon-trash"></i> Удалить выделенные записи</button>  
      
		        <section id="settings-notifications">
			   <table id="example2" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
												<th style="width: 30px;">  </th>
												<th data-class="expand">Пользователь</th>
												<th data-hide="phone,tablet">Данные</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?
if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM users ORDER BY id_user DESC");}
			else {$IDDN = mysqli_query($con,"SELECT * FROM users WHERE id_user = '$G_id_user' ORDER BY id_user DESC");}

if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
?>
			
<tr>

<td>
<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
<input onchange="document.getElementById('del').disabled = false;" id="chbox<?php	echo $mIDDN['id_user']; ?>" type="checkbox"  name='box[]' value=<?php	echo $mIDDN['id_user']; ?>>
<?php	} else {echo "<i class='icon-lock-4 lock-tab'></i>";} ?>
</td>		
<td onclick="getText<?php echo $mIDDN['id_user'];?>()" style="cursor: pointer;"><?php	echo $mIDDN['login_user']; ?></td>									
												
											 <td onclick="getText<?php echo $mIDDN['id_user'];?>()" style="cursor: pointer;">
											 <?php	echo "E-mail: ".$mIDDN['mail_user']."<br>"; ?>
											  <?php	echo "Часовой пояс: UTC +".($mIDDN['timezone']/3600)."<br>"; ?>
											   <?php	echo "Изображение: ".$mIDDN['img']."<br>"; ?>
											 </td>
											  
											  			  
<script type="text/javascript">
function getText<?php echo $mIDDN['id_user'];?>(el){


document.getElementById('checkedit').style.display = 'block';
document.getElementById('passdiv').style.display = 'none';




	<?php	if($mIDDN['id_user']==$G_id_user OR $G_id_user==1){ ?>
document.getElementById('edituser').disabled = false;
document.getElementById('clinss').disabled = false;
	<?php	} else {?>
	document.myForm.edit.disabled = true;
	document.myForm.clinss.disabled = true;
	<?php	}?>

	document.getElementById('id_user').value = '<?php	echo $mIDDN['id_user']; ?>';
	document.getElementById('login').value = '<?php	echo $mIDDN['login_user']; ?>';
	document.getElementById('mail').value = '<?php	echo $mIDDN['mail_user']; ?>';
	
		
	

}

function clin(){
	document.myForm.edit.disabled = true;
	document.myForm.clinss.disabled = true;

	document.getElementById('id_user').value = '';
	document.getElementById('login').value = '';
	document.getElementById('mail').value = '';
	


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