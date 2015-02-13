<?php	
 include 's-head.php';
 include 'adatum.class.php';
 
 
 
 
 
 
 
if (isset($_POST['addtype'])) {

$name = $_POST['nametype'];
$type = $_POST['typetype'];
$ico = $_POST['ico'];
$mode = $_POST['modetype'];
$symbol = $_POST['symbol'];
$namevalue1 = $_POST['namevalue1'];
$namevalue2 = $_POST['namevalue2'];
$namevalue3 = $_POST['namevalue3'];
$namevalue4 = $_POST['namevalue4'];
$regim = $_POST['regim'];
$tchart = $_POST['tchart'];
$colorss = $_POST['icocolor'];

 if($type == '1') {  $namevalue2='';  $namevalue3=''; };
 if($type == '2') {  $namevalue3=''; $namevalue4=''; };
 if($type == '3') {  $namevalue4=''; };
 if($type == '4') {  $namevalue1=''; $namevalue2='';  $namevalue3=''; $namevalue4=''; };

mysqli_query($con,"INSERT INTO type (name,type,ico,mode,symbol,namevalue1,namevalue2,namevalue3,namevalue4,regim,tchart,color) VALUES ('$name','$type','$ico','$mode','$symbol','$namevalue1','$namevalue2','$namevalue3','$namevalue4','$regim','$tchart','$colorss')");
header("Location: setting.php");
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
$namevalue4 = $_POST['namevalue4'];
$regim = $_POST['regim'];
$tchart = $_POST['tchart'];
$colorss = $_POST['icocolor'];
 if($type == '1') {  $namevalue2='';  $namevalue3=''; };
 if($type == '2') {  $namevalue3=''; $namevalue4=''; };
 if($type == '3') {  $namevalue4=''; };
 if($type == '4') {  $namevalue1=''; $namevalue2='';  $namevalue3=''; $namevalue4=''; };

mysqli_query($con,"UPDATE type SET name='$name',type='$type',ico='$ico',mode='$mode',symbol='$symbol',namevalue1='$namevalue1',namevalue2='$namevalue2',namevalue3='$namevalue3',namevalue4='$namevalue4',regim='$regim',tchart='$tchart',color='$colorss'  WHERE id = '$id'");
header("Location: setting.php");
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 if (isset($_POST['addname'])) {
$name = $_POST['name2'];
$address = $_POST['address2'];
mysqli_query($con,"INSERT INTO namedev (name, address) VALUES ('$name', '$address')");
header("Location: setting.php");	

}



if (isset($_POST['editname'])) {
$id = $_POST['id2'];
$name = $_POST['name2'];
$address = $_POST['address2'];
mysqli_query($con,"UPDATE namedev SET name='$name',address ='$address'  WHERE id = '$id'");
header("Location: setting.php");	

}
 
 
 if (isset($_POST['delname'])) {
$box_array = $_REQUEST['boxname'];
 foreach($box_array as $key => $value) {  mysqli_query($con,"DELETE FROM namedev WHERE id='$value'");   } 
header("Location: setting.php");	
 }
 
 
if (isset($_POST['deluser'])) {
	$box_array = $_REQUEST['box']; 
	foreach($box_array as $key => $value) {  mysqli_query($con,"DELETE FROM users WHERE id_user='$value'"); }  
	
header("Location: setting.php");
	
	}
	
	
	if (isset($_POST['deltype'])) {
$box_array = $_REQUEST['boxtype'];
 foreach($box_array as $key => $value) {  mysqli_query($con,"DELETE FROM type WHERE id='$value'");   } 
header("Location: setting.php");
 }
 
 
 
 
 
 
 
 if (isset($_POST['edituser'])) {

$error=0;

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
 


$login = trim($login);

mysqli_query($con,"INSERT INTO `logs` (`cont`, `stat`,`unixtime`) VALUES ('Изменение данных учётной записи.  (".$login.")', '1','".$unixtime."')");

if(isset($_POST['cbx'])){

if ($passwd != $passwd2 OR $passwd==NULL ) {	$error ="Введенные пароли не совпадают";} else {
$passwd = md5(trim($passwd).'7seR#21rrTE6'); //~ хеш пароля с солью
mysqli_query($con,"UPDATE users SET passwd_user='$passwd',login_user ='$login',mail_user ='$mail_user',rule1 ='$rule1' ,rule2 ='$rule2' ,rule3 ='$rule3' ,rule4 ='$rule4',rule5 ='$rule5'  WHERE id_user = '$id_user'");
header("Location: setting.php");	
}
} else {
mysqli_query($con,"UPDATE users SET login_user ='$login',mail_user ='$mail_user',rule1 ='$rule1' ,rule2 ='$rule2' ,rule3 ='$rule3' ,rule4 ='$rule4' ,rule5 ='$rule5' WHERE id_user = '$id_user'");
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
	 
mysqli_query($con,"INSERT INTO `logs` (`cont`, `stat`,`unixtime`) VALUES ('Созданна новая учётная запись.  (".$login.")', '1','".$unixtime."')");
header("Location: setting.php");	

} ;
 ?>
 
<!DOCTYPE html>
<html>
	<head>
		<?php	 include 'head.php'; ?>
	</head>
	
	<body class="white">

	   <div  class="s2-content" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

							
							
<div class="s2-map map" id="map">
<div class="right-area -js-right-area Mscroll" style="display: block; overflow: hidden; padding: 0px;  outline: none;" tabindex="0">
                
            <div class="jspContainer" >
			
			<div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">

<div class="profile row">
   
    <div class="col-md-2">    </div>
    <div class="mainInfo form-horizontal col-md-6" autocomplete="off">
	
		<?php	if(isset($error)&&$error!=0){echo $error;} ?>	
	
		
        <h2 style="text-align:center; padding-bottom: 30px;">Настройки профиля</h2>
       
        <div class="section">
            <div class="form-group">
                <label class="col-sm-3 control-label">Язык</label>
                <div class="col-sm-8">
                    <select name="User[lang]" class="form-control">
                        <option value="ru" selected="selected">Русский</option>
                        <option value="en">English</option>
                       
                    </select>
                    <div class="error" id="error_lang"></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Часовой пояс</label>
                <div class="col-sm-8">
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
                    <div class="error" id="error_gmt"></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-12">
              
                <input type="submit" class="btn btn-primary" name="setting" value="Сохранить">
			
				
            </div>
        </div>
	
    </div>
    <div class="contactsContainer col-md-4">
       
    </div>
	
</div>



 
	
	 
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;"> Пользователи и права доступа </h2>
	
	
	<form name="myForm" method="post" >
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
				
				
				
				
				
			<br>	
				<div class="title">Права доступа:</div>
			
				
				
				 <div style="padding-left: 20px;">
                    <div class="checkbox check-default">
                      <input id="checkbox1" name="checkbox1" type="checkbox" value="1">
                      <label for="checkbox1">Изменение настроек</label>
   
                  </div>

                    <div class="checkbox check-default">
                      <input id="checkbox2" name="checkbox2" type="checkbox" value="1">
                      <label for="checkbox2">Создание правил</label>
                    </div>

                    <div class="checkbox check-default">
                      <input id="checkbox3" name="checkbox3" type="checkbox" value="1">
                      <label for="checkbox3">Редактирование справочников</label>
                    </div>

                    <div class="checkbox check-default">
                      <input id="checkbox4" name="checkbox4" type="checkbox" value="1">
                      <label for="checkbox4">Редактирование пользователей</label>

					  </div>
					  
					    <div class="checkbox check-default">
                      <input id="checkbox5" name="checkbox5" type="checkbox" value="1">
                      <label for="checkbox5">Настройка панели управления</label>

					  </div>

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
						
							 </div>	  <button onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-danger btn-sm btn-small"  name="deluser" style="margin-top: 5px;" title="Удалить записи">Удалить записи</button> 
		   
		   

		   		   
		   
   
		   
		   
		   
		   
		   
        </div>
	</div>
	
	
	<hr>

	
    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
        
      
		        <section id="settings-notifications">
			   <table id="example2" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
        <th style="width: 30px;">  </th>
												<th data-class="expand">Пользователь</th>
                                                <th data-hide="phone">E-mail</th>
                                                <th data-hide="phone,tablet">Изменение настроек</th>
												 <th data-hide="phone,tablet">Создание правил</th>
												  <th data-hide="phone,tablet">Редактирование справочников</th>
												   <th data-hide="phone,tablet">Редактирование пользователей</th>
												      <th data-hide="phone,tablet">Настройка панели управления</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$IDDN = mysqli_query($con,"SELECT * FROM users ORDER BY id_user DESC");
										if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
										?>
			
											<tr onclick="getText<?php echo $mIDDN['id_user'];?>()">
<td><input id="chbox<?php	echo $mIDDN['id_user']; ?>" type="checkbox"  name='box[]' value=<?php	echo $mIDDN['id_user']; ?>></td>		
												<td ><?php	echo $mIDDN['login_user']; ?></td>									
												<td><?php	echo $mIDDN['mail_user']; ?></td>
											  <td><?php	if($mIDDN['rule1']==1){ ?><span class="label label-warning">V</span><?php	} ?></td>
											  <td><?php	if($mIDDN['rule2']==1){ ?><span class="label label-success">V</span><?php	} ?></td>
											  <td><?php	if($mIDDN['rule3']==1){ ?><span class="label label-primary">V</span><?php	} ?></td>
											  <td><?php	if($mIDDN['rule4']==1){ ?><span class="label label-info">V</span><?php	} ?></td>
                                              <td><?php	if($mIDDN['rule5']==1){ ?><span class="label label-default">V</span><?php	} ?></td>
											  
											  			  
<script type="text/javascript">
function getText<?php echo $mIDDN['id_user'];?>(el){


document.getElementById('checkedit').style.display = 'block';
document.getElementById('passdiv').style.display = 'none';

document.getElementById('edituser').disabled = false;
document.getElementById('clinss').disabled = false;


	document.getElementById('id_user').value = '<?php	echo $mIDDN['id_user']; ?>';
	document.getElementById('login').value = '<?php	echo $mIDDN['login_user']; ?>';
	document.getElementById('mail').value = '<?php	echo $mIDDN['mail_user']; ?>';
	
		
	
	if(<?php	echo $mIDDN['rule1']; ?>==1){	document.getElementById("checkbox1").checked = true;} else  document.getElementById("checkbox1").checked = false;
	if(<?php	echo $mIDDN['rule2']; ?>==1){	document.getElementById("checkbox2").checked = true; } else  document.getElementById("checkbox2").checked = false;
	if(<?php	echo $mIDDN['rule3']; ?>==1){	document.getElementById("checkbox3").checked = true; } else  document.getElementById("checkbox3").checked = false;
	if(<?php	echo $mIDDN['rule4']; ?>==1){	document.getElementById("checkbox4").checked = true; } else  document.getElementById("checkbox4").checked = false;
	if(<?php	echo $mIDDN['rule5']; ?>==1){	document.getElementById("checkbox5").checked = true; } else  document.getElementById("checkbox5").checked = false;

}

function clin(){
	document.myForm.edit.disabled = true;
	document.myForm.clinss.disabled = true;

	document.getElementById('id_user').value = '';
	document.getElementById('login').value = '';
	document.getElementById('mail').value = '';
	
	document.getElementById("checkbox1").checked = false; 
	document.getElementById("checkbox2").checked = false; 
	document.getElementById("checkbox3").checked = false; 
	document.getElementById("checkbox4").checked = false; 
	document.getElementById("checkbox5").checked = false; 

}
	</script>
											  
                                            </tr>
											
										<?php  }}	?>													
		  </tbody>
			</table>									
        </section>
	
    </div>
  
	
