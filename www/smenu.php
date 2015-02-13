<div class="left-area Mscroll" style="border-right: 1px solid #CDCDCD;" id="pole"> 
<div id="boxscroll" class=" inner -js-inner" style="margin-left: 0%;width: 100%;" >
<ul id="dev" class="s2-menu -js-device-menu  main-menu -js-main-menu"  style="display: block;  padding: 0px;">
	<div class="jspContainer">
		<div class="jspPane" style="padding: 0px; top: 0px;">
									
	
	<li class="devices  <?php if(basename($_SERVER['PHP_SELF'])=='main.php'){echo "active";}?>">
            <a href="main.php" class="static">
                <dl>
				   <dt>Помещения</dt>
                    <dd>Управление и подключение</dd>
                </dl>
            </a>
    </li>

	<li class="geozone <?php if(basename($_SERVER['PHP_SELF'])=='log.php'){echo "active";}?>">
            <a href="log.php" class="static">
                <dl>
                    <dt>История</dt>
                    <dd>События, измерения</dd>
                </dl>
            </a>
        </li>
		

		
			<li class="settings <?php if(basename($_SERVER['PHP_SELF'])=='setting.php'){echo "active";}?>">
            <a id="btn1" href="setting.php"  class="static">
                <dl>
                    <dt>Настройки</dt>
                    <dd>Безопасный вход, уведомления</dd>
                </dl>
            </a>
        </li>
		
		<li class="monitoring  <?php if(basename($_SERVER['PHP_SELF'])=='monitoring.php'){echo "active";}?>" >
            <a  id="btn2" href="monitoring.php"  class="static">
                <dl>
                    <dt>Мониторинг</dt>
                    <dd>Очередь комманд, системная информация</dd>
                </dl>
            </a>
        </li>
		
				
		<li class="help <?php if(basename($_SERVER['PHP_SELF'])=='help.php'){echo "active";}?>">
            <a id="btn3"  href="help.php" class="static">
                <dl>
                    <dt>Помощь</dt>
                    <dd>Поддержка пользователей</dd>
                </dl>
            </a>
	        </li>
			

														
		</div>
	</div>
</ul>

</div>    
</div>