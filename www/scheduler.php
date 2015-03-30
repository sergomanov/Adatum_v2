<?php	
 include 's-head.php';
 include 'adatum.class.php';
$errors=NULL;if($G_id_user==2){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Изменения данных в демо режиме запрещенны !";}
  
if (isset($_POST['chbox'])) 
	{ 
	$viscal = $_POST['state']; 
	if($viscal==0 ){$viscal=1;}else{$viscal=0;}
	mysqli_query($con,"UPDATE data SET state='$viscal'  WHERE id = 1"); 
	header("Location: scheduler.php");
	}	
		

if (isset($_POST['del'])) {
	$box_array = $_REQUEST['box']; 
	if($box_array==NULL){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Для удаления необходимо выбрать хотябы одну запись!";}
	foreach($box_array as $key => $value) {
		mysqli_query($con,"DELETE FROM scheduler WHERE id='$value'"); 	
		header("Location: scheduler.php");
		}
	}




if (isset($_POST['deactpr'])) {
		$box_array = $_REQUEST['box']; foreach($box_array as $key => $value){
		mysqli_query($con,"UPDATE scheduler SET switch='0'  WHERE id = '$value'");
		header("Location: scheduler.php");
		}
	}
	
	
if (isset($_POST['actpr'])) {
	$box_array = $_REQUEST['box']; foreach($box_array as $key => $value) {
		 mysqli_query($con,"UPDATE scheduler SET switch='1'  WHERE id = '$value'");
		 header("Location: scheduler.php");
		}
	}




if (isset($_POST['save'])) {
 $weekdays="";
 $monthdays ="";
 $month="";
 $conditions="";
 $commands="";
 $name = $_POST['name'];
 $type = $_POST['type'];
 $time = $_POST['time'];
 $timer = $_POST['timer'];
 $timein = $_POST['timein'];
 $timeout = $_POST['timeout'];
 $datein = $_POST['datein'];
 $dateout = $_POST['dateout'];
 

 
if($datein!=NULL){
  $arr_date=explode("-",$datein); $arr_min=explode(":",$timein); 
$datetime_in=mktime($arr_min[0],$arr_min[1],$arr_min[2],$arr_date[1],$arr_date[2],$arr_date[0]);
} else $datetime_in="";



if($dateout!=NULL){
$arr_date=explode("-",$dateout); $arr_min=explode(":",$timeout); 
$datetime_out=mktime($arr_min[0],$arr_min[1],$arr_min[2],$arr_date[1],$arr_date[2],$arr_date[0]);
} else $datetime_out="";
 
 if(isset($_POST['weekdays'])){$Zweekdays = array_unique($_POST['weekdays']); $weekdaysc=""; foreach ($Zweekdays as $weekdaysb)   {  $weekdaysa=$weekdaysb.",";  $weekdaysc .= $weekdaysa;  } $weekdays = substr($weekdaysc, 0, strlen($weekdaysc)-1); }
 if(isset($_POST['monthdays'])){$Zmonthdays = array_unique($_POST['monthdays']); $monthdaysc=""; foreach ($Zmonthdays as $monthdaysb)   {  $monthdaysa=$monthdaysb.",";  $monthdaysc .= $monthdaysa;  } $monthdays = substr($monthdaysc, 0, strlen($monthdaysc)-1); }
 if(isset($_POST['month'])){$Zmonth = array_unique($_POST['month']); $monthc=""; foreach ($Zmonth as $monthb)   {  $montha=$monthb.",";  $monthc .= $montha;  } $month = substr($monthc, 0, strlen($monthc)-1); }
 if(isset($_POST['conditions'])){$Zconditions = array_unique($_POST['conditions']); $conditionsc=""; foreach ($Zconditions as $conditionsb)   {  $conditionsa=$conditionsb.",";  $conditionsc .= $conditionsa;  } $conditions = substr($conditionsc, 0, strlen($conditionsc)-1); }
 if(isset($_POST['commands'])){$Zcommands = array_unique($_POST['commands']); $commandsc=""; foreach ($Zcommands as $commandsb)   {  $commandsa=$commandsb.",";  $commandsc .= $commandsa;  } $commands = substr($commandsc, 0, strlen($commandsc)-1); }
	
 if($type == '1')  {   $time = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '2')  {  $timer = '';  $timeout = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '4')  {   $time = ''; $timer = ''; $weekdays =''; $monthdays = ''; $month=''; };
 if($type == '5')  {   $timer = '';  $timein = ''; $timeout = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '6')  {   $timer = '';  $timein = ''; $timeout = ''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '7')  {  $timer = '';  $timein = ''; $timeout = ''; $weekdays =''; $month=''; $conditions =''; };
 if($type == '8')  {   $timer = '';  $timein = ''; $timeout = ''; $weekdays =''; $conditions =''; };
 
 
 
 
$idt=0; $rtype = mysqli_query($con,"SELECT * FROM scheduler WHERE name='$name'");
while($rowr = mysqli_fetch_assoc($rtype)) {$idt++;}
if($idt!=0){$errors="<i class='icon-warning-1 lock-tab'></i>&emsp;&emsp;Задание с таким именем уже есть в базе !";} 
 
 
 
 
if($errors==NULL){
mysqli_query($con,"INSERT INTO scheduler (name, switch, type, time, weekdays, monthdays,month,timer,timein,timeout,conditions,commands,id_user)
 VALUES ('$name','0','$type','$time','$weekdays','$monthdays','$month','$timer','$datetime_in','$datetime_out','$conditions','$commands','$G_id_user')");
header("Location: scheduler.php");
}
}




if (isset($_POST['edit'])) {
 $id = $_POST['id'];
 $name = $_POST['name'];
 $type = $_POST['type'];
 $time = $_POST['time'];
 $timer = $_POST['timer'];
 $timein = $_POST['timein'];
 $timeout = $_POST['timeout'];
 $datein = $_POST['datein'];
 $dateout = $_POST['dateout'];

  if(isset($_POST['weekdays'])){ $Zweekdays = array_unique($_POST['weekdays']); $weekdaysc=""; foreach ($Zweekdays as $weekdaysb)   {  $weekdaysa=$weekdaysb.",";  $weekdaysc .= $weekdaysa;  } $weekdays = substr($weekdaysc, 0, strlen($weekdaysc)-1); }
  if(isset($_POST['monthdays'])){$Zmonthdays = array_unique($_POST['monthdays']); $monthdaysc="";foreach ($Zmonthdays as $monthdaysb)   {  $monthdaysa=$monthdaysb.",";  $monthdaysc .= $monthdaysa;  } $monthdays = substr($monthdaysc, 0, strlen($monthdaysc)-1); }
  if(isset($_POST['month'])){ $Zmonth = array_unique($_POST['month']); $monthc=""; foreach ($Zmonth as $monthb)   {  $montha=$monthb.",";  $monthc .= $montha;  } $month = substr($monthc, 0, strlen($monthc)-1); }
  if(isset($_POST['conditions'])){  $Zconditions = array_unique($_POST['conditions']); $conditionsc=""; foreach ($Zconditions as $conditionsb)   {  $conditionsa=$conditionsb.",";  $conditionsc .= $conditionsa;  } $conditions = substr($conditionsc, 0, strlen($conditionsc)-1); }
  if(isset($_POST['commands'])){  $Zcommands = array_unique($_POST['commands']);	$commandsc="";  foreach ($Zcommands as $commandsb)   	  { 	  $commandsa=$commandsb.","; 	  $commandsc .= $commandsa;  	  } $commands = substr($commandsc, 0, strlen($commandsc)-1);   }

	if($datein!=NULL){
	  $arr_date=explode("-",$datein); $arr_min=explode(":",$timein); 
	$datetime_in=mktime($arr_min[0],$arr_min[1],$arr_min[2],$arr_date[1],$arr_date[2],$arr_date[0]);
	} else $datetime_in="";



	if($dateout!=NULL){
	$arr_date=explode("-",$dateout); $arr_min=explode(":",$timeout); 
	$datetime_out=mktime($arr_min[0],$arr_min[1],$arr_min[2],$arr_date[1],$arr_date[2],$arr_date[0]);
	} else $datetime_out="";

  
 if($type == '1')  {  $time = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '2')  {  $timer = ''; $timeout = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '4')  {   $time = ''; $timer = ''; $weekdays =''; $monthdays = ''; $month=''; };
 if($type == '5')  {   $timer = '';  $timein = ''; $timeout = ''; $weekdays =''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '6')  {   $timer = '';  $timein = ''; $timeout = ''; $monthdays = ''; $month=''; $conditions =''; };
 if($type == '7')  {  $timer = ''; $timein = ''; $timeout = ''; $weekdays =''; $month=''; $conditions =''; };
 if($type == '8')  {  $timer = '';  $timein = ''; $timeout = ''; $weekdays =''; $conditions =''; };
 
 if($errors==NULL){
	mysqli_query($con,"UPDATE scheduler SET  name='$name', type='$type',  time='$time', weekdays='$weekdays', monthdays='$monthdays',month='$month',timer='$timer',timein='$datetime_in',timeout='$datetime_out',conditions='$conditions',commands='$commands' WHERE id = '$id'");
	header("Location: scheduler.php");
 }
}

?>
<!DOCTYPE html>
<html>
<head><?php	 include 'head.php'; ?>	</head>
<body class="white">
<form name="myForm" method="post" >
	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

<div class="s2-map" id="map">


			
			<div class="jspPane" style="padding: 0px; top: 0px;">
			<div class="right-area-content -js-right-area-content">

	
	 
<div class="profile row">
<br>
    <h2 style="text-align:center; padding-bottom: 30px;"> Управление заданиями </h2>
	
<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>	

<input id="calwor" type="hidden" value="<?php echo trim($G_calendar);?>">

  <div id="calendar" style="<?php  if($G_calendar==0){echo "display: none;";}else{echo "display: block;";}  ?> ">
  
  
<?php
  // Вычисляем число дней в текущем месяце
  $isodate='1424390400';
  $dayofmonth = date('t',$isodate);

  // Счётчик для дней месяца
  $day_count = 1;

  // 1. Первая неделя
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    // Вычисляем номер дня недели для числа
    $dayofweek = date('w',
                      mktime(0, 0, 0, date('m'), $day_count, date('Y')));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
      // Если дни недели совпадают,
      // заполняем массив $week
      // числами месяца
      $week[$num][$i] = $day_count;      $day_count++;
    }
    else    {      $week[$num][$i] = "";    }
  }

  // 2. Последующие недели месяца
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      // Если достигли конца месяца - выходим     из цикла
      if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим    из цикла
    if($day_count > $dayofmonth) break;
  }

  // 3. Выводим содержимое массива $week  // в виде календаря  // Выводим таблицу
  echo "<table class='calendar'>";
   echo "<tr class='calendar-row'><td class='calendar-day-head'>Пн</td><td class='calendar-day-head'>Вт</td><td class='calendar-day-head'>Ср</td><td class='calendar-day-head'>Чт</td><td class='calendar-day-head'>Пт</td><td class='calendar-day-head'>Сб</td><td class='calendar-day-head'>Вс</td></tr>";
  for($i = 0; $i < count($week); $i++)
  {
    echo "<tr class='calendar-row'>";

    for($j = 0; $j < 7; $j++)
    {
			
      if(!empty($week[$i][$j]))
      {
		    if($j == 5 || $j == 6) {$color='red';} else {$color='';}
			$list_day= $week[$i][$j];
			$list_wek=date("w",$isodate);
			$list_mon=date("n",$isodate);
		
		?>  
		
         <td class='calendar-day'>
			
				<?php	
				$res999 = mysqli_query($con,"SELECT * FROM `scheduler`  WHERE id_user = '$G_id_user' AND (type='5' OR (type='6' AND FIND_IN_SET('$j', weekdays))  OR (type='7' AND FIND_IN_SET('$list_day', monthdays)) OR (type='8' AND FIND_IN_SET('$list_mon', month) AND FIND_IN_SET('$list_day', monthdays)))");
				if($res999){while($row999 = mysqli_fetch_assoc($res999)){
				if($row999['type']==1){$colortb="label-info ";}
				if($row999['type']==2){$colortb="label-warning";}
				if($row999['type']==4){$colortb="label-important";}
				if($row999['type']==5){$colortb="label-success";}
				if($row999['type']==6){$colortb="label-inverse";}
				if($row999['type']==7){$colortb="label-fol";}
				if($row999['type']==8){$colortb="label-no";}					
				?>  
			    <p><span onclick="getText<?php echo $row999['id'];?>(); " class="mycursor label <?php echo $colortb; ?>"><?php echo $row999['name']; ?></span></p> 
				<?php	 }}  ?>  		 
				<div class='day-number'><font color=<?php echo $color; ?>> <?php echo $week[$i][$j]; ?> </font></div>
		</td>
      
	<?php	
      }
      else echo "<td class='calendar-day'>&nbsp;</td>";
    }
    echo "</tr>";
  } 
  echo "</table>";
