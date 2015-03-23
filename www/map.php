<div id="nav">
	<button class="roundbutton" id="key3" type="button" style="bottom: 70px;right: 5px;" value="+"><i class="icon-zoom-in-outline" style="font-size: 26px;"></i></button>
	<button class="roundbutton" id="key4" type="button" style="bottom: 12px;right: 5px;" value="-"><i class="icon-zoom-out-outline" style="font-size: 26px;"></i></button>
</div>

<a class="roundbutton" id="key1"  href="button.php"  style="bottom: 12px;left: 5px;" value="-"><i class="icon-cog" style="font-size: 26px;"></i></a>
<a class="roundbutton" id="key2" href="ymap.php"  style="bottom: 70px;left: 5px;" value="-"><i class="icon-globe-1" style="font-size: 26px;"></i></a>

<?php 
if(isset($_GET['edit']))
{
?>
<a href="main.php" id="key5" title="Закончить редактирование" onclick="send();"  class="s3-hide-panel" style="background-color: #ffa800!important;height: 60px;  padding: 15px 16px 17px;"><i class="icon-move-2"></i> </a>	
<?php 
} else {
?>	
<a href="main.php?edit=1" id="key5" title="Редактировать" class="s3-hide-panel" style="background-color: #ffa800!important;height: 60px !important;  padding: 15px 16px 17px !important;"><i class="icon-move-2"></i> </a>
<?php 
} 
 ?>

  
