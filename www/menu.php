<?php	
 include 's-head.php';
  include 'adatum.class.php';
 ?>

<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-itunes-app" content="app-id=492074737">
        <meta name="google-play-app" content="app-id=ru.starline">
        <title>Adatum - системы контроля помещений</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">




    
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<style type="text/css">.Mscroll{height: 100%;overflow: auto;}</style>
<script src="js/jquery.nicescroll.min.js"></script>
<script>  $(document).ready(function() {$(".Mscroll").niceScroll({cursorborder:"",cursorcolor:"rgb(162, 162, 184)",boxzoom:false});   });</script>
	
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/3.css">
<link rel="stylesheet" href="css/datatables.css">	
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
    
    <link rel="stylesheet" href="css/datatables.responsive.css"/>
    <style>
        .title {
            font-size: larger;
            font-weight: bold;
        }

        .table th.centered-cell, .table td.centered-cell {
            text-align: center;
        }
    </style>
	

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/datatables.responsive.js"></script>

   <script>  
        $(document).ready(function(){  
          
            $('#btn1').click(function(){  
                $.ajax({  
                    url: "setting.php",  
                    cache: false,  
                    success: function(html){  
                        $("#content").html(html);  
                    }  
                });  
            });  
              
            $('#btn2').click(function(){  
                $.ajax({  
                    url: "monitoring.php",  
                    cache: false,  
                    success: function(html){  
                        $("#content").html(html);  
                    }  
                });  
            });  
              
        });  
    </script>
	<script type="text/javascript">

function Sdiv(id,tid){
	
var el=document.getElementById(id);
var tel=document.getElementById(tid);

if(el.style.display=="block"){
el.style.display="none";
tel.className = el.className.replace( /(?:^|\s)active(?!\S)/ , '' );
} else {
el.style.display="block";
tel.className += " active";
}
}
</script>


	<script type="text/javascript">
function viewmenu()
{
document.getElementById("dev").style.display="none";
document.getElementById("menu").style.display="block";
}

function viewdev()
{
document.getElementById("menu").style.display="none";
document.getElementById("dev").style.display="block";
}

function hidepole()
{
	 if(window.innerWidth<680) {
      document.getElementById("pole").style.width="0px";
	  document.getElementById("pole").style.display="none";
	  document.getElementById("map").style.left="0px";
    }
}

function viewdiv()
{
if(document.getElementById("pole").style.width=="0px"){

document.getElementById("map").style.left="317px";
document.getElementById("keyshow").style.left="317px";
document.getElementById("header").style.width="317px";
document.getElementById("boxscroll").style.display="block";
document.getElementById("header").style.display="block";
document.getElementById("pole").style.display="block";
 if(window.innerWidth<680) {
      document.getElementById("pole").style.width="100%";
	document.getElementById("header").style.width="100%";
	  
	
    }
	else
	{
	document.getElementById("pole").style.width="317px";
	document.getElementById("header").style.width="317px";
	}

} else {
document.getElementById("pole").style.width="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("header").style.width="0px";
document.getElementById("pole").style.display="none";
document.getElementById("boxscroll").style.display="none";
document.getElementById("header").style.display="none";
}
}

</script>
			</head>

    <body class="white">

   <div  class="s2-content" style="padding-top: 70px;">
		
<div id="keyshow" href="javascript:void(0);" onclick="viewdiv();" class="s2-hide-panel" style="height: 55px;">↔</div>
      

	     <div class="header" id="header" style="position: fixed; top:0;z-index: 2;">
                    <a href="javascript:void(0)" onclick="document.getElementById(&#39;goat&#39;).style.display = &#39;block&#39;" class="logo">Автоматизация помещений</a>
                    <a href="https://starline-online.ru/user/logout" class="logout transitionAll">Выход</a>
                    <a  href="javascript:void(0);" onclick="viewmenu();" class="menu transitionAll">Меню</a>
               
                </div>
				
		 <div class="left-area Mscroll" style="border-right: 1px solid #CDCDCD;" id="pole">

	

             

              

			  
			  

		  
			  
			  
<div id="boxscroll" class=" inner -js-inner" style="margin-left: 0%;width: 100%;" >
			

		
<ul id="menu"  class=" main-menu -js-main-menu" style="display:none;">

