<?php	
 include 's-head.php';
 include 'adatum.class.php';
 date_default_timezone_set('UTC');
 
  
 ?>
 	
	
<!DOCTYPE html>
<html>
	<head>
		<?php	 include 'head.php'; ?>
	</head>
	
	<body class="white">

	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

							
	

			
<div class="s2-map " id="map">

	

<div class="right-area5 -js-right-area Mscroll" style="display: block;  padding: 0px;  outline: none;" tabindex="0">
                
            <div class="jspContainer" >
			
			<div class="jspPane" style="padding: 0px; top: 0px;">
			<div class="right-area-content -js-right-area-content">

	
	 
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;"> Графики показаний</h2>

 				 
				<br>
				

  
				 
	
 <form name="myForm" method="GET" >
    <div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							
							 <div class="row-fluid" >
							
								
								

								
<div>	
			
<p>Датчик</p>
<select id="mode" class="form-control" name="mode"> 
	<?php $restype = mysqli_query($con,"SELECT * FROM `type`  WHERE type='1' AND id_user = '$G_id_user' ");if($restype){while($rowtype = mysqli_fetch_assoc($restype)){$rowmode=$rowtype['mode']; ?>
		<option <?php 	if($_GET['mode']==$rowtype['mode']){echo "selected";}?>
		value="<?php  echo $rowtype['mode'];?>"><?php  echo $rowtype['mode'];?> - <?php  echo $rowtype['name'];?>
		</option> 		 
	<?php }}  ?>
</select>	
			
<p>Номер устройства</p>
<select name="address[]" id="address" class="select2" style="width:100%" multiple>
	<?php $restype = mysqli_query($con,"SELECT * FROM `namedev` WHERE id_user = '$G_id_user' ");if($restype){while($rowtype = mysqli_fetch_assoc($restype)){$rowmode=$rowtype['mode']; ?>
		<option 
		<?php 
		foreach ($_GET['address'] as $daysb)   {  $daysa=",".$daysb.",";  $daysc .= $daysa;  } 
		$addr = substr($daysc, 0, strlen($daysc)-1);
		if(strpos($addr,  $rowtype['address'])!=NULL){echo "selected";}		
		?> value="<?php  echo $rowtype['address'];?>"><?php  echo $rowtype['address'];?> - <?php  echo $rowtype['name'];?>
		</option> 		 
	<?php }}  ?> 
</select>
			

		
		
<p>Начало</p>
<script type="text/javascript">			$(function(){	$('#datein').datetimepicker({	altField: "#timein",timeFormat: 'HH:mm:ss',numberOfMonths: 1});});		</script>
<input type="text" name="datein" id="datein" value="<?php 	if($_GET['datein']){echo $_GET['datein'];}?>" style="width:100%" />
<input type="text" class="form-control" name="timein" id="timein" value="<?php 	if($_GET['timein']){echo $_GET['timein'];}?>" style="width:100%;margin-top: 4px;" />

			  
				
<p>Завершение</p>
<script type="text/javascript">			$(function(){	$('#dateout').datetimepicker({	altField: "#timeout",timeFormat: 'HH:mm:ss',numberOfMonths: 1,});});		</script>
<input type="text" name="dateout" id="dateout" value="<?php 	if($_GET['dateout']){echo $_GET['dateout'];}?>" style="width:100%" />
<input type="text" class="form-control" name="timeout" id="timeout" value="<?php 	if($_GET['timeout']){echo $_GET['timeout'];}?>" style="width:100%;margin-top: 4px;" />
		
<br><br>

<button type="button" onclick="chText()" class="btn btn-sm btn-small btn-success" style="width: 97px;"> Один час</button>			
<button type="button" onclick="segText()" class="btn btn-sm btn-small btn-success" style="width: 97px;"> Сегодня</button>
<button type="button" onclick="vchText()" class="btn btn-sm btn-small btn-success" style="width: 97px;"> Вчера</button>
<button type="button" onclick="weText()" class="btn btn-sm btn-small btn-success" style="width: 97px;"> Эта неделя</button>
<button type="button" onclick="meText()" class="btn btn-sm btn-small btn-success"  style="width: 97px;"> Этот месяц</button>
<button type="button" onclick="yarText()" class="btn btn-sm btn-small btn-success"  style="width: 97px;"> Этот год</button>

<br><br>

<button type="submit" class="btn btn-sm btn-small btn-primary"><i class="icon-brush"></i> Отрисовать</button>
 </div>		
				
							 </div>							
							</div>
							</div>	
						</div>
					</div>
				</div>
	
	
	
    <div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
       

							 
	 
      
		        <section id="settings-notifications">
				
				
			   
			   <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							<br>
							 <div class="row-fluid" >
							 <div class="row-fluid dataTables_wrapper">

								<div class="pull-right margin-top-20">
									
								
									
									</div>
									<div class="clearfix"></div>
								</div>
								
	


	
