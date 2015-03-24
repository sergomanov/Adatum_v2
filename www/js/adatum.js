$(document).ready(function() {
	document.getElementById('men').style.display="none";
	$(".select2").select2(); 
});

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


function openDiv(id){
var el=document.getElementById(id);
if(el.style.display=="block"){
el.style.display="none";
} else {
el.style.display="block";
}
}


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

   $(window).on('load', function () {
    var $preloader = $('#page-preloader'),   $spinner   = $preloader.find('.spinner');
    $spinner.fadeOut();
    $preloader.delay(100).fadeOut('slow');
});



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