?>  
	</div>						 
				<br>
				
				         
			  
  
				 
	
	
    <div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						 <div class="grid simple" >
							<div class="grid-body no-border email-body" >
							
							 <div class="row-fluid" >
							
								
								
<div id="email-list">		


			<br>
			<input  type="hidden"  name="id" id="id" class="form-control"  placeholder="">

			
<div class="bfh-timepicker" name="vasia"></div>


  
   
<button value="<?php  if($G_calendar==0){echo "1";}else{echo "0";}  ?>" id="but_cal" onclick="openDiv('calendar');change();" type="button" class="btn btn-sm btn-small"  style="background: #85BBD5;  color: #34464D;" name="chbox" ><i class="icon-calendar-6"></i>
<?php  if($G_calendar==0){echo "Показать календарь";}else{echo "Скрыть календарь";}  ?> 
</button>
		
		
	<input  type="hidden"  name="state" id="state" class="form-control" value="<?php  $result= mysqli_query($con, "SELECT * FROM data WHERE id='1'"); $row=mysqli_fetch_array($result);echo $row['state'];  ?>">
						
			
			<p>Тип </p>
			<select id="type" class="form-control" name="type" onChange="javascript: go(this);" style="width:100%"> 
				<option value="0"></option> 
				<option value="1">По таймеру</option> 
				<option value="2">Один раз</option> 
				<option value="4">По сигналу</option>
				<option value="5">Ежедневно</option> 
				<option value="6">Еженедельно</option>
				<option value="7">Ежемесячно</option> 
				<option value="8">Ежегодно</option> 
			</select>
	  




		  <div id="i_name" style="display: none"> 
			<p>Наименование </p>
            <input id="name" name="name" type="text" class="form-control" placeholder="Наименование">
             </div> 	



			<div id="i_time" style="display: none">
			 <p>Время </p>
			<script type="text/javascript">				$(function(){	$('#time').timepicker({	timeFormat: 'HH:mm:ss',});});		</script>
			<input type="text" name="time" id="time" value="" />
				</div>
				
				
				<div id="i_weekdays" style="display: none">
                 <p>Дни недели </p>
                 <select name="weekdays[]" class="select2" id="weekdays" style="width:100%" multiple>
                    <option value="1">Пн</option>
                    <option value="2">Вт</option>
                    <option value="3">Ср</option>
					 <option value="4">Чт</option>
                    <option value="5">Пт</option>
                    <option value="6">Сб</option>
					 <option value="0">Вс</option>
             
                </select>
				</div>

				
				
				
				<div id="i_monthdays" style="display: none">
                  <p>Числа месяца </p>
                  <select name="monthdays[]" id="monthdays" class="select2" style="width:100%" multiple>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
				    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
				    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
				    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
				    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
                    <option value="30">30</option>
					<option value="31">31</option>
            </select>
			</div>
      


			
			<div id="i_month" style="display: none">	
            <p>Месяца</p>
            <select name="month[]" id="month" class="select2" style="width:100%" multiple>
                    <option value="1">Январь</option>
                    <option value="2">Февраль</option>
                    <option value="3">Март</option>
				    <option value="4">Апрель</option>
                    <option value="5">Май</option>
                    <option value="6">Июнь</option>
					<option value="7">Июнь</option>
					<option value="8">Август</option>
                    <option value="9">Сентябрь</option>
                    <option value="10">Октябрь</option>
				    <option value="11">Ноябрь</option>
                    <option value="12">Декабрь</option>
            </select>
           </div>
			
				<div id="i_timer" style="display: none">	
             <p>Таймер(секунды) </p>


