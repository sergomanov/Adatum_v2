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
					<div id="content"></div>  
					<style>        #draggable { width: 150px; height: 150px; padding: 0.5em; }</style>
					<script>        $(function() {          $( "#draggable" ).draggable();        });        </script>
					<div id="draggable"><img src="1.jpg"  width="900px"  alt="lorem"></div>			
				</div>
				
		</div>


	</body>
</html>