<?php 
		if(isset($_GET['mode'])) {	$mode=$_GET['mode']; }
		if(isset($_GET['datein'])) {	$datein=$_GET['datein']; }
		if(isset($_GET['dateout'])) {	$dateout=$_GET['dateout']; }
		if(isset($_GET['timein'])) {	$timein=$_GET['timein']; }
		if(isset($_GET['timeout'])) {	$timeout=$_GET['timeout']; }
		if(isset($_GET['address'])) {	$address=$_GET['address']; }
		
		
	$datetimein=strtotime($_GET['datein'].$_GET['timein']);
	$datetimeout=strtotime($_GET['dateout'].$_GET['timeout']);
		
	//	echo $timereal."<br>";
	//	echo $datetimein."<br>";
	//	echo $datetimeout."<br>";

$modedat= mysqli_query($con, "SELECT * FROM type WHERE mode='$mode'"); $moderow=mysqli_fetch_array($modedat); $moderows = $moderow['name'];  $icorows = $moderow['ico']; $colorrows = $moderow['color']; $symbolrows = $moderow['symbol'];	
		
$typechartp= mysqli_query($con, "SELECT * FROM type WHERE mode='$mode'"); $typechart=mysqli_fetch_array($typechartp); $typecharts = $typechart['tchart'];  
	
?>

 	<script type="text/javascript">

	function checknull(i) {
var i;
if (i<10) 
i = "0"+i;
return i;
}
	
	
	 
$.fn.UseTooltip = function () {
    var previousPoint = null;
     
    $(this).bind("plothover", function (event, pos, item) {         
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
 
                $("#tooltip").remove();
                 
                var x = item.datapoint[0];
                var y = item.datapoint[1];     
				
var a = new Date(x-<?php echo $timezone*1000;?>);		

var day=a.getDate();
var month=a.getMonth() + 1;
var year=a.getFullYear(); 
var DayofWeek;
var UTCDay=a.getDay() + 1;
if(UTCDay==1) DayofWeek = "Воскресенье";
if(UTCDay==2) DayofWeek = "Понедельник";
if(UTCDay==3) DayofWeek = "Вторник";
if(UTCDay==4) DayofWeek = "Среда";
if(UTCDay==5) DayofWeek = "Четверг";
if(UTCDay==6) DayofWeek = "Пятница";
if(UTCDay==7) DayofWeek = "Суббота";
                 
showTooltip(item.pageX, item.pageY,
                 "<div  style='padding: 5px;color:<?php	echo $colorrows; ?>;'><i class='<?php	echo $icorows; ?>'></i> "+item.series.label  +  " <strong><br>" + "<?php echo $moderows; ?>"+" "+ y.toFixed(1) + " <?php echo $symbolrows; ?>" + "</strong><br>"+" "+ year +"-"+ checknull(month) +"-"+checknull(day)+" / "+checknull(a.getHours()) + ":" + checknull(a.getMinutes()) + ":" + checknull(a.getSeconds())+"<br>"+DayofWeek+"</div>");
			   
            }
        }
        else {
            $("#tooltip").remove();
            previousPoint = null;
        }
    });
};
 
function showTooltip(x, y, contents) {
    $('<div id="tooltip" style="z-index: 9999;">' + contents + '</div>').css({
        position: 'absolute',
        display: 'none',
        top: y + 15,
        left: x - 120,
	
		"background-color": "rgba(255, 238, 238, 0.89)",
		padding: "2px",
		
    }).appendTo("body").fadeIn(200);
}
	
	
	
	$(function() {
	
	
			<?php 	

	
	foreach ($address as $weekdaysb)   {  $weekdaysa="'".$weekdaysb."',";  $weekdaysc .= $weekdaysa;  } $address = substr($weekdaysc, 0, strlen($weekdaysc)-1); 
		
		$reschart = mysqli_query($con,"SELECT * FROM `namedev` WHERE address IN ($address)");	if($reschart) {   while($rowchart = mysqli_fetch_assoc($reschart)) 	 {
		$address=$rowchart['address'];
		$namess=$rowchart['name'];
		$commandsa='{ label: "'.$namess." - ".$address.'", data:  d'.$rowchart['id']." },";  
		
		
		$commandsc .= $commandsa;  
	


		?>	
	
	
	
	
	
	

		var d<?php echo $rowchart['id'];?> = [

		
				   <?php
$per=0;

$res9 = mysqli_query($con,"SELECT * FROM `developments` WHERE mode = '$mode' AND address = '$address'  AND unixtime >='$datetimein' AND unixtime <='$datetimeout' "); 
if($res9){ 	while($row9 = mysqli_fetch_assoc($res9)){


$utime7=$row9['unixtime'];



$vale79=$row9['vale'];

if($per==0){$per=$vale79;}
else {$per=$per*0.9+$vale79*0.1;}


$utime7=$utime7."000";
echo "[".$utime7.",".$per."],";

}}
?>	
		];
	
	<?php	 }}		$commands = substr($commandsc, 0, strlen($commandsc)-1);	?>	



		function weekendAreas(axes) {

			var markings = [],
			d = new Date(axes.xaxis.min);
			d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
			d.setUTCSeconds(0);
			d.setUTCMinutes(0);
			d.setUTCHours(0);

			var i = d.getTime();
			do {
				markings.push({ xaxis: { from: i, to: i + 2 * 24 *  60 * 1000 } });
				i += 7 * 24 * 60 * 60 *  1000;
			} while (i < axes.xaxis.max);

			return markings;
		}

		 var options = {
			<?php if($typecharts==1) {	echo "points: { show: true ,radius: 4 },	bars: {show: true, align: 'center', barWidth: 0.2},"; } ?>
			xaxis: {
				mode: "time",			
			},
			legend: {
			backgroundOpacity: 0.1,
			 margin: -10,
			show: true
			},
			yaxis: {
			},
			grid:   {
			markings: weekendAreas, 
			backgroundColor: { colors: [ "#fff", "#fff" ] },
			borderWidth:1,
			borderColor:"#f0f0f0",
			margin:1,
			minBorderMargin:0, 
			hoverable: true, 
			clickable: true
			}
			};
		
		$.plot("#placeholders", [<?php echo $commands;?>], options);
		window.onresize = function(event) { $.plot($("#placeholders"), [<?php echo $commands;?>],options);  }
    $("#placeholders").UseTooltip();
	 


	});
	
	</script>





				
			
           <div id="placeholders" style="width: 100%;	height: 450px;"></div>

			


			
			
			
			
			
			
			
			
			
			
			
			
								
						
							 </div>							
							</div>
							</div>	

			
        </section>
	
    </div>
  
	