<div class="jspContainer" style=""><div class="jspPane" style="padding: 0px; top: 0px;">
	
	<li class="devices active">
            <a href="javascript:void(0);" onclick="viewdev();" class="static">
                <dl>
				   <dt>Помещения</dt>
                    <dd>Управление и подключение</dd>
                </dl>
            </a>
    </li>

	<li class="geozone">
            <a href="https://starline-online.ru/map.php#geo" class="static">
                <dl>
                    <dt>Геозоны и метки</dt>
                    <dd>Создание, редактирование</dd>
                </dl>
            </a>
        </li>
		<li class="profile">
            <a href="#" onclick="hidepole();">
                <div class="avatar" style="background-image: url(img/prr.png)"></div>
                <dl>
                    <dt>Личный кабинет</dt>
                    <dd>demo@demo.ru</dd>
                </dl>
            </a>
        </li>
		
			<li class="settings">
            <a id="btn1" onclick="hidepole();" href="javascript:void(0);"  class="static">
                <dl>
                    <dt>Настройки</dt>
                    <dd>Безопасный вход, уведомления</dd>
                </dl>
            </a>
        </li>
		
		<li class="monitoring">
            <a  id="btn2" onclick="hidepole();" href="javascript:void(0);"  class="static">
                <dl>
                    <dt>Мониторинг</dt>
                    <dd>Очередь комманд, системная информация</dd>
                </dl>
            </a>
        </li>
		
				
		<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			
				<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			
				<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			
				<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			
				<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			
				<li class="help">
            <a href="https://starline-online.ru/map.php#help" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
		

		
		</div></div>
</ul>		

 


<ul id="dev" class="s2-menu -js-device-menu"  style="display: block;  padding: 0px;">
                            <div class="jspContainer">
							<div class="jspPane" style="padding: 0px; top: 0px;">
							
				
							
	

	