<div class="input-group zol conteiner1" >
	<span class="input-group-addon btn dec"><i class="icon-minus"></i></span>
		<input type="text" class="form-control counter" value="1" name="timer" id="timer">
	<span class="input-group-addon btn inc"><i class="icon-plus"></i></span>
</div>

 </div>

				
	






<div id="i_datein" style="display: none">	
	<p>Начало</p>
	<script type="text/javascript">			$(function(){	$('#datein').datetimepicker({	altField: "#timein",timeFormat: 'HH:mm:ss',numberOfMonths: 1});});		</script>
	<div class="col-md-6" style="padding-left: 0px;"><input type="text" name="datein" id="datein" value="" style="width: 100%;" /></div>
	<div class="col-md-6" style="padding-left: 0px;"><input type="text" class="form-control" name="timein" id="timein" value="" style="width: 100%;" /></div>
	<br> 
</div>

			  
<div id="i_dateout" style="display: none">	
	<p>Окончание</p>
	<script type="text/javascript">			$(function(){	$('#dateout').datetimepicker({	altField: "#timeout",timeFormat: 'HH:mm:ss',numberOfMonths: 1,});});		</script>
	<div class="col-md-6" style="padding-left: 0px;"><input type="text" name="dateout" id="dateout" value="" style="width: 100%;" /></div>
	<div class="col-md-6" style="padding-left: 0px;"><input type="text" class="form-control" name="timeout" id="timeout" value="" style="width: 100%;"/></div>