</div>












<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;">  Имена устройств  </h2>
	
	
	
    <div class=" form-horizontal col-md-3"> 
 <div class="section">
           
		   
		   
			<div id="email-list">		


			<br>
			<input  type="hidden"  name="id2" id="id2" class="form-control"  placeholder="">
			
			

		 
			<p>Наименование </p>
            <input id="name2" name="name2" type="text" class="form-control" maxlength="27" placeholder="Наименование">
		

	
<p>Номер устройства</p>



    <input type="text" id="address2" class="form-control" name="address2" maxlength="8" value="" />

				   
			<br>
				<br>
			
					    <button type="submit" class="btn btn-sm btn-small btn-primary" name="addname"  value="" ><i class="icon-plus"></i> Добавить</button>
						<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="editname" id="editname" value="" ><i class="icon-edit"></i> Изменить</button>
						<button type="button" disabled="disabled" onclick="clin2()"  class="btn btn-sm btn-small btn-white" name="clinss2" id="clinss2" value="" >Очистить</button>
						
						 <button onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-sm btn-small btn-danger"  name="delname" style="margin-top: 5px;" title="Удалить записи">Удалить записи</button>
						

							 </div>			
		   
		  
		   
   
		   
		   
		   
		   
		   
        </div>
	</div>
	
	
    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
        	
      
		        <section id="settings-notifications">
			   <table id="example" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                           <th style="width: 30px;">  </th>
												<th data-class="expand">Номер устройства</th>
                                                <th data-hide="phone">Наименование</th>
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$IDDN = mysqli_query($con,"SELECT * FROM namedev ORDER BY id DESC");
										if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
										?>
			
											<tr onclick="getText2<?php echo $mIDDN['id'];?>()">
