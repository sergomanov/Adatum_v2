<?php	
ini_set('display_errors','Off');
//ini_set("display_errors",1);error_reporting(E_ALL);
include_once "mysql";
$errors=NULL;

$con=mysqli_connect($db_host,$db_login,$db_passwd,$db_name);
//$con->set_charset("utf8"); // здесь
if (!mysqli_connect_errno() ) { header("Location: index.php"); }



//$string = 'commands coordinates developments namedev run scheduler session type users';
//$rt=0;$tabl="";$resultSet = mysqli_query($con,"SHOW TABLES"); 
//while ($eachTable = $resultSet->fetch_row() )
//{
//   $tabl=$tabl.$eachTable[0].",";
 //  $substr_count = substr_count($string,$eachTable[0]);
 //  $rt=$rt+$substr_count;
   
//}
//if (!mysqli_connect_errno() AND $rt>8) { header("Location: index.php"); }



  


function replstr($line, $replace )
{
$file=file("mysql"); 
$open=fopen("mysql","w"); 
   for($i=0;$i<count($file);$i++) 
   { 
      if(($i+1)!=$line){fwrite($open,$file[$i]);} 
      else{fwrite($open,$replace."\r\n");} 
   }  
fclose($open);  
}


//replstr("2", "trytryrt");



