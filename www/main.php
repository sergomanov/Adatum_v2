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
						
		<div class="s2-map map" id="map" style="overflow:hidden;">
		<script>      $(function() {          $( "#draggable" ).draggable();        });        </script>
		<?php	 include 'map.php'; ?>					
		</div>

	</div>


	</body>
</html>