<td><input id="chbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='boxname[]' value=<?php	echo $mIDDN['id']; ?>></td>		
												<td ><?php	echo $mIDDN['address']; ?></td>									
												<td><?php	echo $mIDDN['name']; ?></td>
											
											  
											  			  
<script type="text/javascript">
function getText2<?php echo $mIDDN['id'];?>(el){

	document.getElementById('id2').value = '<?php	echo $mIDDN['id']; ?>';
	document.getElementById('name2').value = '<?php	echo $mIDDN['name']; ?>';
	document.getElementById('address2').value = '<?php	echo $mIDDN['address']; ?>';

	
	document.getElementById('editname').disabled = false;
document.getElementById('clinss2').disabled = false;

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
											
										<?php  }}	?>													
		  </tbody>
			</table>									
        </section>
	
    </div>
  
	
</div>



<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;">  Типы датчиков   </h2>
	
	
	
    <div class=" form-horizontal col-md-3"> 
 <div class="section">
           
		   
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
document.getElementById('i_parm4').style.display="none";
document.getElementById('i_chart').style.display="none";
	
	}
	
 if(val_i_page==1)
 {
  document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
  document.getElementById('i_simvol').style.display="block";
document.getElementById('i_parm2').style.display="none";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_parm4').style.display="none";
document.getElementById('i_chart').style.display="block";
	
	}
	
	 if(val_i_page==2)
 {
  document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
  document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="block";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_parm4').style.display="none";
document.getElementById('i_chart').style.display="none";
	}		
		 if(val_i_page==3)
 {
  document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="block";
  document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="block";
document.getElementById('i_parm3').style.display="block";
document.getElementById('i_parm4').style.display="none";
document.getElementById('i_chart').style.display="none";
	}	
