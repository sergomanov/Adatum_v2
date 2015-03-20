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
   <div  class="s2-content"  id="paddi" style="padding-top: 70px;">
			
		<?php	 include 'topmenu.php'; 		?>
		<?php	 include 'smenu.php'; ?>
						
		<div class="s2-map" id="map" style="overflow:hidden;">
		<script>      $(function() {          $( "#draggable" ).draggable();        });        </script>
		



<a class="roundbutton"  href="button.php"  style="bottom: 12px;left: 5px;" value="-"><i class="icon-cog" style="font-size: 26px;"></i></a>
<a class="roundbutton"  href="main.php"  style="bottom: 70px;left: 5px;" value="-"><i class="icon-map-1" style="font-size: 26px;"></i></a>


<?php 
if(isset($_GET['edit']))
{
?>
<a href="main.php" title="Закончить редактирование" onclick="send();" style="background-color: #ffa800!important;" class="s3-hide-panel"><i class="icon-move-2"></i> </a>	
<?php 
} else {
?>	
<a href="main.php?edit=1" title="Редактировать" class="s3-hide-panel"><i class="icon-move-2"></i> </a>
<?php 
} 
 ?>

  

 
<div id="youmap" style="width: 100%; height: 100%; "></div>

<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
// Как все загрузиться выполняем инициализацию
ymaps.ready(init);
 
function init () {
   var map = new ymaps.Map("youmap", {
     center: [53.729908, 91.440368],
     zoom: 17
   }),
 
   // Создадим первую метку c контентом
   MacDac= new ymaps.Placemark([53.729908, 91.440368], {
      iconContent: '"Вы тут"'   // Свойство: текст метки
   }, {
      preset: 'twirl#greenStretchyIcon'  // иконка растянется под ее контент
   });
 

 
   // Добавляем метки на карту
   map.geoObjects.add(MacDac);
}
</script>

  

		
		</div>

	</div>


	</body>
</html>