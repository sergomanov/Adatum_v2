<div id="nav">
	<button class="roundbutton" id="key3" type="button" style="bottom: 70px;right: 5px;" value="+"><i class="icon-zoom-in-outline" style="font-size: 26px;"></i></button>
	<button class="roundbutton" id="key4" type="button" style="bottom: 12px;right: 5px;" value="-"><i class="icon-zoom-out-outline" style="font-size: 26px;"></i></button>
</div>

<a class="roundbutton" id="key1"  href="button.php"  style="bottom: 12px;left: 5px;" value="-"><i class="icon-cog" style="font-size: 26px;"></i></a>
<a class="roundbutton" id="key2" href="ymap.php"  style="bottom: 70px;left: 5px;" value="-"><i class="icon-globe-1" style="font-size: 26px;"></i></a>

<?php if(isset($_GET['edit'])){ ?>
<a href="main.php" id="key5" title="Закончить редактирование" onclick="send();"  class="s3-hide-panel" style="background-color: #ffa800!important;height: 60px;  padding: 15px 16px 17px;"><i class="icon-move-2"></i> </a>	
<?php } else { ?>	
<a href="main.php?edit=1" id="key5" title="Редактировать" class="s3-hide-panel" style="background-color: #ffa800!important;height: 60px !important;  padding: 15px 16px 17px !important;"><i class="icon-move-2"></i> </a>
<?php }  ?>

  
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
<script type="text/javascript">
function woldiv<?php	echo $id;?>(){
	<?php   if(!isset($_GET['edit'])){  ?>
		if(document.getElementById('butio<?php	echo $id;?>').style.display=="block"){
			document.getElementById('butio<?php	echo $id;?>').style.display="none";
			document.getElementById('butio<?php	echo $id;?>').style.zIndex ="1";
			document.getElementById('dra<?php	echo $id;?>').style.zIndex ="1";
		} else {
			document.getElementById('butio<?php	echo $id;?>').style.display="block";
			document.getElementById('butio<?php	echo $id;?>').style.zIndex ="3";
			document.getElementById('dra<?php	echo $id;?>').style.zIndex ="4";
		}
	<?php } ?>
}
</script>
				
<div onmousedown="woldiv<?php	echo $id;?>()" class="Dra" id="dra<?php	echo $id;?>" style="  z-index: 2; border: 4px double <?php	echo $rowe['color']; ?>; height: 55px !important; left: <?php	echo $r_left;?>px; top: <?php	echo $r_top;?>px;">

	
	<?php $con_R = $rowe['conditions'];	$re = mysqli_query($con,"SELECT * FROM `commands` WHERE id ='$con_R'"); $laststate_T=""; if($re) { while($row_rt = mysqli_fetch_assoc($re)){$laststate_T=$row_rt['laststate'];
	$unixtime_T=$row_rt['unixtime'];}	mysqli_free_result($re);} ?>				
	<sd style="font-size: 9px;margin: 33px 0px 0px 2px;position: absolute;"><?php	echo $rowe['name']; ?></sd>
	<i class="<?php	echo $rowe['ico']; ?> text-success" style="font-size: 26px; position: relative; color:<?php	echo $rowe['color']; ?>"></i>
	<?php	if($laststate_T==1 AND $rowe['conditions']!=NULL){ ?><i class="icon-ok-circled" style="font-size: 20px;color: #78cf50;margin: 7px 0 0 -12px;position: absolute;"></i><?php } ?>
	<?php	if($laststate_T==0 AND $rowe['conditions']!=NULL){ ?><i class="icon-cancel-circled" style="font-size: 20px;color: #2933E8;margin: 7px 0 0 -12px;position: absolute;"></i><?php } ?>
	<?php	if($rowe['conditions']==NULL AND $rowe['type']==3){ ?><i class="icon-dot-circled" style="font-size: 20px;color: #C8C6A5;margin: 7px 0 0 -12px;position: absolute;"></i><?php } ?>
	<input class="inpZ" name="r_left_<?php	echo $id;?>" id="r_left<?php echo $id;?>" value="<?php	echo $r_left;?>">
	<input class="inpZ" name="r_top_<?php	echo $id;?>" id="r_top<?php	echo $id;?>" value="<?php	echo $r_top;?>">
</div>
		

<div id="butio<?php	echo $id;?>" class="ButtM" style="display:none; position: absolute; border: 4px double #78cf50;left: <?php	echo $r_left;?>px; top: <?php	echo $r_top;?>px;">