</div>
				
				  
		

<div id="i_conditions" style="display: none">	
<p>Условия</p>
	<select multiple class="select2" id="conditions" name="conditions[]" style="width:100%">
	<?php    
	$rtype = mysqli_query($con,"SELECT * FROM type WHERE (id_user = '$G_id_user' OR id_user = '0') AND type in ('1','2','3','4') "); while($rowr = mysqli_fetch_assoc($rtype)) { $rowr = $rowr['mode'];
	$resulte = mysqli_query($con,"SELECT mode FROM commands WHERE  (id_user = '$G_id_user' OR id_user = '0') AND mode ='$rowr' GROUP BY mode "); while($rowe = mysqli_fetch_assoc($resulte)) { $moderow=$rowe['mode'];
	?> 
		<optgroup label="<?php $resultetype = mysqli_query($con,"SELECT name FROM type WHERE mode ='$moderow' GROUP BY type "); while($rowetype = mysqli_fetch_assoc($resultetype)) { echo $moderow." - ".$rowetype['name'];}?>">
			<?php $resultel = mysqli_query($con,"SELECT * FROM commands WHERE mode='$moderow' "); while($rowl = mysqli_fetch_assoc($resultel)) { ?> 
			<option value="<?php	echo $rowl['id']; ?>"><?php	echo $rowl['name']; ?>:<?php echo $rowl['address']; ?>#<?php echo $rowl['mode']; ?>#
			<?php if($rowl['cond']==1){?><b> (Больше >)</b><?php }  ?>
			<?php if($rowl['cond']==2){?><b> (Меньше <)</b> <?php }  ?>
			<?php echo $rowl['vale']; ?></option> 	
			<?php } ?> 
		</optgroup>
	<?php }} ?> 					
	</select>
