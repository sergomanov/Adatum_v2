<?php	
 
if (isset($_POST['ok'])) {

header("Location: main.php");
}
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

            <form class="form -js-form -js-form-login"  method="post" style="display: block;">
      
               <br>  <br>  <br>  <br>  <br>  <br>
             

               <div class="form-input form-input-login">
                  <div><input autofocus="" type="text" placeholder="Логин" name="login" maxlength="50"></div>
               </div>
               <div class="form-input form-input-pass">
                  <div><input name="pass" placeholder="Пароль" type="password"></div>
                 <input type="submit" name="ok" value="Войти →">
               </div>
               <div class="form-input form-input-checkbox"><input type="checkbox" name="rememberMe" id="saveme"> <label for="saveme">Запомнить меня</label></div>
            </form>
           <div class="footer"></div>
         </div>
         <div class="bottom-nav"></div>
        
      </div>
   </body>
</html>