<div  class="menu-item online">
       
	   <div id="topmenu5" onclick="Sdiv('menu5','topmenu5');" class="menu-item-link cleafix">
            <div class="menu-item-gpsgsm-container">
                 <div class="menu-item-gpsgsm-status">			
				  <div class="clearfix">				
					<div style="float:left"><div class="gsm-status" title="" data-level="4"></div><div align="center" class="greyColor" style="color:#59626E;font-size:90%">gsm</div></div>
					<div style="float:left;margin-left:10px;"><div title="" class="gps-status" data-level="0"></div><div class="greyColor" align="center" style="color:#59626E;font-size:90%">gps</div></div>  
				  </div>
				</div>
             </div>
            <div class="menu-item-title-container"><div class="menu-status onoff on"></div><div class="menu-title"><div>Кухня</div><span>в сети</span></div></div>
        </div>
      

				<div id="menu5" class="menu-content" style="display:none;">
						
						<div class="menu-item-tabs">
								<table>
							<tbody><tr>
								<td data-id="info" title="Управление и состояние автомобиля" class="menu-item-tab info active" style="z-index: 11;"><div></div></td>
								<td class="empty"></td>
								<td data-id="track" title="Перемещения" class="menu-item-tab track"><div></div></td>
								<td class="empty"></td>
								<td data-id="events" title="События" class="menu-item-tab events"><div></div></td>
								<td class="empty"></td>
								<td data-id="settings" onclick="window.location.hash = &#39;device/settings/4&#39;" title="Настройки" class="menu-item-settings-icon">
									<img src="img/icon-settings.png">
								</td>
							</tr>
						</tbody></table>
						</div>
						
						
					<div class="menu-item-tabs-content">
								<div data-id="info" style="padding-top: 5px; position: relative; opacity: 1; ">
					
				<div class="menu-item-tab-car-controls" style="opacity: 1;">							
						
						
						<div class="s2-toggle-edit-buttons" style="position:absolute;width:267px;height:44px;margin:-17px 0 0 0px;background:url(/images/s2/menu-item-info-bgeditbutton_white.png) no-repeat center bottom">	
						<div class="s2-toggle-edit-button" title="Режим редактирования кнопок управления"></div>	
						</div>
						
						<div class="s2-control-container">									
							


							
						<div class="s2-control-scroll" style="position:relative;padding-bottom: 10px;margin: 0 auto">		

						<div class="s2-control-item" style="padding-top: 30px;">	
						
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>										
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
							<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
				<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						</div>		
						</div>					
						</div>	

						
						<ul class="under-buttons-panel">						
						<li id="sim_balance_title4" class="sim_balance" title="Баланс SIM-карты"><div class="sim_balance_icon"></div><span class="sim_balance_value">165</span> <span class="rur">p<span>уб.</span></span></li>			
						<li id="sim_battery_title4" class="battery" title="Напряжение аккумулятора"><div class="battery_icon"></div><span class="battery_value">12.19</span>В</li>							
						<li id="sim_t1_title4" class="ctemp" title="Температура в салоне"><div class="ctemp_icon"></div><span class="ctemp_value">24°C</span></li>									
						<li id="sim_t2_title4" class="etemp" title="Температура двигателя"><div class="etemp_icon"></div><span class="etemp_value">78°C</span></li>	
					<li id="sim_t1_title4" class="ctemp" title="Температура в салоне"><div class="ctemp_icon"></div><span class="ctemp_value">24°C</span></li>									
						<li id="sim_t2_title4" class="etemp" title="Температура двигателя"><div class="etemp_icon"></div><span class="etemp_value">78°C</span></li>			
						</ul>									</div>
						
						  
							
						</div>
						<div data-id="track" style="display:none;padding-top:10px;"><div class="s2-calendar-container"></div><div id="trackList"></div></div>
						<div data-id="events"></div>
					</div></div>
	
	
    </div>
	
	
	
	<div  class=" menu-item ">
       
	   <div id="topmenu1" onclick="Sdiv('menu1','topmenu1');" class="menu-item-link cleafix">
            <div class="menu-item-gpsgsm-container">
                 <div class="menu-item-gpsgsm-status">			
				  <div class="clearfix">				
					<div style="float:left"><div class="gsm-status" title="" data-level="4"></div><div align="center" class="greyColor" style="color:#59626E;font-size:90%">gsm</div></div>
					<div style="float:left;margin-left:10px;"><div title="" class="gps-status" data-level="0"></div><div class="greyColor" align="center" style="color:#59626E;font-size:90%">gps</div></div>  
				  </div>
				</div>
             </div>
            <div class="menu-item-title-container"><div class="menu-status onoff on"></div><div class="menu-title"><div>Кухня</div><span>в сети</span></div></div>
        </div>
      

				<div id="menu1" class="menu-content" style="display:none;">
						
						<div class="menu-item-tabs">
								<table>
							<tbody><tr>
								<td data-id="info" title="Управление и состояние автомобиля" class="menu-item-tab info active" style="z-index: 11;"><div></div></td>
								<td class="empty"></td>
								<td data-id="track" title="Перемещения" class="menu-item-tab track"><div></div></td>
								<td class="empty"></td>
								<td data-id="events" title="События" class="menu-item-tab events"><div></div></td>
								<td class="empty"></td>
								<td data-id="settings" onclick="window.location.hash = &#39;device/settings/4&#39;" title="Настройки" class="menu-item-settings-icon">
									<img src="img/icon-settings.png">
								</td>
							</tr>
						</tbody></table>
						</div>
						
						
					<div class="menu-item-tabs-content">
								<div data-id="info" style="padding-top: 5px; position: relative; opacity: 1; ">
							
				<div class="menu-item-tab-car-controls" style="opacity: 1;">							
						
						
						<div class="s2-toggle-edit-buttons" style="position:absolute;width:267px;height:44px;margin:-17px 0 0 0px;background:url(/images/s2/menu-item-info-bgeditbutton_white.png) no-repeat center bottom">	
						<div class="s2-toggle-edit-button" title="Режим редактирования кнопок управления"></div>	
						</div>
						
						<div class="s2-control-container">									
							


							
						<div class="s2-control-scroll" style="position:relative;padding-bottom: 10px;margin: 0 auto">		

						<div class="s2-control-item" style="padding-top: 30px;">	
						
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>										
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
							<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
				<div title="Добавить кнопку управления" data-id="add-command" data-number="5" data-command="0" class="add-command s2-control-button s2-control-left2">		
						<div class="s2-control-push"></div>											<div class="s2-control-icon">											
						<div class="s2-control-icon-add-command" style="background:url(/images/s2/controls/buttons-icon-set_white.png) no-repeat -180px 0px;">				
						</div>											</div>											
						<div class="s2-control-icon-reset"><a href="https://starline-online.ru/map.php#" title="Сбросить кнопку управления"></a></div>		
						</div>	
						</div>		
						</div>					
						</div>	

						
						<ul class="under-buttons-panel">						
						<li id="sim_balance_title4" class="sim_balance" title="Баланс SIM-карты"><div class="sim_balance_icon"></div><span class="sim_balance_value">165</span> <span class="rur">p<span>уб.</span></span></li>			
						<li id="sim_battery_title4" class="battery" title="Напряжение аккумулятора"><div class="battery_icon"></div><span class="battery_value">12.19</span>В</li>							
						<li id="sim_t1_title4" class="ctemp" title="Температура в салоне"><div class="ctemp_icon"></div><span class="ctemp_value">24°C</span></li>									
						<li id="sim_t2_title4" class="etemp" title="Температура двигателя"><div class="etemp_icon"></div><span class="etemp_value">78°C</span></li>	
					<li id="sim_t1_title4" class="ctemp" title="Температура в салоне"><div class="ctemp_icon"></div><span class="ctemp_value">24°C</span></li>									
						<li id="sim_t2_title4" class="etemp" title="Температура двигателя"><div class="etemp_icon"></div><span class="etemp_value">78°C</span></li>			
						</ul>									</div>
						
						  
							
						</div>
						<div data-id="track" style="display:none;padding-top:10px;"><div class="s2-calendar-container"></div><div id="trackList"></div></div>
						<div data-id="events"></div>
					</div></div>
	
	
    </div>
	
	
		
	<li id="menuAddDiv" class="menu-item s2-device-add">
		<div class="menu-item-link" >
			<div class="menu-status"><span>+</span></div>
			<div class="menu-title">Добавить помещение</div>
		</div>
   </li>
							
																
</div></div></ul>

                </div>

          
   </div>
			
			
<div class="s2-map map" id="map">
 	<div id="content"></div>  
	<style>        #draggable { width: 150px; height: 150px; padding: 0.5em; }</style>
	<script>        $(function() {          $( "#draggable" ).draggable();        });        </script>
	<div id="draggable"><img src="1.jpg"  width="900px"  alt="lorem"></div>			
</div>
            
        </div>


</body></html>