</div>	
			
<div id="i_commands" style="display: none">	
<p>Комманды </p>
	<select multiple class="select2" id="commands" name="commands[]" style="width:100%">
	<?php    
	$rtype = mysqli_query($con,"SELECT * FROM type WHERE (id_user = '$G_id_user' OR id_user = '0') AND type in ('2','3','4') "); while($rowr = mysqli_fetch_assoc($rtype)) { $rowr = $rowr['mode'];
	$resulte = mysqli_query($con,"SELECT mode FROM commands WHERE (id_user = '$G_id_user' OR id_user = '0') AND mode ='$rowr' GROUP BY mode "); while($rowe = mysqli_fetch_assoc($resulte)) { $moderow=$rowe['mode'];
	?> 
		<optgroup label="<?php $resultetype = mysqli_query($con,"SELECT name FROM type WHERE mode ='$moderow' GROUP BY type "); while($rowetype = mysqli_fetch_assoc($resultetype)) { echo $moderow." - ".$rowetype['name'];}?>">
			<?php $resultel = mysqli_query($con,"SELECT * FROM commands WHERE mode='$moderow' "); while($rowl = mysqli_fetch_assoc($resultel)) { ?> 
			<option value="<?php	echo $rowl['id']; ?>"><?php	echo $rowl['name']; ?>:<?php echo $rowl['address']; ?>#<?php echo $rowl['mode']; ?>#<?php echo $rowl['vale']; ?></option> 	
			<?php } ?> 
		</optgroup>
	<?php }} ?> 					
	</select>
</div>	
				
			
<br>
			
<button type="submit" class="btn btn-sm btn-small btn-success " name="save" value="" ><i class="icon-plus"></i> Добавить</button>
<button type="submit" disabled="disabled" class="btn btn-sm btn-small btn-info  " name="edit" value="" ><i class="icon-edit"></i> Изменить</button>
<button type="button" disabled="disabled" onclick="clin()"  class="btn btn-sm btn-small  btn-white  " name="clinss" value="" >Очистить</button>

</div>	
</div>							
</div>
</div>	
</div>
</div>
</div>
	
	
	
