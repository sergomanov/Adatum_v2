<?php	
include_once 'conf.php';
$auth = new auth();
$r='';
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

$form='
	 <form class="form -js-form -js-form-login"  method="post" style="display: block;">
	 <div class="form-input form-input-login">
		<input  placeholder="Логин"  type="text" name="login" id="" value="'.@$_POST['login'].'" /><br />
		</div>
		<div class="form-input form-input-login">
		 <input  placeholder="E-mail"  type="text" name="mail" value="'.@$_POST['mail'].'" /><br />
		</div>
		
			<div class="form-input form-input-login">
		<input type="submit" style="    width: 170px;
    background: #00aeef;  border: 1px solid #00aeef;  border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  height: 33px;" value="Восстановить" name="send" />
    		<a href="index.php" style="  padding: 7px; margin-left: 11px;;background-color: #ef7c00;
     border: 1px solid #00aeef;  font-size: 16px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  "> &nbsp;Вход&nbsp;</a>
		
		</div>
	</form>
';

if (isset($_POST['send'])) {
	if ($auth->recovery_pass($_POST['login'], $_POST['mail'])) {
		$r.='A new password has been sent to your inbox. <a href="/index.php">Login</a>';
	} else {
		$r.=$auth->error_reporting().$form;
	}
} else $r.=$form;

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