if(val_i_page==4)
 {
  document.getElementById('i_all').style.display="block";
document.getElementById('i_parm1').style.display="none";
  document.getElementById('i_simvol').style.display="none";
document.getElementById('i_parm2').style.display="none";
document.getElementById('i_parm3').style.display="none";
document.getElementById('i_parm4').style.display="none";
document.getElementById('i_chart').style.display="none";
	}
		}
	</script>		   
				
		<div id="email-list">		


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
                        <label for="mradio0">Линейный</label>
						
                        <input id="mradio1" type="radio" name="tchart" value="1">
                        <label for="mradio1">Бары</label><br>
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
						
						<input id="radio2" type="radio" name="regim" value="2">
                        <label for="radio2">Основной модуль</label>
                      </div>
					  </div> 



	<div id="i_all" style="display: none">
	<p>Иконка </p>
	<div  class="input-group">
				  <span onclick="showHide('whatever');showContent('./css/s-ico1.php');" class="input-group-addon primary">				  
				  <span class="arrow"></span>
					<i id="icoclass" class="icon-dollar"></i>
				  </span>
				  <input type="text" class="form-control" id="ico" name="ico" style="height: 30px;" >
				</div>
				
	
<script>
    $(function(){
        $('#icocolor').colorpicker();
    });
</script>

	<p>Цвет Иконки </p>
	<input type="text" id="icocolor" name="icocolor" class="form-control demo demo-1 demo-auto form-control" value="#5367ce" />		