<div class="mainInfo form-horizontal col-md-9" autocomplete="off">
      
       
<button disabled="disabled" id="del" onclick="return confirm('Вы действительно хотите удалить запись?')" type="submit" class="btn  btn-danger  btn-sm btn-small"  name="del"  title="Удалить правила"><i class=" icon-trash"></i>Удалить правила</button>
<button disabled="disabled" id="actpr" type="submit" class="btn  btn-primary  btn-sm btn-small"  name="actpr"  title="actpr"><i class=" icon-link"></i> Активировать правила</button>	
<button disabled="disabled" id="deactpr" type="submit" class="btn   btn-sm btn-small"  name="deactpr"  title="deactpr"><i class="icon-linkalt"></i> Деактивировать правила</button>		 
							 
	 
<section id="settings-notifications">
			   <table id="example2" class="example table table-striped table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
												<th data-class="expand">№</th>
												<th style="width: 30px;">  </th>
											    <th style="width: 30px;">  </th>
												<th data-class="expand">Наименование</th>
                                                <th data-hide="phone,tablet">Условия</th>
										        <th data-hide="phone,tablet">Комманды</th>
												<?php if($G_id_user==1){ ?> <th data-hide="tablet">Пользователь</th><?php } ?>	
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
	if($G_id_user==1){$IDDN = mysqli_query($con,"SELECT * FROM scheduler WHERE type IN ('1','2','4','5','6','7','8')");}
	else { $IDDN = mysqli_query($con,"SELECT * FROM scheduler WHERE type IN ('1','2','4','5','6','7','8') AND id_user = '$G_id_user'");}
	if($IDDN) { while($mIDDN= mysqli_fetch_assoc($IDDN)) {
	$timein=$mIDDN['timein'];  if($timein!=NULL){$timein=date('Y-m-d / H:i:s',$timein);}
	$timeout=$mIDDN['timeout'];  if($timeout){$timeout=date('Y-m-d / H:i:s',$timeout);}
	$M_id_user = $mIDDN['id_user'];
?>
			
<tr>

<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php	echo $mIDDN['id']; ?>
</td>
											
<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php 
	if($mIDDN['switch']==0) {  $colD="#EAE0E0";  } else {  $colD="#35C205";  }
	if($mIDDN['type']==1){?><i class="icon-clock-7 text-success" style="font-size: 20px; color: <?php echo $colD;?>;"></i><?php } ?>
	<?php if($mIDDN['type']==2){?><i class="icon-instapaper text-success" style="font-size: 20px; color:<?php echo $colD;?>;"></i><?php } ?>
	<?php if($mIDDN['type']==4){?><i class="icon-signal-1 text-success" style="font-size: 20px; color:<?php echo $colD;?>; "></i><?php } ?>
	<?php if($mIDDN['type']==5){?><i class=" icon-sort-numeric-outline text-success" style="font-size: 20px; color: <?php echo $colD;?>; "></i>	<?php } ?>
	<?php if($mIDDN['type']==6){?><i class="icon-header text-success" style="font-size: 20px; color:<?php echo $colD;?>; "></i>	 <?php } ?>
	<?php if($mIDDN['type']==7){?><i class=" icon-maxcdn text-success" style="font-size: 20px; color: <?php echo $colD;?>; "></i>  <?php } ?>
	<?php if($mIDDN['type']==8){?><i class="icon-calendar-7 text-success" style="font-size: 20px; color:<?php echo $colD;?>; "></i> 	<?php } ?>
</td>	
<td>
	<input id="chbox<?php	echo $mIDDN['id']; ?>" type="checkbox"  name='box[]' value=<?php	echo $mIDDN['id']; ?>>
</td>													
									
<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php echo $mIDDN['name']; ?>
</td>

<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;"> 
	<?php if($mIDDN['type']==1){echo "Выполняется По таймеру";} ?>
	<?php if($mIDDN['type']==2){echo "Выполняется Один раз";} ?>
	<?php if($mIDDN['type']==4){echo "Выполняется По сигналу";} ?>
	<?php if($mIDDN['type']==5){echo "Выполняется Ежедневно";} ?>
	<?php if($mIDDN['type']==6){echo "Выполняется Еженедельно";} ?>
	<?php if($mIDDN['type']==7){echo "Выполняется Ежемесячно";} ?>
	<?php if($mIDDN['type']==8){echo "Выполняется Ежегодно";} ?>
	<?php	if($mIDDN['time']!=NULL){echo " в: ".$mIDDN['time']."<br>";} ?>								
	<?php	 $array1=array(0,1,2,3,4,5,6);  $array2=array(" Вс"," Пн"," Вт"," Ср"," Чт"," Пт"," Сб");  
	if($mIDDN['weekdays']!=NULL){ echo "Дни недели: ".str_replace($array1,$array2,$mIDDN['weekdays'])."<br>";}	  ?>
	<?php  if($mIDDN['monthdays']!=NULL){echo "Числа: ".$mIDDN['monthdays']."<br>";} 	?>
	<?php	
	 $array1=array(1,2,3,4,5,6,7,8,9,10,11,12);  $array2=array(" Январь", " Февраль", " Март", " Апрель", " Май", " Июнь", " Июль", " Август", " Сентябрь", " Октябрь", " Декабрь"); 
	if($mIDDN['month']!=NULL){ echo "Месяца: ".str_replace($array1,$array2,$mIDDN['month'])."<br>";	 }
	 ?>
	<?php	if($mIDDN['timer']!=NULL){ echo " каждые: ".$mIDDN['timer']." секунд.<br>";} ?>
	<?php	if($mIDDN['conditions']!=NULL){ echo "при выполнении условий: ".$mIDDN['conditions'].".<br>";} ?>
	<?php	echo $timein; ?><br>
	<?php	echo $timeout; ?>
	
	<?php	if($mIDDN['timerun']!=0){ echo "<br><gcol>Выполнено: ". date("d,m,Y. H:i", $mIDDN['timerun']+$timezone).".</gcol><br>";} ?>
	<?php	if($mIDDN['timerun']==0){ echo "<br><scol>Не выполнялось.</scol><br>";} ?>
	
</td>
<td onclick="getText<?php echo $mIDDN['id'];?>(); " style="cursor: pointer;">
	<?php	$first = substr($mIDDN['commands'],0,15);  echo $first; if(strlen($mIDDN['commands'])>15){echo "...";}?>
</td>
										
<?php if($G_id_user==1){ ?> 
<td>
<?php	$rtype = mysqli_query($con,"SELECT * FROM users WHERE id_user='$M_id_user' "); while($rowr = mysqli_fetch_assoc($rtype)) {echo $rowr['login_user'];} ?>
</td>
<?php } ?>											  
	
<?php	
$Mdatein=$mIDDN['timein'];  if($Mdatein!=NULL){ $Sdatein = date("Y-m-d",$Mdatein); } else $Sdatein="";
$Mdateout=$mIDDN['timeout']; if($Mdateout!=NULL){   $Sdateout = date("Y-m-d",$Mdateout);    } else $Sdateout="";
$Mtimein=$mIDDN['timein']; if($Mtimein!=NULL){   $Stimein = date("H:i:s",$Mtimein);  } else $Stimein="";
$Mtimeout=$mIDDN['timeout']; if($Mtimeout!=NULL){   $Stimeout = date("H:i:s",$Mtimeout);    } else $Stimeout="";
 ?>
									
		<script type="text/javascript">
		function getText<?php echo $mIDDN['id'];?>(){
			
			document.getElementById('id').value = '<?php	echo $mIDDN['id']; ?>';
			document.getElementById('name').value = '<?php	echo $mIDDN['name']; ?>';
			document.getElementById('time').value = '<?php	echo $mIDDN['time']; ?>';
			document.getElementById('timein').value = '<?php	echo $Stimein; ?>';
			document.getElementById('timeout').value = '<?php	echo $Stimeout; ?>';
			document.getElementById('datein').value = '<?php	echo $Sdatein; ?>';
			document.getElementById('dateout').value = '<?php	echo $Sdateout; ?>';
			document.getElementById('timer').value = '<?php	echo $mIDDN['timer']; ?>';
			$("#weekdays").val([<?php	echo $mIDDN['weekdays']; ?>]).select2();
			$("#monthdays").val([<?php	echo $mIDDN['monthdays']; ?>]).select2();
			$("#month").val([<?php	echo $mIDDN['month']; ?>]).select2();
			$("#conditions").val([<?php	echo $mIDDN['conditions']; ?>]).select2();
  		    $("#commands").val([<?php	echo $mIDDN['commands']; ?>]).select2();
			document.myForm.edit.disabled = false;
			document.myForm.clinss.disabled = false;
			$('#type').val('<?php	echo $mIDDN['type']; ?>').change();
	
		}
	</script>
	

	
									  
</tr>						
<?php  }}	?>													
		  </tbody>
			</table>	

			
        </section>
	
    </div>
  
	
