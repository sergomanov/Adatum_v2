<div class="left-area Mscroll" style="border-right: 1px solid #CDCDCD;overflow: scroll;" id="pole">




<ul id="men" class="s2-menu -js-device-menu  main-menu -js-main-menu"  style="display: block;  padding-left: 5px;">
	
	
		
<li class="<?php if(basename($_SERVER['PHP_SELF'])=='setting.php'){echo "active";}?>" style="padding: 12px;padding-top: 19px;">
	<a id="btn1" href="setting.php" >
	<i style=" font-size: 85px;color: #F07D00;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 50px;color: #fff;padding: -40px;margin: -14px 0px 0px -12px;position: absolute;" class="icon-cog-outline"></i>
		<dl style="padding-left: 65px;">
	  <dt>Настройки</dt>
	        <dd>Безопасный вход, уведомления</dd>
		</dl>
	</a>
</li>		
	
<li class="<?php if(basename($_SERVER['PHP_SELF'])=='log.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="log.php" >
	<i style=" font-size: 85px;color: #748887;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 50px;color: #fff;padding: -40px;margin: -14px 0px 0px -12px;position: absolute;" class="icon-book"></i>
		<dl style="padding-left: 65px;">
	    <dt>История</dt>
                    <dd>События, измерения</dd>
		</dl>
	</a>
</li>	


<li class="<?php if(basename($_SERVER['PHP_SELF'])=='run.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="run.php" >
	<i style=" font-size: 85px;color: #ECE924;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 50px;color: #fff;padding: -40px;margin: -14px 0px 0px -12px;position: absolute;" class="icon-flash"></i>
		<dl style="padding-left: 65px;">
	    <dt>Действия</dt>
                    <dd>Действия и условия</dd>
		</dl>
	</a>
</li>	
		
<li class="<?php if(basename($_SERVER['PHP_SELF'])=='type.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="type.php" >
	<i style=" font-size: 85px;color: #32E51D;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 60px;color: #fff;padding: -40px;margin: -22px 0px 0px -20px;position: absolute;" class="icon-hdd-1"></i>
		<dl style="padding-left: 65px;">
			<dt>Типы датчиков</dt>
			<dd>Справочник типов датчиков</dd>
		</dl>
	</a>
</li>


<li class="<?php if(basename($_SERVER['PHP_SELF'])=='charts.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="charts.php" >
	<i style=" font-size: 85px;color: #B66522;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 40px;color: #fff;padding: -40px;margin: -8px 0px 0px -8px;position: absolute;" class="icon-chart-bar"></i>
		<dl style="padding-left: 65px;">
			<dt>Графики</dt>
			<dd>Построение графиков показаний</dd>
		</dl>
	</a>
</li>

		

<li class="<?php if(basename($_SERVER['PHP_SELF'])=='monitoring.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="monitoring.php" >
	<i style=" font-size: 85px;color: #8F97A5;padding: -40px;margin: -30px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 60px;color: #fff;padding: -40px;margin: -13px 0px 0px -17px;;position: absolute;" class="icon-jabber"></i>
		<dl style="padding-left: 65px;">
			 <dt>Мониторинг</dt>
                    <dd>Очередь комманд, системная информация</dd>
		</dl>
	</a>
</li>	
		
		
		
<li class="<?php if(basename($_SERVER['PHP_SELF'])=='scheduler.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="scheduler.php" >
	<i style=" font-size: 85px;color: #FC0;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 60px;color: #fff;padding: -40px;margin: -22px 0px 0px -20px;position: absolute;" class="icon-back-in-time"></i>
		<dl style="padding-left: 65px;">
			<dt>Планировщик</dt>
			<dd>Управление устройствами</dd>
		</dl>
	</a>
</li>

<li class="<?php if(basename($_SERVER['PHP_SELF'])=='help.php'){echo "active";}?>" style="padding: 12px;">
	<a id="btn1" href="help.php" >
	<i style=" font-size: 85px;color: #1DACE3;padding: -40px;margin: -40px 0px 0px -36px;position: absolute;" class="icon-circle"></i>
	<i style=" font-size: 60px;color: #fff;padding: -40px;margin: -22px 0px 0px -20px;position: absolute;" class="icon-help"></i>
		<dl style="padding-left: 65px;">
			<dt>Помощь</dt>
			<dd>Поддержка пользователей</dd>
		</dl>
	</a>
</li>

<div  style="height: 100px;"></div>

</ul>

 






<ul id="dev" class="s2-menu -js-device-menu"  style="display: block; padding-left: 5px;">