<p>Тип</p>
	<div class="row">
      <div class="col-lg-4">
    <select class="form-control" onchange="document.getElementById('modetype').value=this.value">
	       <option value=""></option> 	
       		<?php    $resulte = mysqli_query($con,"SELECT mode FROM developments GROUP BY mode ");while($rowe = mysqli_fetch_assoc($resulte)) { ?> 
			<option value="<?php  echo $rowe['mode'];?>"><?php  echo $rowe['mode'];?></option> 	
		<?php 					}					?> 
    </select>
	</div>
	  <div class="col-lg-8">
    <input class="form-control" type="text" id="modetype" name="modetype" maxlength="4" value="" />
</div>
</div>


</div>
	
<div id="i_simvol" style="display: none">
	<p>Символ</p>

<div class="row">
      <div class="col-lg-4">
    <select class="form-control" onchange="document.getElementById('symbol').value=this.value">
	         <option value=""></option> 	
			<option value="%">%</option> 	
			<option value="С°">С°</option> 
    </select>
	</div>
	  <div class="col-lg-8">
    <input class="form-control" type="text" id="symbol" name="symbol" maxlength="4" value="" />
</div>

</div>
</div>
	
  
	
	
 <div id="i_parm1" style="display: none"><p>Параметр 1</p><input id="namevalue1" name="namevalue1" type="text" class="form-control" maxlength="20" placeholder="Наименование 1"></div>
 <div id="i_parm2" style="display: none"><p>Параметр 2</p><input id="namevalue2" name="namevalue2" type="text" class="form-control" maxlength="20" placeholder="Наименование 2"></div>	
 <div id="i_parm3" style="display: none"><p>Параметр 3</p><input id="namevalue3" name="namevalue3" type="text" class="form-control" maxlength="20" placeholder="Наименование 3"></div>
 <div id="i_parm4" style="display: none"><p>Параметр 4</p><input id="namevalue4" name="namevalue4" type="text" class="form-control" maxlength="20" placeholder="Наименование 4"></div>

				   
			<br>
				<br>
			



					    <button type="submit" class="btn btn-sm btn-small btn-primary" name="addtype" value="" ><i class="icon-plus"></i> Добавить</button>
						<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-primary" name="edittype" value="" ><i class="icon-edit"></i> Изменить</button>
						<button type="button" disabled="disabled" onclick="clintype()"  class="btn btn-sm btn-small btn-white" name="clintype" value="" >Очистить</button>
						
						 <button onclick="return confirm('Вы действительно хотите удалить псевдонимы устройств?')" type="submit" class="btn btn-sm btn-danger btn-small"  name="deltype" style="margin-top: 5px;" title="Удалить записи">Удалить записи</button> 
						

							 </div>	   
		  
		   
   
		   
		   
		   
		   
		   
        </div>
	</div>
	


    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
        	
      
		        <section id="settings-notifications">
			   <table id="example4" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                           <th data-class="expand" style="width: 30px;">  </th>
										   <th data-class="expand" style="width: 30px;">  </th>
										    <th data-class="expand" style="width: 30px;">  </th>
												<th data-class="expand">Наименование</th>
                                                <th data-hide="phone,tablet">Тип</th>
												  <th style="width: 40px;" data-hide="phone,tablet">C</th>  
												  <th data-hide="phone,tablet">Режим</th>
												   <th data-hide="phone,tablet">Наименование </th>
												    <th data-hide="phone,tablet">Наименование</th>
													<th data-hide="phone,tablet">Наименование</th>
													<th data-hide="phone,tablet">Режим</th>
													
                                               
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$IDDN = mysqli_query($con,"SELECT * FROM type ");
										if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
										?>
			
											<tr onclick="getText3<?php echo $mIDDN['id'];?>()">
												<td><i class="<?php	echo $mIDDN['ico']; ?> text-success" style="font-size: 20px; color: <?php	echo $mIDDN['color']; ?> !important;"></i>
										     
												</td>
													<td <?php if($mIDDN['type']!=1) {  echo 'style=" background-color: #ccc;"';  } ?>>
														<?php	if($mIDDN['tchart']==1&&$mIDDN['type']==1){ ?> <i style="font-size: 20px; color: #83A64E  !important;" class="icon-chart-bar"></i><?php	} ?>
												<?php	if($mIDDN['tchart']==0&&$mIDDN['type']==1){ ?> <i style="font-size: 20px; color: #AE87F2  !important;" class="icon-chart-area"></i><?php	} ?>
													</td>	
												<td><input id="chbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='boxtype[]' value=<?php	echo $mIDDN['id']; ?>></td>		
												<td ><?php	echo $mIDDN['name']; ?></td>									
												<td><?php	echo $mIDDN['mode']; ?></td>
												<td <?php if($mIDDN['type']!=1) {  echo 'style=" background-color: #ccc;"';  } ?> ><?php	echo $mIDDN['symbol']; ?></td>
												<td><?php	echo $mIDDN['type']; ?></td>
												<td <?php if($mIDDN['type']==4) {  echo 'style=" background-color: #ccc;"';  } ?> ><?php	echo $mIDDN['namevalue1']; ?></td>
												<td <?php if($mIDDN['type']==4||$mIDDN['type']==1) {  echo 'style=" background-color: #ccc;"';  } ?> ><?php	echo $mIDDN['namevalue2']; ?></td>
												<td <?php if($mIDDN['type']==4||$mIDDN['type']==1||$mIDDN['type']==2) {  echo 'style=" background-color: #ccc;"';  } ?> ><?php	echo $mIDDN['namevalue3']; ?></td>
												<td>
												<?php	if($mIDDN['regim']==0){ ?> <i style="font-size: 20px; color: #5F5489  !important;" class="icon-switch"></i><?php	} ?>
												<?php	if($mIDDN['regim']==1){ ?> <i style="font-size: 20px; color: #5F5489  !important;" class="icon-up-thin"></i><?php	} ?>
												<?php	if($mIDDN['regim']==2){ ?> <i style="font-size: 20px; color: #5F5489  !important;" class="icon-down-thin"></i><?php	} ?>
											    <?php	if($mIDDN['regim']==3){ ?> <i style="font-size: 20px; color: #5F5489  !important;" class="icon-desktop-circled"></i><?php	} ?>
											 
												</td>
														  
