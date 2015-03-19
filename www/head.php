<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-itunes-app" content="app-id=492074737">
<meta name="google-play-app" content="app-id=ru.starline">
<title>Adatum - системы контроля помещений</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">


<!--Openstat-->
<span id="openstat1"></span>
<script type="text/javascript">
var openstat = { counter: 1, next: openstat };
(function(d, t, p) {
var j = d.createElement(t); j.async = true; j.type = "text/javascript";
j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
})(document, "script", document.location.protocol);
</script>
<!--/Openstat-->

    
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/datatables.css">	
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link href="css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
<link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-formhelpers.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/fontello.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="./feditor/default.css" />
<link rel="stylesheet" href="css/animation.css">
<link rel="stylesheet" type="text/css" media="all" href="css/googlefont.css" />
<link rel="stylesheet" href="css/datatables.responsive.css"/>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/datatables.responsive.js"></script>
<script src="js/dom-bootstrap3.js"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="js/select2.full.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.time.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.flot.selection.js"></script>
<script language="javascript" type="text/javascript" src="js/ jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>
<script src="js/jquery-ui-timepicker-ru.js"></script>
<link href="css/select2.min.css" type="text/css" rel="stylesheet">
<link href="css/jquery-ui-timepicker-addon.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/style.css">

<script>
$(document).ready(function() {
	document.getElementById('men').style.display="none";
	$(".select2").select2(); 
});
</script>

<script type="text/javascript">
function Sdiv(id,tid,icond){
var el=document.getElementById(id);
var tel=document.getElementById(tid);

if(el.style.display=="block"){
el.style.display="none";
tel.className -= " active";
tel.className += " menu-item-link  cleafix";
document.getElementById(icond).className -= " icon-minus";
document.getElementById(icond).className += " icon-plus";

} else {
el.style.display="block";
tel.className += " active";
document.getElementById(icond).className -= " icon-plus";
document.getElementById(icond).className += " icon-minus";
}
}
</script>

<script type="text/javascript">
function TopenDiv(id,tim){
var el=document.getElementById(id);
var tel=document.getElementById(tim);
if(el.style.display=="block"){
el.style.display="none";
tel.style.display="block";
} else {
el.style.display="block";
tel.style.display="none";
}
}
</script>


<script type="text/javascript">
function openDiv(id){
var el=document.getElementById(id);
if(el.style.display=="block"){
el.style.display="none";
} else {
el.style.display="block";
}
}
</script>

<script type="text/javascript">
function hidepole(){
	 if(window.innerWidth<680) {
      document.getElementById("pole").style.width="0px";
	  document.getElementById("pole").style.display="none";
	  document.getElementById("map").style.left="0px";
    }
}

function viewdiv(){
if(document.getElementById("pole").style.width=="0px"){
document.getElementById("map").style.left="317px";
document.getElementById("keyshow").style.left="317px";
document.getElementById("topmenu").style.display="block";
document.getElementById("topmenu").style.width="317px";
document.getElementById("paddi").style.padding="70px 0 0 0";
document.getElementById("pole").style.display="block";
document.getElementById("pole").style.width="317px";

 if(window.innerWidth<680) {
	 document.getElementById("pole").style.width="100%";
	document.getElementById("topmenu").style.width="100%";
  }
	else
	{
	document.getElementById("pole").style.width="317px";
	document.getElementById("topmenu").style.width="317px";
	}

} else {
document.getElementById("pole").style.width="0px";
document.getElementById("pole").style.display="none";
document.getElementById("paddi").style.padding="0px";
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("topmenu").style.display="none";
document.getElementById("topmenu").style.width="0px";
}
}

</script>

<script>
function hidediver(){
//document.getElementById("spinner").style.display="block";
document.getElementById("page-preloader").style.display="block";
	
   $('#page-preloader').delay(200).fadeOut('slow');
//setTimeout(function(){ document.getElementById("page-preloader").style.display="none";},900);
}

$(function(){    $('.Dcolor').colorpicker();   });
	
	
	
$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: '<Пред',
	nextText: 'След>',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
	'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
	'Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'yy-mm-dd',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
</script>

 <script>
   $(window).on('load', function () {
    var $preloader = $('#page-preloader'),   $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.delay(100).fadeOut('slow');
});
 </script>
 
 <script>
jQuery(document).ready(function($) {
        $('#q-minus').click(function () {
            var $input = $(this).parent().find('input');
            var val = +$input[0].defaultValue;
            var count = parseInt($input.val()) - val;
            count = count < val ? val : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('#q-plus').click(function () {
            var $input = $(this).parent().find('input');
            var val = +$input[0].defaultValue;
            $input.val(parseInt($input.val()) + val);
            $input.change();
            return false;
        });
    });
</script>



<div id="page-preloader">
<i class="icon-spin6 animate-spin" style="  color: #fff;  font-size: 60px;   margin: -30px 0 0 -30px; position: absolute;  left: 50%;  top: 50%;"></i>
</div>