</div>



</div>
</div>
</div>
</div>
				</div>
				
		</div>

	</form>
	</body>
</html>
<script type="text/javascript">

function checknull(i) {
var i;
if (i<10) 
i = "0"+i;
return i;
}
function chText(el){

var d=new Date();
var day=d.getDate();
var month=d.getMonth() + 1;
var year=d.getFullYear();
var m = new Date();

	document.getElementById('datein').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timein').value = checknull(m.getHours()-1) + ":" + checknull(m.getMinutes()) + ":" + checknull(m.getSeconds());

	
	document.getElementById('dateout').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timeout').value = checknull(m.getHours()) + ":" + checknull(m.getMinutes()) + ":" + checknull(m.getSeconds());

}

function segText(el){

var d=new Date();
var day=d.getDate();
var month=d.getMonth() + 1;
var year=d.getFullYear();
var m = new Date();

	document.getElementById('datein').value = year + "-" + checknull(month) + "-" + checknull(day);
	//document.getElementById('timein').value = m.getHours() + ":" + m.getMinutes() + ":" + m.getSeconds();
	document.getElementById('timein').value = "00:00:00";
	
	document.getElementById('dateout').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timeout').value = "24:59:59";

}

function vchText(el){

var d=new Date();
var day=d.getDate() -1;
var month=d.getMonth() + 1;
var year=d.getFullYear();
var m = new Date();

	document.getElementById('datein').value = year + "-" + checknull(month) + "-" + checknull(day);
	//document.getElementById('timein').value = m.getHours() + ":" + m.getMinutes() + ":" + m.getSeconds();
	document.getElementById('timein').value = "00:00:00";
	
	document.getElementById('dateout').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timeout').value = "24:59:59";

}

function weText(el){


 var d=parseInt(new Date().getTime()/1000);

  var a = new Date((d-604800)*1000);
 var year = a.getFullYear();
 var month = a.getMonth();
 var day = a.getDate();
 var time = year+'-'+checknull(month+1)+'-'+checknull(day) ;

 

 
 
	document.getElementById('datein').value = time;
	document.getElementById('timein').value = "00:00:00";



 var a = new Date(d*1000);
 var year = a.getFullYear();
 var month = a.getMonth();
 var day = a.getDate();
 var time = year+'-'+checknull(month+1)+'-'+checknull(day) ;



	
	document.getElementById('dateout').value = time;
	document.getElementById('timeout').value = "24:59:59";

}

function meText(el){

var d=new Date();
var day=d.getDate();
var month=d.getMonth() + 1;
var months=d.getMonth() ;
var year=d.getFullYear();
var m = new Date();

	document.getElementById('datein').value = year + "-" + checknull(months) + "-" + checknull(day);
	document.getElementById('timein').value = "00:00:00";
	
	document.getElementById('dateout').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timeout').value = "24:59:59";

}


function yarText(el){

var d=new Date();
var day=d.getDate();
var month=d.getMonth()+1 ;


var year=d.getFullYear();
var years=d.getFullYear()-1;
var m = new Date();

	document.getElementById('datein').value = years + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timein').value = "00:00:00";
	
	document.getElementById('dateout').value = year + "-" + checknull(month) + "-" + checknull(day);
	document.getElementById('timeout').value = "24:59:59";

}


	</script>
<script>
window.onload=function(){
if(window.innerWidth<680) {
document.getElementById("pole").style.width="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("topmenu").style.width="0px";
document.getElementById("paddi").style.padding="0px";

document.getElementById("pole").style.display="none";

document.getElementById("topmenu").style.display="none";
}};
</script>