<?php	
$error=NULL;
include_once "mysql";
$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
if (mysqli_connect_errno() ) { header("Location: install.php"); }


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
<a href="#" class="logo" style="bottom: 100px;  margin: 24px 0 0 56px; position: absolute;">
<i style="    font-size: 72px;    position: absolute;    color: #00ADFF;    font-style: normal;    font-weight: 900;    margin: 9px 0 0 14px;    z-index: 1;" class="icon-home-1"></i>	
<i style="    font-size: 57px;    position: absolute;    color: #FF0000;    font-style: normal;    font-weight: 900;    margin: 37px 0 0 47px;    z-index: 2;">T</i>
<i style="    font-size: 70px;    position: absolute;    color: #FFFFFF;    font-style: normal;    font-weight: 900;    margin: 30px 0 0 43px;    z-index: 1;">T</i>
<i style="    font-size: 92px;color: #fff;" class="icon-circle"></i>
	</a>
               <div class="slogan">Доступная автоматизация</div>           
               <div id="short-about">Открытая система автоматизации помещений</div>
            </div>
			  	<?php	if($error!=NULL){ echo '<div class="alert alert-warning">'.$error.'</div>';} ?>	
			
<?php

//~ Check auth
if ($auth->check()) {
	//$r.='Hello '.$_SESSION['login_user'];
} else {
	//if (isset($error)) $r.=$error.'. <a href="recovery.php">recovery password</a><br/>';

	$r.='
	 <form class="form -js-form -js-form-login"  method="post" style="display: block;">
      
               <br>  <br>  <br>  <br>  <br>  <br>
			    <div class="form-input form-input-login">
		<div  class="inreg" onclick="location.href=\'join.php\'"  style="  padding: 7px; ;background-color: #ef7c00;
     border: 1px solid #00aeef;  font-size: 14px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  ">Регистрация</div>
 
		<div class="invos" onclick="location.href=\'recovery.php\'" style=" padding: 7px ; background-color: #a2c516;
     border: 1px solid #00aeef;  font-size: 14px;border-radius: 1px;  box-shadow: none;  color: #fff;  cursor: pointer;  ">Восстановление</div>
	 </div>
		 <div class="form-input form-input-login">
		 <input type="text" name="login" value="demo" />
		                </div>
						 <div class="form-input form-input-pass">
		 <input type="password" name="passwd" value="demo" id="" />
		 <input type="submit" value="Войти →" name="send" style="  font-size: 13px;"/>
		 </div>
		  <div class="form-input form-input-checkbox"><input type="checkbox" name="remember" value="on" id="saveme"> <label for="saveme">Запомнить меня</label></div>

	</form>
	';
}

print $r;

?>

           <div class="footer"> 
		   </div>
         </div>
         <div class="bottom-nav"></div>
        
      </div>
   </body>
</html>
<?php	include_once 'statistic'; ?>