<script type="text/javascript">
function getText3<?php echo $mIDDN['id'];?>(el){

	document.getElementById('idtype').value = '<?php	echo $mIDDN['id']; ?>';
	document.getElementById('nametype').value = '<?php	echo $mIDDN['name']; ?>';
	document.getElementById('modetype').value = '<?php	echo $mIDDN['mode']; ?>';
	document.getElementById('ico').value = '<?php	echo $mIDDN['ico']; ?>';
	document.getElementById('icocolor').value = '<?php	echo $mIDDN['color']; ?>';
	
	document.getElementById('symbol').value = '<?php	echo $mIDDN['symbol']; ?>';
	document.getElementById('icoclass').className  = '<?php	echo $mIDDN['ico']; ?>';
	document.getElementById("radio<?php	echo $mIDDN['regim']; ?>").checked = true; 
	document.getElementById("mradio<?php	echo $mIDDN['tchart']; ?>").checked = true; 
	$('#typetype').val('<?php	echo $mIDDN['type']; ?>').change();
	document.getElementById('namevalue1').value = '<?php	echo $mIDDN['namevalue1']; ?>';
	document.getElementById('namevalue2').value = '<?php	echo $mIDDN['namevalue2']; ?>';
	document.getElementById('namevalue3').value = '<?php	echo $mIDDN['namevalue3']; ?>';
	document.getElementById('namevalue4').value = '<?php	echo $mIDDN['namevalue4']; ?>';		
	document.myForm.edittype.disabled = false;
	document.myForm.clintype.disabled = false;

}
</script>
		<script type="text/javascript">
function clintype(){
	document.getElementById('idtype').value = '';
	document.getElementById('nametype').value = '';
	document.getElementById('modetype').value = '';
//	document.getElementById('ico').value = '';
//	document.getElementById('icocolor').value = '';
//	document.getElementById('symbol').value = '';
//	document.getElementById('icoclass').className  = '';
//	$('#typetype').val('').change();
//	document.getElementById('namevalue1').value = '';
//	document.getElementById('namevalue2').value = '';
//	document.getElementById('namevalue3').value = '';
//	document.getElementById('namevalue4').value = '';
//	document.myForm.edittype.disabled = true;
//	document.myForm.clintype.disabled = true;
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
				</div>
				
		</div>

	</form>
	</body>
</html>