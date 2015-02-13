		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-itunes-app" content="app-id=492074737">
        <meta name="google-play-app" content="app-id=ru.starline">
        <title>Adatum - системы контроля помещений</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">




    
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<style type="text/css">.Mscroll{height: 100%;overflow: auto;}</style>
<script src="js/jquery.nicescroll.min.js"></script>
<script>  $(document).ready(function() {$(".Mscroll").niceScroll({cursorborder:"",cursorcolor:"rgb(162, 162, 184)",boxzoom:false});   });</script>

	
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/datatables.css">	
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
 <link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/googlefont.css" />
	
    <link rel="stylesheet" href="css/datatables.responsive.css"/>
    <style>
        .title {
            font-size: larger;
            font-weight: bold;
        }

        .table th.centered-cell, .table td.centered-cell {
            text-align: center;
        }
    </style>
	

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<script src="js/datatables.responsive.js"></script>
<script src="js/dom-bootstrap3.js"></script>
     <script src="js/bootstrap-colorpicker.js"></script>
	<script type="text/javascript">

function Sdiv(id,tid){
	
var el=document.getElementById(id);
var tel=document.getElementById(tid);

if(el.style.display=="block"){
el.style.display="none";
tel.className = el.className.replace( /(?:^|\s)active(?!\S)/ , '' );
} else {
el.style.display="block";
tel.className += " active";
}
}
</script>


<script type="text/javascript">
<!--
function openDiv(id){
var el=document.getElementById(id);
if(el.style.display=="block"){
el.style.display="none";
} else {
el.style.display="block";
}
}
//-->
</script>

	<script type="text/javascript">
function hidepole()
{
	 if(window.innerWidth<680) {
      document.getElementById("pole").style.width="0px";
	  document.getElementById("pole").style.display="none";
	  document.getElementById("map").style.left="0px";
    }
}

function viewdiv()
{
if(document.getElementById("pole").style.width=="0px"){

document.getElementById("map").style.left="317px";
document.getElementById("keyshow").style.left="317px";
document.getElementById("topmenu").style.width="317px";
document.getElementById("boxscroll").style.display="block";
document.getElementById("topmenu").style.display="block";
document.getElementById("pole").style.display="block";
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
document.getElementById("map").style.left="0px";
document.getElementById("keyshow").style.left="0px";
document.getElementById("topmenu").style.width="0px";
document.getElementById("pole").style.display="none";
document.getElementById("boxscroll").style.display="none";
document.getElementById("topmenu").style.display="none";
}
}

</script>