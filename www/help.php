<?php	
 include 's-head.php';
 include 'adatum.class.php';
 ?>
<!DOCTYPE html>
<html>
	<head>
		<?php	


		include 'head.php'; ?>
	</head>
	
	<body class="white">

	   <div  class="s2-content" id="paddi" style="padding-top: 70px;">

				<?php	 include 'topmenu.php'; ?>
				<?php	 include 'smenu.php'; ?>	

		
<div class="s2-map " id="map">
		<div class="jspPane" style="padding: 0px; top: 0px;">
		<div class="right-area-content -js-right-area-content">
	

<table>
<tbody><tr>
<td>
<br>
<h2>Часто задаваемые вопросы</h2>

<table>
	<tbody><tr>   
		<td>
		<div onclick="openDiv('div1');plumin('sym1');"  id="plusMinus1">
		<i id="sym1" style=" font-size: 20px;color: #7CC8EC;cursor: pointer;" class="icon-plus-squared"></i>
		</div></td>   
		<td><span id="span1" onclick="openDiv('div1');plumin('sym1');" style="cursor: pointer;">Как передать показания</span></td>  
	</tr></tbody>
</table>

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


<div class="infoBox" id="div1" style="display: none;">




      Передавать показания датчиков на online.adatum.ru можно посредством HTTP GET/POST.
	<br>  <br><h2><b>Данные, необходимые для передачи на online.adatum.</b></h2>

<div class="infoBox1">     MAC - Уникальный серийный номер устройства мониторинга   </div>
Предназначен для идентификации устройства в проекте и привязки к его владельцу и к карте в разделе Мои датчики. 
Состоит из 12-18 символов A-Z и 0-9 иногда разделенных '-' или ':'. 
Для обеспечения уникальности рекомендуется использовать MAC-адрес сетевого интерфейса 
Вашего устр-ва мониторинга или компьютера, который можно узнать выполнив командной строке
 getmac или ipconfig в Windows и ifconfig в Linux.
 Допускается привязка нескольких устр-в с разными MAC к одному владельцу.
    <br>  <br>
<div class="infoBox1">     LAT, LNG, ELE - Широта, долгота, высота местоположения устройства мониторинга (не обязательно передавать)   </div>
Необязательные к передаче геокоординаты местоположения устройства мониторинга в десятичном виде. 
Передаются в TCP/UDP в 1й строке после NAME устр-ва и разделителя #, а в GET/POST передаются отдельными параметрами LAT, LNG, ELE.
 Может быть использовано для мобильных устройств мониторинга на базе смартфонов с GPS со встроенными или подключенными к ним датчиками.
  <br>  <br>
<div class="infoBox1">    mac1..macN - Уникальные серийные номера датчиков подключенных к устройству   </div>
Предназначены для идентификации датчиков в проекте и привязки их показаний к устр-ву мониторинга. 
Для популярных датчиков температуры семейства DS18 он представляет собой 16 знаков 0-F (с кодом семейства).
 Для датчиков, в которых нет собственных серийных номеров (к примеру аналоговых),
 можно использовать тип и номер по порядку (T1-T9, H1-H9, P1-P9, S1-S9)
 или имя датчика на латинице без пробелов и знаков. Регистрация всех датчиков, подключенных к устр-ву, 
 происходит автоматически при первой отправке показаний на сервер, а их тип следует установить вручную в разделе Мои датчики.
   <br>  <br>
<div class="infoBox1">   value1..valueN - Показания датчиков с точностью до сотых долей   </div>
Десятичное значение со знаком. Дробная часть отделяется точкой, хотя запятая тоже допускается.
 Пример показания: -13.54 или -13,54 или 760(для атм.давления).
Атмосферное давление следует передавать в мм рт.ст. или в Па, в последнем случае показания 
будут автоматически переведены в мм рт.ст. для отображения на карте.
Сетевой трафик SNMP можно передавать как в Мбит/сек (Mbps) так и накопительный итог в 
байтах(октетах) выбрав тип датчика трафик, Rx/Tx будет автоматически пересчитан в Mbps.
  <br>  <br>
  
  	<br>  <br><h2><b>Протокол передачи HTTP POST/GET на URL http://online.adatum.ru/post.php</b></h2>

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
<div class="clearfix"></div>

<br><br>

<h2>Служба поддержки</h2>

<div style="margin-left: 14px;">
    <div style="padding-bottom: 4px;"><i class="icon-email" style="font-size: 16px;color: #4386A0;"></i> &nbsp;<b>E-mail:</b>
        info@adatum.ru<br></div>

    <br>
    Я буду рад получить Ваши пожелания по работе системы "Умный дом".
</div>

</td>
</tr>

</tbody></table>
</div>   

		   
		   </div>
	
				</div>
				
		</div>


	</body>
</html>
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