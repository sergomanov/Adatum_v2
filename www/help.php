<?php	
 include 's-head.php';
 include 'adatum.class.php';
 ?>
<!DOCTYPE html>
<html>
	<head>	<?php	include 'head.php'; ?>	</head>
	
	<body class="white">

	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

		
<div class="s2-map " id="map">
		<div class="jspPane" style="padding: 0px; top: 0px;">
		<div class="right-area-content -js-right-area-content">
	


<tbody><tr>
<td>
<br>
<h2>Часто задаваемые вопросы</h2>



<table>
<tbody><tr>
		<td><div onclick="openDiv('div1');plumin('sym1');"  id="plusMinus1"><i id="sym1" style=" font-size: 20px;color: #7CC8EC;cursor: pointer;" class="icon-plus-squared"></i></div></td>   
		<td><span id="span1" onclick="openDiv('div1');plumin('sym1');" style="cursor: pointer;">Как передать показания</span></td>  
</tr></tbody>
</table>




<div class="infoBox" id="div1" style="display: none;">




      Передавать показания датчиков на online.adatum.ru можно посредством HTTP GET/POST.
	<br>  <br><h2><b>Данные, необходимые для передачи на online.adatum.</b></h2>

<div class="infoBox1">     MAC - Уникальный серийный номер устройства мониторинга   </div><br>
Предназначен для идентификации устройства в проекте и привязки к его владельцу. 
Состоит из 12-18 символов A-Z и 0-9 разделенных '-'. MAC адресс можно узнать выполнив командной строке
 getmac или ipconfig в Windows и ifconfig в Linux.
    <br>  <br>
<div class="infoBox1">     LAT, LNG, ELE - Широта, долгота, высота местоположения устройства мониторинга (не обязательно передавать)   </div><br>
Необязательные к передаче геокоординаты местоположения устройства мониторинга в десятичном виде. 
Может быть использовано для мобильных устройств мониторинга на базе смартфонов с GPS со встроенными или подключенными к ним датчиками.
  <br>  <br>
<div class="infoBox1">    name1..nameN - Уникальные наименования датчиков подключенных к устройству   </div><br>
Предназначены для идентификации датчиков и привязки их показаний к устр-ву мониторинга. 
 Для датчиков используются короткие названия например (TEM - Температура, HUM - Влажность, P - Давление).
 Имя должно быть на латинице без пробелов и знаков. Регистрация всех датчиков, подключенных к устр-ву, 
 происходит автоматически при первой отправке показаний на сервер, а их тип следует установить вручную в разделе Типы датчиков.
   <br>  <br>
<div class="infoBox1">   value1..valueN - Показания датчиков с точностью до сотых долей   </div><br>
Десятичное значение со знаком. Дробная часть отделяется точкой.
Пример показания: -13.54 или 760(для атм.давления).

  <br>  <br>
  
  	<br>  <br><h4><b>Протокол передачи HTTP POST/GET на URL http://online.adatum.ru/post.php</b></h4>

<div class="infoBox1">HTTP заголовки для POST</div>
<div style="margin: 10px;padding: 6px;background-color: #EBEBEB;">
<b>POST</b> http://online.adatum.ru/post.php?ID=74-69-69-2D-30-31&P=576.11<br>

</div>   

<div class="infoBox1">Пример передачи показаний HTTP POST на PHP с cURL</div>
<div style="margin: 10px;padding: 6px;background-color: #EBEBEB;">
$data = <scol>array</scol>('ID'=><gcol>'8A-11-5B-1F-FC-01'</gcol>, 'TMP'=><gcol>9.34</gcol>, 'HUM'=><gcol>67</gcol>, 'P'=><gcol>730.09</gcol>);<br>
$ch = <scol>curl_init</scol>("http://online.adatum.ru/post.php");<br>
<scol>curl_setopt</scol>($ch, CURLOPT_POST, <scol>true</scol>);<br>
<scol>curl_setopt</scol>($ch, CURLOPT_TIMEOUT, <gcol>5</gcol>);<br>
<scol>curl_setopt</scol>($ch, CURLOPT_RETURNTRANSFER, <gcol>1</gcol>);<br>
<scol>curl_setopt</scol>($ch, CURLOPT_POSTFIELDS, http_build_query($data));<br>
$reply = <scol>curl_exec</scol>($ch);<br>
<scol>curl_close</scol>($ch);<br>
</div>   