if (isset($_POST['reg'])) {


$db_host_p = $_POST['db_host'];
$db_login_p = $_POST['db_login'];
$db_passwd_p = $_POST['db_passwd'];
$db_name_p = $_POST['db_name'];

replstr('2', '$db_host   = "'.$db_host_p.'";');
replstr('3', '$db_login   = "'.$db_login_p.'";');
replstr('4', '$db_passwd   = "'.$db_passwd_p.'";');
replstr('5', '$db_name   = "'.$db_name_p.'";');

$con=mysqli_connect($db_host_p,$db_login_p,$db_passwd_p,$db_name_p);
$con->set_charset("utf8"); // здесь
if (mysqli_connect_errno()) { $errors="- Неверный логин, пароль, сервер либо название базы пожалуйста исправьте их в файле mysql"; } else {


$string = 'commands coordinates developments namedev run scheduler session type users';
$rt=0;$tabl="";$resultSet = mysqli_query($con,"SHOW TABLES"); 
while ($eachTable = $resultSet->fetch_row() )
{
  $tabl=$tabl.$eachTable[0].",";
  $substr_count = substr_count($string,$eachTable[0]);
  $rt=$rt+$substr_count; 
}	
if($rt<8){

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `mode` text NOT NULL,
  `address` text NOT NULL,
  `vale` text NOT NULL,
  `laststate` text NOT NULL,
  `unixtime` int(11) NOT NULL,
  `cond` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `controlir` int(11) NOT NULL,
  `editable` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1018 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idn` text NOT NULL,
  `coor` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `developments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` text NOT NULL,
  `vale` text NOT NULL,
  `address` text NOT NULL,
  `unixtime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6636 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `namedev` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `name` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `unixtime` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `vale` text NOT NULL,
  `unixtime` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  `mode` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `scheduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `switch` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `time` text NOT NULL,
  `weekdays` text NOT NULL,
  `monthdays` text NOT NULL,
  `month` text NOT NULL,
  `timer` text NOT NULL,
  `timein` text NOT NULL,
  `timeout` text NOT NULL,
  `conditions` text NOT NULL,
  `commands` text NOT NULL,
  `timerun` int(11) NOT NULL,
  `ico` text NOT NULL,
  `drivers` text NOT NULL,
  `color` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `session` (
  `id_sess` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `code_sess` varchar(15) NOT NULL,
  `user_agent_sess` varchar(255) NOT NULL,
  `date_sess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `used_sess` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` text NOT NULL,
  `name` text NOT NULL,
  `namevalue1` text NOT NULL,
  `namevalue2` text NOT NULL,
  `namevalue3` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `ico` text NOT NULL,
  `symbol` text NOT NULL,
  `regim` int(11) NOT NULL,
  `color` text NOT NULL,
  `tchart` int(11) NOT NULL,
  `control` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;
");

mysqli_query($con,"
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `login_user` varchar(60) NOT NULL,
  `passwd_user` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `key_user` varchar(10) NOT NULL,
  `timezone` int(11) NOT NULL,
  `img` text NOT NULL,
  `calendar` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
");

mysqli_query($con,"
INSERT INTO `users` (`id_user`, `login_user`, `passwd_user`, `mail_user`, `key_user`, `timezone`, `img`, `calendar`) VALUES
(0, 'System', '', '', '', 0, '', 0),
(1, 'admin', '53a2e0f8485a1da00509e3cc6bf40e0b', 'mail@mail.ru', 'yA4gAjQ4xC', 25200, '/feditor/attached/image/20150313/20150313102144_79301.jpg', 0),
(2, 'demo', '53a2e0f8485a1da00509e3cc6bf40e0b', 'demo@demo.ru', 'yA4gAjQ4xC', 7200, '/feditor/attached/image/20150313/20150313102144_79301.jpg', 0);
");

mysqli_query($con,"
INSERT INTO `type` (`id`, `mode`, `name`, `namevalue1`, `namevalue2`, `namevalue3`, `id_user`, `type`, `ico`, `symbol`, `regim`, `color`, `tchart`, `control`) VALUES
(NULL, 'EML', 'Отправка E-mail сообщения', 'Адрес E-mail', 'Заголовок письма', 'Текст письма', 0, 3, 'icon-mail-7', '', 3, '', 0, 0),
(NULL, 'ACT', 'Активация правил', 'Номер правила', 'Состояние правила', '', 0, 2, 'icon-shuffle-3', '', 3, '#b539bf', 1, 0),
(NULL, 'SMS', 'Отправка SMS сообщения', 'Номер телефона', 'Текст сообщения', '', 0, 2, 'icon-mobile-alt', '', 3, '#a52cb0', 0, 0),
(NULL, 'ONLINE', 'Устройство в сети', 'Состояние устройства (0-выкл, 1-вкл)', '', '', 0, 1, 'icon-share-squared', '', 1, '#5cd90f', 0, 0);

");


}
header("Location: index.php");
}

}







?>
<!DOCTYPE html>
<html>
<head>
<title>Установка системы Adatum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Inscription and login forms,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>

<style>
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/* start editing from here */
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}

body{
	background:url("css/bg.png") repeat;
	font-family: 'Roboto', sans-serif;

}
.wrap{
	margin: 0 auto;
	width:80%;
}
.alert-warning{
	padding-top: 10px;
  color: #FFF;
}
.main {
  margin: 6em 0px;
}
body a,form li,.submit input[type="submit"]{
	transition: 0.1s all;
	-webkit-transition: 0.1s all;
	-moz-transition: 0.1s all;
	-o-transition: 0.1s all;
}
.top-one {
  margin: 0 auto;
}
/*---login---------*/
.create-account {
  background: url("css/bg.jpg")0px 0px no-repeat;
  display: block;
  width:38%;
  height: 60%;
  margin: 0 auto;
}
.create-account lable{
  color:#ed1c2f;
}
.login-head {
  padding: 3em 0em 0 2em;
  text-align: left;
}
.login-head h2 {
  font-size: 1.4em;
color: #fff;
font-weight: 400;
text-transform: uppercase;
font-family: 'Copse', serif;
}
span.line{
  width: 92%;
  height: 1px;
  background: #e6e6e6;
  margin: 0 auto;
  position: relative;
  display: inline-block;
}
span.sub-line{
  width: 43%;
  height: 1px;
  background: #ef1b34;
  position: absolute;
  top: 26%;
  left: 0%;
  display: inline-block;
  
}
.create-account p {
  font-size: 1.1em;
  color: #fff;
  padding: 1em 0;
  font-weight: 400;
  font-family: 'Copse', serif;
}
.login-head h1 {
font-size: 2em;
color: #fff;
font-weight:500;
font-family: 'Copse', serif;
}
form {
  padding: 1em 2em 0.3em 2em;
}
.create-account input[type="text"],.create-account input[type="password"] {
	width: 93%;
  padding: 0.8em 0.8em;
  color: #fff;
  font-size: 15px;
  outline: none;
  background: none;
  font-weight: 500;
  border: 1px solid #fff;
  font-family: 'Roboto', sans-serif;
}
.submit {
  padding: 1.5em 0em;
  border-bottom:1px dotted #fff;
}
.create-account h5 {
  text-align: center;
  padding: 2em 0 3em 0;
  color: #fff;
  font-size:1em;
}
.create-account h5 a{
	color: #ed1c2f;
  outline: none;
  border: none;
}
.create-account h5 a:hover{
  text-decoration:underline;
}
.submit h5 a:hover{
	text-decoration: underline;
}
.submit input[type="submit"]{
	font-size: 20px;
	font-weight: 400;
	color: #fff;
	cursor: pointer;
	outline: none;
	padding: 1em 1em;
	width:99%;
	border: none;
	background: #88c407;
	border-bottom:3px solid #77ab07;
}
.submit input[type="submit"]:hover{
	  opacity: 0.8;
}
/*----------*/
.p-container {
  margin: 0.2em 0 1.5em 0;
}
.p-container  .checkbox input {
	position: absolute;
	left: -9999px;
}
.p-container.checkbox i {
	border-color: #fff;
	transition: border-color 0.3s;
	-o-transition: border-color 0.3s;
	-ms-transition: border-color 0.3s;
	-moz-transition: border-color 0.3s;
	-webkit-transition: border-color 0.3s;
	
}
.p-container.checkbox i:hover {
	border-color:red;
	
}
.p-container  i:before {
	background-color: #2da5da;	
}
.p-container  .rating label {
	color: #ccc;
	transition: color 0.3s;
	-o-transition: color 0.3s;
	-ms-transition: color 0.3s;
	-moz-transition: color 0.3s;
	-webkit-transition: color 0.3s;
}
.p-container  .checkbox input + i:after {
	position: absolute;
	opacity: 0;
	transition: opacity 0.1s;
	-o-transition: opacity 0.1s;
	-ms-transition: opacity 0.1s;
	-moz-transition: opacity 0.1s;
	-webkit-transition: opacity 0.1s;
}
.p-container .checkbox input + i:after {
	content:url(css/tick.png) no-repeat 7px 1px;
	top:5px;
	left: 5px;
	width: 13px;
	height: 12px;
}
.p-container.checkbox {
	float: left;
	margin-right: 30px;
}
.p-container .checkbox {
	padding-left: 40px;
  font-size: 14px;
  line-height: 14px;
  color: #999;
  cursor: pointer;
}
.p-container  .checkbox {
	position: relative;
	display: block;
}
.p-container  h6 a {
	float: right;
	color: #898989;
}
.p-container  h6 a:hover{
	text-decoration: underline;
}
label.checkbox {
float: left;
margin-top: 3px;
}
.p-container  .checkbox i {
	position: absolute;
	top: -5px;
	left: 5px;
	display: block;
	width: 22px;
	height: 22px;
	outline: none;
	border: none;
	background: #dfdfdf;
}
.p-container  .checkbox input + i:after {
	position: absolute;
	opacity: 0;
	transition: opacity 0.1s;
	-o-transition: opacity 0.1s;
	-ms-transition: opacity 0.1s;
	-moz-transition: opacity 0.1s;
	-webkit-transition: opacity 0.1s;
}
.p-container .checkbox input + i:after {
	color: #2da5da;
}
.p-container .checkbox input:checked + i,
.p-container . input:checked + i {
	border-color: #2da5da;	
}
.p-container .rating input:checked ~ label {
	color: #2da5da;	
}

.p-container .checkbox input:checked + i:after {
	opacity: 1;
}
.p-container a {
color: #000;
}
.p-container a:hover{
	text-decoration: underline;
}
.sign-up {
  padding: 1em 0em 3.7em 0;
  border-bottom: 1px dotted #fff;
}
.sign-up input[type="reset"] {
  float: left;
  background: #e2e5e2;
  padding: 0.7em 1.4em;
  color: #3B3B3B;
  font-weight: 400;
  border: none;
  outline: none;
  font-size: 1.1em;
  transition: 0.1s all;
  -webkit-transition: 0.1s all;
  -moz-transition: 0.1s all;
  -o-transition: 0.1s all;
  cursor: pointer;
}
.sign-up input[type="reset"]:hover {
   background: #ec222f;
   color: #e2e5e2;
}
.sign-up input[type="submit"] {
  float: right;
  background: #ec222f;
  padding: 0.7em 1.5em;
  color: #e2e5e2;
  font-weight: 400;
  border:none;
  outline: none;
  cursor: pointer;
  font-size: 1.1em;
  transition: 0.1s all;
  -webkit-transition: 0.1s all;
  -moz-transition: 0.1s all;
  -o-transition: 0.1s all;
}
.sign-up input[type="submit"]:hover{
  background: #e2e5e2;
  color:#ec222f;
}
/****************/
.copy-right {
	text-align: center;
	margin: 2% 0 2% 0;
}
.copy-right p {
	color: #fff;
	font-size: 1em;
	font-weight:400;
  font-family: 'Copse', serif;
}
.copy-right p a {
	font-size: 1em;
	color: #EC222F;
}
.copy-right p a:hover {
	color: #fff;
}
/*-----start-responsive-design------*/
  @media (max-width:1440px){
    .create-account {
    background: url("css/bg.jpg")0px 0px no-repeat;
    display: block;
    width: 40%;
    height: 60%;
    margin: 0 auto;
  }
}
@media (max-width:1366px){
  .create-account input[type="text"], .create-account input[type="password"] {
  width: 93%;
  }
    span.line{
    width: 92%;
    height: 1px;
    background: #e6e6e6;
    margin: 0 auto;
    position: relative;
    display: inline-block;
  }
  span.sub-line{
    width: 43%;
    height: 1px;
    background: #ef1b34;
    position: absolute;
    top: 26%;
    left: 0%;
    display: inline-block;
    
  }
}
@media (max-width:1280px){
  .create-account {
  background: url("css/bg.jpg")0px 0px no-repeat;
  display: block;
  width: 48%;
  height: 60%;
  margin: 0 auto;
  }
}
@media (max-width:1024px){
    .create-account {
    background: url("css/bg.jpg")0px 0px no-repeat;
    display: block;
    width: 55%;
    height: 60%;
    margin: 0 auto;
  }
  .main {
  margin: 2em 0;
  }
}
@media (max-width:768px){
  .create-account {
  background: url("css/bg.jpg")0px 0px no-repeat;
  display: block;
  width: 79%;
  height: 60%;
  margin: 0 auto;
  }
}
@media (max-width:640px){
    .create-account {
    background: url("css/bg.jpg")0px 0px no-repeat;
    display: block;
    width: 90%;
    height: 60%;
    margin: 0 auto;
  }
}
@media (max-width:480px){
    .create-account {
    background: url("css/bg.jpg")0px 0px no-repeat;
    display: block;
    width: 101%;
    height: 60%;
    margin: 0 auto 0 0%;
  }
  .sign-up input[type="reset"] {
  padding: 0.6em 1em;
  font-size: 1em;
  }
  .sign-up input[type="submit"] {
  padding: 0.6em 1em;
  font-size:1em;
  }
}
@media (max-width:320px){
  .login-head {
  padding: 2em 0em 0 1em;
  text-align: left;
  }
  .create-account input[type="text"], .create-account input[type="password"] {
    width: 93%;
    padding: 0.6em 0.6em;
    color: #fff;
    font-size: 13px;
  }
  .create-account p {
    font-size: 0.9em;
    padding: 0.6em 0;
  }
  a.sign-left{
    padding: 0.5em 1em;
    font-size: 0.9em;
  }
  .login-head h2 {
  font-size: 0.9em;
  }
  form {
   padding: 0.5em 1em 0.3em 1.2em;
  }
  a.signup {
  padding: 0.5em 1em;
  font-size: 0.9em;
  }
  .sign-up {
  padding: 1em 0em 2.8em 0;
  }
  .create-account h5 {
  padding: 1em 1em 1em;
  font-size: 0.9em;
  }
  .main {
  margin: 1em 0;
  }
  .login-head {
  padding: 1em 0em 0 1em;
  text-align: left;
  }
  .copy-right p {
  font-size: 0.85em;
  line-height: 1.6em;
  }
  .create-account input[type="text"], .create-account input[type="password"] {
  width: 90%;
  padding: 0.6em 0.6em;
  }
  .sign-up input[type="reset"] {
  padding: 0.5em 1em;
  font-size:0.9em;
  }
  .sign-up input[type="submit"] {
  padding: 0.5em 1em;
  font-size:0.9em;
  }
} 
</style>
</head>
<body>

<div class="main">
	<div class="wrap">
	<div class="top-one">
	<div class="login-one">
		<div class="create-account">
			<div class="login-head">
					<h2>Установка системы</h2>
					<span class="line">
						<span class="sub-line"></span>
					</span>
						<?php	if($errors!=NULL){ echo '<div class="alert alert-warning">'.$errors.'</div>';} ?>		

			</div>
<form name="myForm" method="post" >
					<p>Имя хоста mysql<lable> *</lable></p>
					<input type="text" class="text" name="db_host" value="<?php if (isset($_POST['db_host'])){echo $_POST['db_host']; }else{ echo $db_host;} ?>" >
					<p>Логин к mysql<lable> *</lable></p>
					<input type="text" class="text" name="db_login" value="<?php if (isset($_POST['db_host'])){echo $_POST['db_login']; }else{ echo $db_login;} ?>"  >
					<p>Пароль <lable> *</lable></p>
					<input type="text" class="text" name="db_passwd" value="<?php if (isset($_POST['db_host'])){echo $_POST['db_passwd']; }else{ echo $db_passwd;} ?>"  >
					<p>Имя базы данных <lable> *</lable></p>
					<input type="text" class="text" name="db_name" value="<?php if (isset($_POST['db_host'])){echo $_POST['db_name']; }else{ echo $db_name;} ?>">
					
				<div class="sign-up">
					
					<input type="submit" name="reg" value="Продолжить" >
				</div>
</form>
		<div class="clear"> </div>
		<h5>Adatum install</h5>
	</div>
	</div>

		</div>
	</div>
</div>
	
</body>
</html>