<sd class="polezn" style="margin:  4px 0px 0px 60px;">Текущие состояние:
	<?php	if($laststate_T==1 AND $rowe['conditions']!=NULL){ ?><gcol>Включено</gcol><?php } ?>
	<?php	if($laststate_T==0 AND $rowe['conditions']!=NULL){ ?><scol>Отключено</scol><?php } ?>
	<?php	if($rowe['conditions']==NULL AND $rowe['type']==3){ ?><rcol>Нет контроля</rcol><?php } ?>
</sd>
	
<sd style="margin: 20px 0px 0px 66px;  position: absolute;  font-size: 10px; width: 195px;">
	<?php	if($laststate_T==1 AND $rowe['conditions']!=NULL){ ?><gcol>Включено</gcol><?php $unixtime_T = time() - $unixtime_T;$unixtime_T = format_uptime($unixtime_T);echo ": ".$unixtime_T." назад.";} ?>
	<?php	if($laststate_T==0 AND $rowe['conditions']!=NULL){ ?><scol>Отключено</scol><?php $unixtime_T = time() - $unixtime_T;$unixtime_T = format_uptime($unixtime_T);echo ": ".$unixtime_T." назад.";} ?>
</sd>



<div style="padding-top: 50px;color: #00AEEF;">

<?php $G_commands = mysqli_query($con,"SELECT * FROM `commands` WHERE editable!=0 AND FIND_IN_SET('$Mcommands', id)"); if($G_commands) {  while($G_commands_row = mysqli_fetch_assoc($G_commands)){
$editable=$G_commands_row['editable'];
$mode_po=$G_commands_row['mode']; 
$vale_po=$G_commands_row['vale'];
$colW=0;$arrval = explode(',',$vale_po);foreach($arrval as $itembval) {	$colW++;
	if($colW==1){$va_l1=$itembval;}
	if($colW==2){$va_l2=$itembval;}
	if($colW==3){$va_l3=$itembval;}
	}
?> 

<?php $L_commands = mysqli_query($con,"SELECT * FROM `type` WHERE mode='$mode_po'"); if($L_commands) {  while($L_commands_row = mysqli_fetch_assoc($L_commands)){ 
	$name1=$L_commands_row['namevalue1'];
	$name2=$L_commands_row['namevalue2'];
	$name3=$L_commands_row['namevalue3'];
	}}
		$arrb = explode(',',$editable);
		foreach($arrb as $itemb) { 
		if($itemb==1){$nameR=$name1;$va_l=$va_l1;}
		if($itemb==2){$nameR=$name2;$va_l=$va_l2;}
		if($itemb==3){$nameR=$name3;$va_l=$va_l3;}
?> 				 

	
<div class="commen"><?php	echo $G_commands_row['name']." - ".$nameR; ?></div>
<div class="input-group zol conteiner1" ><span class="input-group-addon btn dec"><i class="icon-minus"></i></span><input type="text" class="form-control counter" value="<?php	echo $va_l;?>" name="timer" id="timer"><span class="input-group-addon btn inc">
<i class="icon-plus"></i></span></div>
				
<?php }} mysqli_free_result($G_commands); }	?> 
	




	<button id="upda<?php	echo $id;?>" type="button" class="btn btn-sm btn-small btn-success " name="save" style="  margin: 6px 0px 3px 150px;" value=""><i class="icon-flash"></i> Выполнить</button>
</div>

