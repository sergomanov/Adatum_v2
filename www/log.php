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
                     
            <h1 style="padding-left: 50px;">История</h1>
        </header>
      <div class="title">Журнал датчиков :</div>
        
		
		
		
        <section id="settings-notifications">
			      <table id="example2" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                             	<th data-class="expand" style="width: 40px;"></th>
												<th data-class="expand">Тип</th>
                                                <th data-hide="phone">Номер устройства</th>
												<th data-hide="phone,tablet">Параметр 1</th>
												<th data-hide="phone,tablet">Параметр 2</th>
												<th data-hide="phone,tablet">Параметр 3</th>
												<th data-hide="phone,tablet">Параметр 4</th>
                                                <th data-hide="phone,tablet">Дата</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$IDDN = mysqli_query($con,"SELECT * FROM developments ORDER BY id DESC");
										if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
											
										?>
			
											<tr>
											<td><?php $rowmode = $mIDDN['mode']; $resico = mysqli_query($con,"SELECT * FROM `type` WHERE mode ='$rowmode'");if($resico){while($rowico = mysqli_fetch_assoc($resico)){$rowicon=$rowico['ico']; $rowcolor=$rowico['color'];?>
<i class="<?php echo $rowicon; ?> text-success " style="font-size: 18px; color: <?php	echo $rowcolor; ?> !important;"></i> <?php }}  ?>
</td>
                                                <td><?php	echo $mIDDN['mode']; ?></td>
                                                <td><?php	echo $mIDDN['address']; ?></td>
												 <td><?php	echo $mIDDN['vale1']; ?></td>
												 <td><?php	echo $mIDDN['vale2']; ?></td>
												 <td><?php	echo $mIDDN['vale3']; ?></td>
												 <td><?php	echo $mIDDN['vale4']; ?></td>
                                                <td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:m:s", $mIDDN['unixtime']);      ?></span></td>
                                            </tr>
											
										<?php  }}	?>													
		  </tbody>
			</table>									
        </section>
		
		  <div class="title">Журнал операции:</div>
		        <section id="settings-notifications">
			   <table id="example" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                             
												<th data-class="expand">Тип</th>
                                                <th data-hide="phone">Сообщение</th>
                                                <th data-hide="phone,tablet">Дата</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$IDDN = mysqli_query($con,"SELECT * FROM logs ORDER BY id DESC");
										if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
										?>
			
											<tr>
                                             
												 <td><?php	if($mIDDN['stat']==3){ ?><img src="images/no.png"  height="25"><?php }	if($mIDDN['stat']==1){ ?><img src="images/ok.png"  height="25"><?php }	 ?></td>										
												<td><?php	echo $mIDDN['cont']; ?></td>
                                                <td class="v-align-middle"><span class="muted"><?php	echo date("Y-m-d H:m:s", $mIDDN['unixtime']);      ?></span></td>
                                            </tr>
											
										<?php  }}	?>													
		  </tbody>
			</table>									
        </section>
		
		
		
		
    </div></div></div></div></div>
				
				</div>
				
		</div>


	</body>
</html>