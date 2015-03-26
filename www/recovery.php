<?php	
include_once 'conf.php';
$auth = new auth();
if ($auth->check()) {header("Location: main.php");} 
$r='';
 ?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.3">
      <title>Adatum</title>
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
      <meta name="description" content="Открытая система автоматизации помещений">
	  <link rel="stylesheet" href="css/fontello.css">
	  <link rel="stylesheet" type="text/css" media="all" href="css/googlefont.css" />
	   <link rel="stylesheet" href="css/login.css">
   </head>
   <body class="bg">
      <div id="cont" class="cont">
         <div id="top">
            <div id="logo">
              <a href="#" class="logo" style="margin: 24px 0 0 56px;  position: absolute;">
<i style="    font-size: 72px;    position: absolute;    color: #00ADFF;    font-style: normal;    font-weight: 900;    margin: 9px 0 0 14px;    z-index: 1;" class="icon-home-1"></i>	
<i style="    font-size: 57px;    position: absolute;    color: #FF0000;    font-style: normal;    font-weight: 900;    margin: 37px 0 0 47px;    z-index: 2;">T</i>
<i style="    font-size: 70px;    position: absolute;    color: #FFFFFF;    font-style: normal;    font-weight: 900;    margin: 30px 0 0 43px;    z-index: 1;">T</i>
<i style="    font-size: 92px;color: #fff;" class="icon-circle"></i>
	</a>
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
     border: 1px solid #00aeef;  font-size: 14px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  "> &nbsp;Вход&nbsp;</a>
		
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
<?php	include_once 'statistic'; ?>