</div>



















	<?php 
			$resulte = mysqli_query($con,"SELECT * FROM scheduler WHERE id_user = '$G_id_user' AND type=9");	
			while($rowe = mysqli_fetch_assoc($resulte)) {
			$eid=$rowe['id'];
	
			$er_left_polles="er_left_".$eid; 
			$r_left_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$er_left_polles'"); 
			$er_left_row=mysqli_fetch_array($r_left_result);	
			$er_left=$er_left_row['coor'];
			
			$er_top_polles="er_top_".$eid;
			$r_top_result= mysqli_query($con, "SELECT * FROM `coordinates` WHERE id_user = '$G_id_user' AND idn = '$er_top_polles'"); 
			$er_top_row=mysqli_fetch_array($r_top_result);
			$er_top=$er_top_row['coor'];
		?> 



<script type="text/javascript">
function woldiv<?php echo $eid;?>(){
	<?php   if(!isset($_GET['edit'])){  ?>
		if(document.getElementById('bu<?php echo $eid;?>').style.display=="block"){
			document.getElementById('bu<?php echo $eid;?>').style.display="none";
			document.getElementById('bu<?php echo $eid;?>').style.zIndex ="1";
			document.getElementById('draga<?php echo $eid;?>').style.zIndex ="1";
		} else {
			document.getElementById('bu<?php echo $eid;?>').style.display="block";
			document.getElementById('bu<?php echo $eid;?>').style.zIndex ="3";
			document.getElementById('draga<?php echo $eid;?>').style.zIndex ="4";
		}
	<?php } ?>
}
</script>

<?php
$host = "77.222.61.85"; //ваш сервер 
$connect = ftp_connect($host); 
$user = "letooru_ar"; //ваш логин 
$password = "12Admin12"; //ваш пароль 
$res = ftp_login($connect,$user,$password); 
$get_file = "DCS-931L.jpg"; //файл который нам нужен 
$save_file = "DCS-931L.jpg"; //имя под которым сохраняем 
ftp_get($connect,$get_file,$save_file,FTP_BINARY); //выполняем функцию ftp_get 
fclose($fp); 
?> 


			
<div onmousedown="woldiv<?php echo $eid;?>()" class="Dra" id="draga<?php echo $eid;?>" style="  z-index: 2;   border: 2px double #C7C7C7; height: 55px !important;left: <?php	echo $er_left;?>px; top: <?php	echo $er_top;?>px;">
<i class="  icon-camera text-success" style="font-size: 20px; color: #BD8836; ?> !important;"></i>
<sd style="margin: 8px 0px 0px 2px;;position: absolute;font-size: 10px;">FTP</sd>
<sd style="font-size: 9px;margin: 32px 0px 0px -26px;position: absolute;"><?php	echo $rowe['name']; ?></sd>
<input class="inpZ" name="er_left_<?php	echo $eid;?>" id="er_left<?php echo $eid;?>" value="<?php	echo $er_left;?>">
<input class="inpZ" name="er_top_<?php	echo $eid;?>" id="er_top<?php	echo $eid;?>" value="<?php	echo $er_top;?>">
</div>
		

<div id="bu<?php echo $eid;?>" class="ButtM" style="display:none; position: absolute;   border: 2px double #C7C7C7; margin: 0px;left: <?php	echo $er_left;?>px; top: <?php	echo $er_top;?>px;">
<i class="icon-resize-full-2" style="font-size: 35px;  margin: -2px 0px 0px 211px;  position: absolute;  color: #4386A0; "></i>
<i class="icon-arrows-cw-1" style="font-size: 35px;  margin: -2px 0px 0px 158px;  position: absolute;  color: #4386A0;"></i>

<div style="padding-top: 50px;color: #00AEEF;">
<img src="http://online.adatum.ru/DCS-931L.jpg"   width="100%" height="100%" alt="lorem">
</div>
</div>
<script>

$(function(){
<?php   if(isset($_GET['edit'])){  ?>$("#draga<?php echo $eid;?>").draggable({stop: function(event, ui) {$('#er_left<?php echo $eid;?>').val(ui.position.left);$('#er_top<?php echo $eid;?>').val(ui.position.top);}});<?php  } else{ ?>	  <?php  }  ?>
});
</script>

<?php }	?> 











































		
<script>$(function(){
<?php   if(isset($_GET['edit'])){  ?>
	$("#dra<?php echo $id;?>").draggable({stop: function(event, ui) {$('#r_left<?php echo $id;?>').val(ui.position.left);$('#r_top<?php echo $id;?>').val(ui.position.top);}});
<?php  } else{ ?>
	document.getElementById('upda<?php	echo $id;?>').onmousedown = function(e){hidediver();$.ajax({type: 'POST',url: 's-response.php',data: 'value=<?php	echo $Mcommands; ?>'});}	
	<?php  }  ?>
});
</script>
<?php }	?>  
			

			
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

