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

	   <div  class="s2-content" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

							
							
				<div class="s2-map map" id="map">




<div class="right-area -js-right-area Mscroll" style="display: block; overflow: hidden; padding: 0px;  outline: none;" tabindex="0">
                
            <div class="jspContainer" style=""><div class="jspPane" style="padding: 0px; top: 0px;"><div class="right-area-content -js-right-area-content">

    <div id="settings">
        <header>
            <!-- Кнопка "назад в меню" для мобильных устройств -->
            <a href="#menu" class="back-menu" onclick="$UTILS.RightArea.hide()"></a>
            
            <h1 style="padding-left: 50px;">Мониторинг</h1>
        </header>
    
        
        <section id="settings-notifications">
			
			  <div class="title">Файловая система:</div>
          
		  <div class="control-row">
                <div class="on-off-switch-title"><span>Всего</span>
                    <div class="tooltips" title="Настройка отправки уведомлений о пересечении границ выбранных геозон"></div>
                </div>
                <div>
				<?php echo disktotal(2);  ?>
                 </div>
            </div>
			
			  <div class="control-row">
                <div class="on-off-switch-title"><span>Свободно</span>
                    <div class="tooltips" title="Настройка отправки уведомлений о пересечении границ выбранных геозон"></div>
                </div>
                <div>
				<?php echo disktotal(1);  ?>
                 </div>
            </div>
			
			  <div class="control-row">
                <div class="on-off-switch-title"><span>Занято</span>
                    <div class="tooltips" title="Настройка отправки уведомлений о пересечении границ выбранных геозон"></div>
                </div>
                <div>
				<?php echo disktotal(3);  ?>
                 </div>
            </div>
         
            <div class="control-row">
                <div class="on-off-switch-title"><span>Свободно <?php echo diskuse();  ?>%</span>
                    <div class="tooltips" title="Настройка отправки уведомлений о пересечении границ выбранных геозон"></div>
                </div>
                <div>
				<div class="progress" title="<?php echo 100-diskuse();  ?>%">
			<div class="progress_load" style="width: <?php echo 100-diskuse();  ?>px;"/></div>
			</div>
                 </div>
            </div>
			
			      <div class="control-row">
                <div class="on-off-switch-title"><span>Система работает:</span>
                    <div class="tooltips" title="Настройка отправки уведомлений о пересечении границ выбранных геозон"></div>
                </div>
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
		
			     <table id="example" class=" table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                             
												<th data-class="expand">Состояние</th>
                                                <th data-hide="phone,tablet">Комманда</th>
                                                <th data-hide="phone,tablet">Дата</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$IDDN = mysqli_query($con,"SELECT * FROM run ORDER BY id DESC");
if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
	?>
			
			  <tr>
                                                <td>
											
					<?php if($mIDDN['run']==0){?> <span class="label label-success">Ожидает выполнения</span> <?php }  ?>
					<?php if($mIDDN['run']==1){?> <span class="label label-info">Выполнено</span> <?php }  ?>
					   
					   
												
												
												
												</td>
                                                <td><?php	echo $mIDDN['vale']; ?></td>
                                                <td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:m:s", $mIDDN['unixtime']);      ?></span></td>
                                              
                                            </tr>
											
<?php  }}	?>									
											
		  </tbody>
                                    </table>	

									
											
											
		

			
			
			

			
           
            <!-- ^ Переключатель уведомлений контроля канала связи -->
        </section>
		
    </div></div></div></div></div>
	
				</div>
				
		</div>


	</body>
</html>