</div>




</div>
</div>
</div>
				
</div>

	</form>
	</body>
</html>

<script>
$('.conteiner1').IncrementBox({						
      timeout: 75,  //скорость инкримента
      cursor: false						
    });
</script>

<script type="text/javascript">
		function clin(){
			document.myForm.edit.disabled = true;
			document.myForm.clinss.disabled = true;
			$('#type').val('').change();
			document.getElementById('id').value = '';
			document.getElementById('name').value = '';
			document.getElementById('time').value = '';
			document.getElementById('timein').value = '';
			document.getElementById('timeout').value = '';
			document.getElementById('timer').value = '';
			$("#weekdays").val(['']).select2();
			$("#monthdays").val(['']).select2();
			$("#month").val(['']).select2();
			$("#conditions").val(['']).select2();
  		    $("#commands").val(['']).select2();
}
</script>
	
<script type="text/javascript">
function change()
{
if(document.getElementById('calwor').value=='1'){
document.getElementById('calwor').value='0';	
$.ajax({type: 'POST',url: 's-calviewfast.php',data: 'value=0'});
document.getElementById('but_cal').innerHTML='<i class="icon-calendar-6"></i> Скрыть календарь';
} else {
document.getElementById('calwor').value='1';
$.ajax({type: 'POST',url: 's-calviewfast.php',data: 'value=1'});
document.getElementById('but_cal').innerHTML='<i class="icon-calendar-6"></i> Показать календарь';
}

}
</script>