$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MIN(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_zna_min=round($C_a['vale'], 1);

$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_zna_max=round($C_a['vale'], 1);
//-------------------------------- за неделю ---------------------------------

//-------------------------------- за месяц ---------------------------------
$datetimein=time()-2592000;
$datetimeout=time();
$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT AVG(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_sr=round($C_a['vale'], 1);

$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MIN(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_min=round($C_a['vale'], 1);

$C_a = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(vale) AS vale  FROM developments WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"));
$C_znam_max=round($C_a['vale'], 1);
//-------------------------------- за месяц ---------------------------------

?>	

<script type="text/javascript">
$(function() {
					
 var options = {xaxis: { mode: "time", timezone: "browser"},grid:   {borderWidth:1,borderColor:"#EBEBEB",}	};
 var dd2 = [
<?php
$per=0;
$datetimein=time()-864000;
$datetimeout=time();
if ($resultrt=mysqli_query($con,"SELECT * FROM `developments` WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout'"))  {  $rowcounttr=mysqli_num_rows($resultrt);  }

$res9 = mysqli_query($con,"SELECT * FROM `developments` WHERE mode = '$C_mode' AND address = '$namaddres'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout' "); 

if($rowcounttr<240){
if($res9){ 	while($row9 = mysqli_fetch_assoc($res9)){
	$utime7=$row9['unixtime'];
	$vale79=$row9['vale'];
	if($per==0){$per=$vale79;} else {$per=$per*0.9+$vale79*0.1;}
	$utime7=$utime7."000";
	echo "[".$utime7.",".$per."],";
}}
} else {
$coltecr=0;$col_per=ceil($rowcounttr/240);$gle=0;
if($res9){ 	while($row9 = mysqli_fetch_assoc($res9)){
	$coltecr++;
	$utime7=$row9['unixtime'];
	$utime7=$utime7."000";
	$vale79=$row9['vale'];
	$gle=$gle+$vale79;
   if($coltecr==$col_per){
	   if($per==0){$per=$gle;} else {$per=$per*0.9+$gle*0.1;}
	   echo "[".$utime7.",".$per/$coltecr."],"; $coltecr=0;$gle=0;
	   }
} echo "[".$utime7.",".$gle/$coltecr."],";}
}

?>
];

 $.plot($("#ph<?php	echo $id;?>"), [  dd2 ],options);
				
});
</script>
	

<script type="text/javascript">
function widdiv<?php	echo $id;?>(){
	<?php   if(!isset($_GET['edit'])){  ?>
if(document.getElementById('chart<?php	echo $id;?>').style.display=="block"){
document.getElementById('chart<?php	echo $id;?>').style.display="none";
document.getElementById('ph<?php	echo $id;?>').style.display="none";
document.getElementById('draa<?php	echo $id;?>').style.zIndex ="1";
} else {
document.getElementById('chart<?php	echo $id;?>').style.display="block";
document.getElementById('ph<?php	echo $id;?>').style.display="block";
document.getElementById('draa<?php	echo $id;?>').style.zIndex ="9";
}
	<?php  } ?>
}
</script>
		
<div onmousedown="widdiv<?php	echo $id;?>()" class="Dra" id="draa<?php	echo $id;?>" style="border: 1px solid <?php	echo $rowr['color']; ?>; left: <?php	echo $r_left;?>px; top: <?php	echo $r_top;?>px;">
	<div id="chart<?php	echo $id;?>" style="display:none;">
	<sd class="polezn" style="margin:  4px 0px 0px 60px;">за неделю  <gcol>мин</gcol>/<scol>сред</scol>/<rcol>макс</rcol>: <gcol><?php	echo $C_zna_min; ?></gcol>/<scol><?php	echo $C_zna_sr; ?></scol>/<rcol><?php	echo $C_zna_max."</rcol> ".$symbol; ?></sd>
	<sd class="polezn"  style="margin:  36px 0px 0px 60px;">за месяц  <gcol>мин</gcol>/<scol>сред</scol>/<rcol>макс</rcol>: <gcol><?php	echo $C_zna_min; ?></gcol>/<scol><?php	echo $C_zna_sr; ?></scol>/<rcol><?php	echo $C_zna_max."</rcol> ".$symbol; ?></sd>
	<div class="chartsM"><div id="ph<?php	echo $id;?>" style="width:255px;height:90px;margin-top: 60px;"></div></div>
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

<script>
$(function(){
<?php   if(isset($_GET['edit'])){  ?>$("#draa<?php echo $id;?>").draggable({stop: function(event, ui) {$('#r_left<?php echo $id;?>').val(ui.position.left);$('#r_top<?php echo $id;?>').val(ui.position.top);}});<?php  } else{ ?>	  <?php  }  ?>
});
</script>
<?php 	}	}	?>  		
</div>	
</form>


<script>
$('.conteiner1').IncrementBox({						
      timeout: 75,  //скорость инкримента
      cursor: false						
    });
</script>

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