<div class="infoBox1">Пример передачи показаний HTTP POST на PHP без cURL</div>
<div style="margin: 10px;padding: 6px;background-color: #EBEBEB;">
$data = <scol>array</scol>('ID'=><gcol>'8A-11-5B-1F-FC-01'</gcol>, 'TMP'=><gcol>9.34</gcol>, 'HUM'=><gcol>67</gcol>, 'P'=><gcol>730.09</gcol>);<br>
$context = <scol>stream_context_create</scol>(array('http' =><scol> array</scol>('method'=>'POST','content' => <scol>http_build_query</scol>($data))));<br>
$fp = <scol>@fopen</scol>("http://online.adatum.ru/post.php", <gcol>'r'</gcol>, <scol>false</scol>, $context);<br>
if($fp) { <scol>fpassthru</scol>($fp); <scol>fclose</scol>($fp); }<br>
</div>
</div>  





<table>
<tbody><tr>
		<td><div onclick="openDiv('div2');plumin('sym2');"  id="plusMinus1"><i id="sym2" style=" font-size: 20px;color: #7CC8EC;cursor: pointer;" class="icon-plus-squared"></i></div></td>   
		<td><span id="span1" onclick="openDiv('div2');plumin('sym2');" style="cursor: pointer;">Что нового ?</span></td>  
</tr></tbody>
</table>




<div class="infoBox" id="div2" style="display: none;padding-left: 30px;">
<scol>6 Февраля 2015</scol> <br>
- Начата работа над версией 2,0.<br>

<br><scol>13 Февраля 2015</scol> <br>
- Переписан старый движок системы.<br>

<br><scol>19 марта 2015</scol> <br>
- Добавлено отображение диаграм на крате и в главном меню.<br>
- Исправлена ошибка неверного отображения даты на графиках.<br>
- Добавленно выбор за состоянием устройства в меню "Действия и условия".<br>

<br><scol>20 марта 2015</scol> <br>
- Переведены сообщения об ошибках при загрузке карты в файле upload_json.php библиотеки "KindEditor".<br>

<br><scol>23 марта 2015</scol> <br>
- Переделанна файл post.php теперь принемаются как GET так и POST запросы.<br>
- Переделанна история файл log.php теперь выводятся все события.<br>
- Изменен вывод графиков в главном меню и на карте теперь они строятся по 240 а в меню графики по 1000 средним точкам, что позволило снизить нагрузку на клиента.<br>

<br><scol>24 марта 2015</scol> <br>
- Исправлено отображение неизвестных датчиков на главной странице.<br>
- Исправлено скрытие и отображения календаря в планеровцике.<br>

<br><scol>31 марта 2015</scol> <br>
- Добавлен инсталлятор больше не нужно импортировать дамб mysql в ручную.<br>
- Полностью отказался от плагина jquery.datatables.<br>
- Переименованы некоторые файлы.<br>

<br><scol>1 апреля 2015</scol> <br>
- Изправленна ошибка с постоянной отправкой почты, теперь при срабатывании условия команда отправляется единожды. К примеру при повышении температуры отправляется email единожды, но если температура упала а потом сново превысила предел то ещё раз отправляется email<br>
- Исправленна ошибка с появлением дубликатов комманд в "планеровщике" и "УПРАВЛЕНИЕ ПАНЕЛЬЮ ЗАДАЧ".<br>


</div>  



 
<div class="clearfix"></div>

<br><br>

<h2>Служба поддержки</h2>

<div style="margin-left: 14px;">
    <div style="padding-bottom: 4px;"><i class="icon-email" style="font-size: 16px;color: #4386A0;"></i> &nbsp;<b>E-mail:</b> sergomanov@mail.ru<br></div>
    <div style="padding-bottom: 4px;"><i class="icon-vkontakte-rect" style="font-size: 16px;color: #7CC8EC;"></i> &nbsp;<b>Я ВКОНТАКТЕ:</b><a href="http://vk.com/sergomanov"> http://vk.com/sergomanov</a><br></div>
    <br>
    Я буду рад получить Ваши пожелания по работе системы "Открытая система автоматизации помещений".
</div>

</td>
</tr>

</tbody>
</div>   

		   
		   </div>
	
				</div>
				
		</div>


	</body>
</html>
<script type="text/javascript">
function plumin(id){
var el=document.getElementById(id);

if(el.className=="NaN icon-minus-squared"){
el.className -= " icon-minus-squared";
el.className += " icon-plus-squared";

} else {
el.className -= " icon-plus-squared";
el.className += " icon-minus-squared";
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
document.getElementById("pole").style.display="none";
document.getElementById("paddi").style.padding="0px";

document.getElementById("topmenu").style.display="none";
}};
</script>