<script type="text/javascript">
 function go(i_page) 
  { 
    var val_i_page = i_page.value;

  if(val_i_page==0)
 {
 	document.getElementById('i_name').style.display="none";
	document.getElementById('i_time').style.display="none";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="none";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="none";
	document.getElementById('i_conditions').style.display="none";
	
	}
	
 if(val_i_page==1)
 {
 	document.getElementById('i_name').style.display="block";
	document.getElementById('i_time').style.display="none";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="block";
	document.getElementById('i_datein').style.display="block";
	document.getElementById('i_dateout').style.display="block";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}
	
if(val_i_page==2)
 {
 	document.getElementById('i_name').style.display="block";
	document.getElementById('i_time').style.display="none";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="block";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}
		

if(val_i_page==4)
 {
 	document.getElementById('i_name').style.display="block";
	document.getElementById('i_time').style.display="none";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="block";
	document.getElementById('i_dateout').style.display="block";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="block";
	
	}
//Ежедневно
if(val_i_page==5)
 {
 	document.getElementById('i_name').style.display="block";
	document.getElementById('i_time').style.display="block";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="none";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}
//Еженедельно
if(val_i_page==6)
 {
 	document.getElementById('i_name').style.display="block";
	document.getElementById('i_time').style.display="block";
	document.getElementById('i_weekdays').style.display="block";
	document.getElementById('i_monthdays').style.display="none";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="none";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}
	
//Ежемесячно
if(val_i_page==7)
 {
 
	document.getElementById('i_name').style.display="block";
  
	document.getElementById('i_time').style.display="block";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="block";
	document.getElementById('i_month').style.display="none";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="none";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}
	
//Ежегодно
if(val_i_page==8)
 {
 
	document.getElementById('i_name').style.display="block";
  
	document.getElementById('i_time').style.display="block";
	document.getElementById('i_weekdays').style.display="none";
	document.getElementById('i_monthdays').style.display="block";
	document.getElementById('i_month').style.display="block";
	document.getElementById('i_timer').style.display="none";
	document.getElementById('i_datein').style.display="none";
	document.getElementById('i_dateout').style.display="none";
	document.getElementById('i_commands').style.display="block";
	document.getElementById('i_conditions').style.display="none";
	
	}

  } 
</script> 

<script type="text/javascript">
var count = 0;
$(function() {  count = $('input[type=checkbox]:checked').length; displayCount();
 $('input[type=checkbox]').bind('click' , function(e, a) {if (this.checked) { count += a ? -1 : 1;} else { count += a ? 1 : -1;} displayCount();    });});
function displayCount() {
	if(count>0){
		document.getElementById('del').disabled = false;
		document.getElementById('actpr').disabled = false;
		document.getElementById('deactpr').disabled = false;
		}	
	if(count==0){
		document.getElementById('del').disabled = true;
		document.getElementById('actpr').disabled = true;
		document.getElementById('deactpr').disabled = true;
		}
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