<form name="myForm" id="img" method="post" >
<div id="draggable"><img src="<?php	echo $fonimg; ?>"   alt="lorem">

		<?php 
			$resulte = mysqli_query($con,"SELECT * FROM scheduler WHERE id_user = '$G_id_user' AND type=3");	
			while($rowe = mysqli_fetch_assoc($resulte)) {
			$id=$rowe['id'];
			$r_left_polles="r_left_".$id; $r_left_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$r_left_polles'"); $r_left_row=mysqli_fetch_array($r_left_result);	
			$r_left=$r_left_row['coor'];
			$r_top_polles="r_top_".$id; $r_top_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$r_top_polles'"); $r_top_row=mysqli_fetch_array($r_top_result);
			$r_top=$r_top_row['coor'];
			$Mcommands=$rowe['commands'];
			
		?> 
					
						<div class="Dra" id="dra<?php	echo $id;?>" style="border: 4px double <?php	echo $rowe['color']; ?>;background: rgba(255, 255, 255, 0.77);
						height: 55px !important; position: relative; left: <?php	echo $r_left;?>px; top: <?php	echo $r_top;?>px;">

						<sd style="font-size: 9px;margin: 33px 0px 0px 2px;position: absolute;"><?php	echo $rowe['name']; ?></sd>
						<i class="<?php	echo $rowe['ico']; ?> text-success" style="font-size: 26px; color:<?php	echo $rowe['color']; ?>"></i>
						<i class="icon-ok-circled" style="font-size: 20px;color: #78cf50;margin: 7px 0 0 -10px;position: absolute;"></i>
						<input class="inpZ" name="r_left_<?php	echo $id;?>" id="r_left<?php echo $id;?>" value="<?php	echo $r_left;?>">
						<input class="inpZ" name="r_top_<?php	echo $id;?>" id="r_top<?php	echo $id;?>" value="<?php	echo $r_top;?>">
						</div>
						
						<script>$(function(){
						 <?php   if(isset($_GET['edit'])){  ?>
						$("#dra<?php echo $id;?>").draggable({stop: function(event, ui) {$('#r_left<?php echo $id;?>').val(ui.position.left);$('#r_top<?php echo $id;?>').val(ui.position.top);}});
						 <?php  } else{ ?>
						 document.getElementById('dra<?php	echo $id;?>').onmousedown = function(e){hidediver();$.ajax({type: 'POST',url: 's-response.php',data: 'value=<?php	echo $Mcommands; ?>'});}	
						  <?php  }  ?>
						});
						</script>
		<?php 
		}
		?>  
			


			
			


			
			
			
			
			
		<?php 
			$resulte = mysqli_query($con,"SELECT * FROM scheduler WHERE id_user = '$G_id_user' AND type=10");	
			while($rowe = mysqli_fetch_assoc($resulte)) {
				$namaddres = $rowe['name'];
				
			$nname = mysqli_query($con,"SELECT * FROM namedev WHERE address = '$namaddres'");
			while($rownname = mysqli_fetch_assoc($nname)) 	{ $Tname = $rownname['name'];}
				
			$drivers= $rowe['drivers'];	$rtype = mysqli_query($con,"SELECT * FROM type WHERE id_user = '$G_id_user' AND id in ($drivers) ");
			while($rowr = mysqli_fetch_assoc($rtype)) 
				{
			$id=$rowr['id']."H".$rowe['id'];
			$modeadr=$rowr['mode'];
			$symbol=$rowr['symbol'];
			$r_left_polles="tr_left_".$id; 
			$r_left_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$r_left_polles'");
			$r_left_row=mysqli_fetch_array($r_left_result);	
			$r_left=$r_left_row['coor'];
			$r_top_polles="tr_top_".$id; 
			$r_top_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$r_top_polles'");
			$r_top_row=mysqli_fetch_array($r_top_result);
			$r_top=$r_top_row['coor'];
			
			$cols=null;$pocaz = mysqli_query($con,"SELECT * FROM developments WHERE address = '$namaddres' AND mode = '$modeadr' ORDER BY id DESC LIMIT 1");
			while($rowpocaz = mysqli_fetch_assoc($pocaz)) 	{ $cols++; $datcic = $rowpocaz['vale'];}
			if($cols!=NULL){
			?> 
	





<?php

$C_mode = $rowr['mode'];
//-------------------------------- за неделю ---------------------------------
$datetimein=time()-604800;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT AVG(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_zna_sr=round($C_a['vale'], 1);

$datetimein=time()-604800;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MIN(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_zna_min=round($C_a['vale'], 1);

$datetimein=time()-604800;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_zna_max=round($C_a['vale'], 1);
//-------------------------------- за неделю ---------------------------------

//-------------------------------- за месяц ---------------------------------
$datetimein=time()-2592000;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT AVG(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_sr=round($C_a['vale'], 1);

$datetimein=time()-2592000;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MIN(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_min=round($C_a['vale'], 1);

$datetimein=time()-2592000;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_max=round($C_a['vale'], 1);
//-------------------------------- за месяц ---------------------------------

?>	

<script type="text/javascript">
					$(function() {
						
				//	var d = [[0, 3], [4, 8], [8, 5], [9, 13]];
				//	var options = {grid:   {borderWidth:1,borderColor:"#EBEBEB",}	};	$.plot("#ph<?php	echo $id;?>", [ d ],options);	
					
					 var options = {xaxis: { mode: "time", timezone: "browser"},grid:   {borderWidth:1,borderColor:"#EBEBEB",}	};
 var dd2 = [
<?php
$per=0;
$datetimein=time()-864000;
$datetimeout=time();
	
$res9 = mysqli_query($con,"SELECT * FROM `developments` WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout' "); 
if($res9){ 	while($row9 = mysqli_fetch_assoc($res9)){
	$utime7=$row9['unixtime'];
	$vale79=$row9['vale'];
	if($per==0){$per=$vale79;} else {$per=$per*0.9+$vale79*0.1;}
	$utime7=$utime7."000";
	echo "[".$utime7.",".$per."],";
}}

?>
];

 $.plot($("#ph<?php	echo $id;?>"), [  dd2 ],options);
					
					});
</script>
	

<script type="text/javascript">
function widdiv<?php	echo $id;?>(){
if(document.getElementById('chart<?php	echo $id;?>').style.display=="block"){
document.getElementById('chart<?php	echo $id;?>').style.display="none";
document.getElementById('ph<?php	echo $id;?>').style.display="none";
document.getElementById('draa<?php	echo $id;?>').style.zIndex ="1";
} else {
document.getElementById('chart<?php	echo $id;?>').style.display="block";
document.getElementById('ph<?php	echo $id;?>').style.display="block";
document.getElementById('draa<?php	echo $id;?>').style.zIndex ="9";
}
}
</script>
		
<div onmousedown="widdiv<?php	echo $id;?>()" class="Dra" id="draa<?php	echo $id;?>" style="background: rgba(255, 255, 255, 0.81);border: 1px solid <?php	echo $rowr['color']; ?>;position: relative; left: <?php	echo $r_left;?>px; top: <?php	echo $r_top;?>px;">
	
	
	
<div id="chart<?php	echo $id;?>" style="display:none;">
	
	
	<sd class="polezn" style="margin:  4px 0px 0px 60px;">
за неделю  <gcol>мин</gcol>/<scol>сред</scol>/<rcol>макс</rcol>: <gcol><?php	echo $C_zna_min; ?></gcol>/<scol><?php	echo $C_zna_sr; ?></scol>/<rcol><?php	echo $C_zna_max."</rcol> ".$symbol; ?>
	</sd>
	
	<sd class="polezn"  style="margin:  36px 0px 0px 60px;">
за месяц  <gcol>мин</gcol>/<scol>сред</scol>/<rcol>макс</rcol>: <gcol><?php	echo $C_zna_min; ?></gcol>/<scol><?php	echo $C_zna_sr; ?></scol>/<rcol><?php	echo $C_zna_max."</rcol> ".$symbol; ?>
	</sd>
	
		
	<div class="chartsM">
	
		
			
		<div id="ph<?php	echo $id;?>" style="width:255px;height:90px;margin-top: 60px;"></div>
	</div>

</div>
	
	
	
						<i class="<?php	echo $rowr['ico']; ?> text-success" style="position: relative;font-size: 22px; color:<?php	echo $rowr['color']; ?>"></i><br>
						<sd style="margin: -21px 0px 0px 29px;position: absolute;font-size: 10px;"><?php	echo $rowr['mode']; ?></sd>
						<sd style="font-size: 6.4px;margin: 23px 0px 0px 1px;position: absolute;"><?php	echo $rowe['name']; ?></sd>
						<sd style="font-size: 12px;margin: -2px 0px 0px 2px;position: absolute;"><?php	echo $datcic." ".$symbol; ?></sd>
						
						<sd style="font-size: 7px;margin: 14px 0px 0px 1px;position: absolute;"><?php	echo  $Tname; ?></sd>
						
						<input class="inpZ" name="tr_left_<?php	echo $id;?>" id="r_left<?php echo $id;?>" value="<?php	echo $r_left;?>">
						<input class="inpZ" name="tr_top_<?php	echo $id;?>" id="r_top<?php	echo $id;?>" value="<?php	echo $r_top;?>">
						</div>
			<?php }	?> 			
			<script>$(function(){
			<?php   if(isset($_GET['edit'])){  ?>
			$("#draa<?php echo $id;?>").draggable({stop: function(event, ui) {$('#r_left<?php echo $id;?>').val(ui.position.left);$('#r_top<?php echo $id;?>').val(ui.position.top);}});
			<?php  } else{ ?>	  <?php  }  ?>
			});</script>
		<?php 
		}	}
		?>  




			
</div>	
</form>
<script type="text/javascript">

$(function(){
	
 if(window.innerWidth<680) {
document.getElementById("key1").style.display="none";
document.getElementById("key2").style.display="none";
document.getElementById("key3").style.display="none";
document.getElementById("key4").style.display="none";
document.getElementById("key5").style.display="none";
  }
	else
	{
	document.getElementById("key1").style.display="block";
document.getElementById("key2").style.display="block";
document.getElementById("key3").style.display="block";
document.getElementById("key4").style.display="block";
document.getElementById("key5").style.display="block";
	} 

  });



function butt_rt(){
 if(window.innerWidth<680) {	
	
if(document.getElementById("key2").style.display=="block"){
document.getElementById("key1").style.display="none";
document.getElementById("key2").style.display="none";
document.getElementById("key3").style.display="none";
document.getElementById("key4").style.display="none";
document.getElementById("key5").style.display="none";
} else {
	document.getElementById("key1").style.display="block";
document.getElementById("key2").style.display="block";
document.getElementById("key3").style.display="block";
document.getElementById("key4").style.display="block";
document.getElementById("key5").style.display="block";
}
 }
}
 </script>			
<script>
$(function() {
    $('#nav button').on('click', function() {
        var scale  = parseInt($('#img').css('font-size'),10);
            nScale = $(this).index()===0 ? scale+1 : scale-1;
        $('#img').stop(true,true).animate({  fontSize: nScale }, {
            step: function(now,fx) {
                $(this).css('transform','scale('+parseFloat(now/10)+')');
            },
            duration: 100
        },'linear');
   });     
});
</script>	

<script>
function send() {
var data = $(':text').map(function(i, el){   return $(el).attr("name")+'='+$(el).attr("value")+'=<?php	echo $G_id_user;?>';}).get();
$.ajax({ type: "POST", url: "SendData.php", data: "data="+data });
alert('Положение изменено на: '+data); 
}
</script>				