<?php 
$resulte = mysqli_query($con,"SELECT * FROM namedev WHERE id_user = '$G_id_user'");	while($rowe = mysqli_fetch_assoc($resulte)) { $address= $rowe['address'];$S_unixtime=$rowe['unixtime'];
$timereal=time(); 
if($S_unixtime==0||($S_unixtime!=0&&$timereal-$S_unixtime>600)){$onlin=0;} else {$onlin=1;}
?> 

<div  class="menu-item ">
	
	
<div id="topmenu<?php	echo $rowe['id']; ?>" onclick="Sdiv('menu<?php	echo $rowe['id']; ?>','topmenu<?php	echo $rowe['id']; ?>','icond<?php	echo $rowe['id']; ?>');" class="menu-item-link  cleafix">
	<div class="menu-item-title-container">
	<i id="icond<?php	echo $rowe['id']; ?>" style=" font-size: 20px;	<?php if($onlin==0) {echo "color: #A09B9B;";} else { echo "color: #00aeef;";}?>
		padding: -40px;margin: 17px 0px 0px 1px;position: absolute;" class="icon-plus"></i>
		<div class="menu-title">
		<div style="<?php if($onlin==0) {echo "color: #A09B9B;";} else { echo "color: #00aeef;";}?>"><?php	echo $rowe['name']; ?></div>
			<span style="font-size: 12px;">
				<?php	
				if($timereal-$S_unixtime<600){ echo "устройство в сети";}
				if($S_unixtime!=0&&$timereal-$S_unixtime>600) {echo "нет связи с ". date("d.m.Y, H:m", $S_unixtime);}
				if($S_unixtime==0){ echo "недоступно в сети";}
				//	echo 	$timereal-$S_unixtime;
				//if($timereal-$S_unixtime>360){ echo "Устройство в сети.";} 
				?>
			</span>
		</div>
	</div>
</div>
	
	
	
	
<div id="menu<?php	echo $rowe['id']; ?>" style="display:none;padding-top: 2px;">			

<div class="menu-item-tabs-content" id="buttonpanel<?php	echo $rowe['id']; ?>">

											
<?php 
$resulte6 = mysqli_query($con,"SELECT * FROM commands WHERE address='$address'");	
while($rowe6 = mysqli_fetch_assoc($resulte6)) {
$mode6=$rowe6['mode'];$resulte5 = mysqli_query($con,"SELECT * FROM type WHERE mode='$mode6'");	
while($rowe5 = mysqli_fetch_assoc($resulte5)) { $ico5=$rowe5['ico']; $color5=$rowe5['color']; $symbol5=$rowe5['symbol']; $type5=$rowe5['type'];$namevalue1_5=$rowe5['namevalue1'];}
?> 
<?php	
$Mcommands="#".$rowe6['address']."#".$rowe6['mode']."#".$rowe6['vale']."##";
//echo $Mcommands;
?>	
	
<div onclick="hidediver();$.ajax({type: 'POST',url: 's-respfast.php',data: 'value=<?php	echo $Mcommands; ?>'});"
title="<?php	echo $rowe6['name']; ?>" class="add-command s2-control-button s2-control-left2" style="background: #EBEBEB;
text-align: center;width: 25%;margin: 0px;border-left: 2px solid white;
border-bottom: 2px solid white;padding-top: 3px">		


<i class="<?php	echo $ico5; ?>" style="  font-size: 22px;padding: 0px;color:<?php	echo $color5; ?>"></i>
	<br><div style="    font-size: 10px;"><?php	echo $rowe6['name']; ?>	</div>								
</div>	

							
<?php } ?>  	
	
	
	
<div style="width: 25%;font-size: 1px;"><span class="battery_value">-</span> </div>		
	

			<?php 
				   $resulte4 = mysqli_query($con,"SELECT * FROM developments WHERE address='$address' GROUP BY `mode`");	
				   while($rowe4 = mysqli_fetch_assoc($resulte4)) {
				   $mode4=$rowe4['mode'];
				   $resulte5 = mysqli_query($con,"SELECT * FROM type WHERE mode='$mode4'");	
				   while($rowe5 = mysqli_fetch_assoc($resulte5)) { $ico5=$rowe5['ico']; $color5=$rowe5['color']; $symbol5=$rowe5['symbol']; $type5=$rowe5['type'];$namevalue1_5=$rowe5['namevalue1'];}
				   if($type5==1){
			?> 
				
			
	
<div title="<?php	echo $namevalue1_5; ?>" onclick="chartG<?php	echo $rowe['id']; ?>();" 
 class="add-command s2-control-button s2-control-left2" style="background: #fff;
text-align: center;border-left: 2px solid white;
border-bottom: 2px solid white;width: 25%;margin: 0px;padding-top: 3px">		


<i class="<?php	echo $ico5; ?>" style="  font-size: 22px;padding: 0px;color:<?php	echo $color5; ?>"></i>
	<br><div style="    font-size: 10px;"><?php	echo $rowe4['vale']; ?>	<?php	echo $symbol5; ?></div>								
</div>	

	
			<?php 			   }	}			?>  							
									
	





<div style="width: 25%;font-size: 1px;"><span class="battery_value">-</span> </div>						
								




	<div id="placeholder<?php	echo $rowe['id']; ?>" style="width:100%;height:0px;padding: 10px;"></div>

<script>
function chartG<?php	echo $rowe['id']; ?>(){
	document.getElementById('placeholder<?php	echo $rowe['id']; ?>').style.height="180px";
 var options = {grid:   {borderWidth:1,borderColor:"#EBEBEB",}	};
 var d2 = [[0, 3], [4, 8], [8, 5], [9, 13], [14, 8], [18, 5],[24, 8], [28, 5], [34, 8], [38, 5],];
 $.plot($("#placeholder<?php	echo $rowe['id']; ?>"), [  d2 ],options);
 window.onresize = function(event) { $.plot($("#placeholder<?php	echo $rowe['id']; ?>"), [ d2 ],options);  }
 
 };
</script>	
</div>	

</div>




</div>
		

<?php 	}		?>  
		
	<!-- -------------------------------------------------------------> 	

<li id="menuAddDiv" class="menu-item s2-device-add">
	<a href="dev.php" style="text-decoration: none; ">
		<div class="menu-item-link" >
			<div class="menu-status"><span>+</span></div>
			<div class="menu-title">Добавить или изменить устройство</div>
			
			
		</div>
	</a>
</li>
	<div style="padding: 5px 1px 1px 10px;color: #4386A0;font-size: 12px;"><?php	echo "Добро пожаловать: ".$login_user." (id:".$G_id_user.")";  ?></div>
	
<div  style="height: 100px;"></div>	


	</ul>
</div>




