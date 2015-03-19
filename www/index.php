<?php	
 include_once 'conf.php';
$r='';
$auth = new auth();

if ($auth->check()) {header("Location: main.php");} 


//~ authorization
if (isset($_POST['send'])) {
	if (!$auth->authorization()) {
		$error = $auth->error_reporting();
	} else {	header("Location: main.php");}
}

//~ user exit
if (isset($_GET['exit'])) $auth->exit_user();

 ?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.3">
      <title>Adatum</title>
      <link rel="stylesheet" href="css/login.css">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
      <meta name="description" content="Открытая система автоматизации помещений">

   </head>
   <body class="bg">
      <div id="cont" class="cont">
         <div id="top">
            <div id="logo">
               <div><a href="#"><img src="images/ico.png"></a></div>
               <div class="slogan">Доступная автоматизация</div>           
               <div id="short-about">Открытая система автоматизации помещений</div>
            </div>
<?php

//~ Check auth
if ($auth->check()) {
	$r.='Hello '.$_SESSION['login_user'];
} else {
	if (isset($error)) $r.=$error.'. <a href="recovery.php">recovery password</a><br/>';

	$r.='
	 <form class="form -js-form -js-form-login"  method="post" style="display: block;">
      
               <br>  <br>  <br>  <br>  <br>  <br>
			    <div class="form-input form-input-login">
		<div  class="inreg" onclick="location.href=\'join.php\'"  style="  padding: 7px; ;background-color: #ef7c00;
     border: 1px solid #00aeef;  font-size: 16px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  ">Регистрация</div>
 
		<div class="invos" onclick="location.href=\'recovery.php\'" style=" padding: 7px ; background-color: #a2c516;
     border: 1px solid #00aeef;  font-size: 16px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  ">Восстановление</div>
	 </div>
		 <div class="form-input form-input-login">
		 <input type="text" name="login" value="demo" />
		                </div>
						 <div class="form-input form-input-pass">
		 <input type="password" name="passwd" value="demo" id="" />
		 <input type="submit" value="Войти →" name="send" />
		 </div>
		  <div class="form-input form-input-checkbox"><input type="checkbox" name="remember" value="on" id="saveme"> <label for="saveme">Запомнить меня</label></div>

	</form>
	';
}

print $r;

?>

           <div class="footer"></div>
         </div>
         <div class="bottom-nav"></div>
        
      </div>
   </body>
</html>
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