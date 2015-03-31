<?php
//~ Старт сессии, файл должен быть сохранен в UTF8 без DOM информации
session_start();

class mysql {
	/**
	*	Function connection to MySQL
	* @param	$db_host			domain or ip mysql server (localhost - default)
	* @param	$db_login			user name for connect to mysql server
	* @param	$db_password	password for conntect to mysql server
	* @param	$db_name			mysql database
	*/
	static function connect($db_host, $db_login, $db_passwd, $db_name) {
		mysql_connect($db_host, $db_login, $db_passwd) or die ("MySQL Error: " . mysql_error()); 
		mysql_query("set names utf8") or die ("<br>Invalid query: " . mysql_error());
		mysql_select_db($db_name) or die ("<br>Invalid query: " . mysql_error());
	}


	/**
	*	MySQL query
	*
	*	@param	$query		Mysql query
	*	@param	$type			Type: num_row, result, assoc or none
	*	@param	$num			Param in mysql_result
	*	@return	boolean		True or False
	*/
	static function query($query, $type=null, $num=null) {
		if ($q=mysql_query($query)) {
			switch ($type) {
				case 'num_row' : return mysql_num_rows($q); break;
				case 'result' : return mysql_result($q, $num); break;
				case 'assoc' : return mysql_fetch_assoc($q); break;
				case 'none' : return $q;
				default: return $q;
			}
		} else {
			return false;
		}
	}

	/**
	*	MySQL data screening
	*
	*	@param	$data			Screening string
	*	@return	string		Result string
	*/
	static function screening($data) {
		$data = trim($data);
		return mysql_real_escape_string($data);
	}

	/**
	 * MySQL data screening array
	 * @papam $data		screening array
	 * @return array	result array
	 */
	static function screening_array($data) {
		foreach ($data as $key=>$value) {
			$tmp[$key]=mysql::screening($value);
		}
		return $tmp;
	}
}

class auth {
	static $error_arr=array();
	static $error='';
	
	/**
	 * This method validate user data
	 * @param		$login			user login
	 * @param		$passwd			user password one
	 * @param		$passwd2		user password two
	 * @param		$mail				user email
	 * @return	bollean			return true or false
	 */
	function check_new_user($login, $passwd, $passwd2, $mail) {
		//~ validate user data
		if (empty($login) or empty($passwd) or empty($passwd2)) $error[]='Все поля обязательные для заполнения';
		if ($passwd != $passwd2) $error[]='Пароли не совпадают';
		if (strlen($login)<3 or strlen($login)>30) $error[]='Войти должны быть между 3 и 30 символов';
		if (strlen($passwd)<3 or strlen($passwd)>30) $error[]='Пароль должен быть от 3 до 30 символов';
		//~ validate email
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) $error[]='Не правильный адрес электронной';
		//~ Checks the user with the same name in the database
		if (mysql::query("SELECT * FROM users WHERE login_user='".$login."';", 'num_row')!=0) $error[]='Пользователь с таким именем уже существует';
		if (mysql::query("SELECT * FROM users WHERE mail_user='".$mail."';", 'num_row')!=0) $error[]='Пользователь с таким E-mail уже существует';

		//~ return error array or TRUE
		if (isset($error)) {
			self::$error_arr=$error;
			return false;
		} else {
			return true;
		}
	}

	/**
	 *	This method is used to register a new user
	 *	@return	boolean or string			return true or html code error
	 */
	function reg() {
		//~ screening input data
		$tmp_arr=mysql::screening_array($_POST);
		$login=$tmp_arr['login'];
		$passwd=$tmp_arr['passwd'];
		$passwd2=$tmp_arr['passwd2'];
		$mail=$tmp_arr['mail'];

		//~ Check valid user data
		if ($this->check_new_user($login, $passwd, $passwd2, $mail)) {
			//~ User data is correct. Register.
			$user_key = $this->generateCode(10);
			$passwd = md5($user_key.$passwd.SECRET_KEY); //~ password hash with the private key and user key
			$query=mysql::query("INSERT INTO `users` (`id_user`, `login_user`, `passwd_user`, `mail_user`, `key_user`,`img`) VALUES (NULL, '".$login."', '".$passwd."', '".$mail."', '".$user_key."','/feditor/attached/image/20150313/20150313102144_79301.jpg');");
			if ($query) {
				return true;
			} else {
				self::$error='Произошла ошибка при регистрации нового пользователя. Связаться с администрацией.';
				return false;
			}
		} else {
			return false;
		}
	}


	/**
	 * This method checks whether the user is authorized
	 * @return		boolean				true or false
	 */
	function check() {
		if (isset($_SESSION['id_user']) and isset($_SESSION['login_user'])) {
			return true;
		} else {
			//~ Verify the existence of cookies
			if (isset($_COOKIE['id_user']) and isset($_COOKIE['code_user'])) {
				//~ cookies exist. Verified with a table sessions.
				$id_user=mysql::screening($_COOKIE['id_user']);
				$code_user=mysql::screening($_COOKIE['code_user']);
				$query=mysql::query("SELECT `session`.*, `users`.`login_user` FROM `session` INNER JOIN `users` ON `users`.`id_user`=`session`.`id_user` WHERE `session`.`id_user`=".$id_user.";");
				if ($query and mysql_num_rows($query)!=0) {
					//~ Cookies are found in the database
					$user_agent=mysql::screening($_SERVER['HTTP_USER_AGENT']);
					while ($row=mysql_fetch_assoc($query)) {
						if ($row['code_sess']==$code_user and $row['user_agent_sess']==$user_agent) {
							//~ found record
							mysql::query("UPDATE `session` SET `used_sess` = `used_sess`+1 WHERE `id_sess` = ".$row['id_sess'].";");
							//~ start session and update cookie
							$_SESSION['id_user']=$row['id_user'];
							$_SESSION['login_user']=$row['login_user'];
							setcookie("id_user", $row['id_user'], time()+3600*24*30);
							setcookie("code_user", $row['code_sess'], time()+3600*24*30);
							return true;
						}
					}
					//~ No records with this pair of matching cookies/user agent
					$this->destroy_cookie();
					return false;
				} else {
					//~ No records for this user
					$this->destroy_cookie();
					return false;
				}
			} else {
				//~ cookies nit exist
				$this->destroy_cookie();
				return false;
			}
		}
	}

	/**
	 * This method performs user authorization
	 * @return boolen			true or false
	 */
	function authorization() {
		//~ screening user data
		$user_data=mysql::screening_array($_POST);
		//~ Find a user with the same name and taking his key
		$find_user=mysql::query("SELECT * FROM `users` WHERE `login_user`='".$user_data['login']."';", 'assoc');
		if (!$find_user) {
			//~ user not found
			self::$error='Пользователь не найден';
			return false;
		} else {
			//~ user found
			$passwd=md5($find_user['key_user'].$user_data['passwd'].SECRET_KEY); //~ password hash with the private key and user key
			if ($passwd==$find_user['passwd_user']) {
				//~ passwords match
				$_SESSION['id_user']=$find_user['id_user'];
				$_SESSION['login_user']=$find_user['login_user'];
				//~ if user select "remember me"
				if (isset($user_data['remember']) and $user_data['remember']=='on') {
					$cook_code=$this->generateCode(15);
					$user_agent=mysql::screening($_SERVER['HTTP_USER_AGENT']);
					mysql::query("INSERT INTO `session` (`id_sess`, `id_user`, `code_sess`, `user_agent_sess`) VALUES (NULL, '".$find_user['id_user']."', '".$cook_code."', '".$user_agent."');");
					setcookie("id_user", $_SESSION['id_user'], time()+3600*24*30);
					setcookie("code_user", $cook_code, time()+3600*24*30);
					
				}
				return true;
			} else {
				//~ passwords not match
				self::$error='Пользователь не найден или пароль не совпадают';
				return false;
			}
		}
	}

	/**
	 * This method is used for the user exit
	 */
	function exit_user() {
		//~ Destroy session, delete cookie and redirect to main page
		session_destroy();
		setcookie("id_user", '', time()-3600);
		setcookie("code_user", '', time()-3600);
		header("Location: index.php");
	}

	/**
	 * This method destroy cookie
	 */
	function destroy_cookie() {
		setcookie("id_user", '', time()-3600);
		setcookie("code_user", '', time()-3600);
	}

	/**
	 * This method is used for password recovery.
	 */
	function recovery_pass($login, $mail) {
		$login=mysql::screening($login);
		$mail=mysql::screening($mail);
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
			self::$error='Не правильный адрес электронной';
			return false;
		}
		//~ select data from this login
		$find_user = mysql::query("SELECT * FROM `users` WHERE `login_user`='".$login."';", 'assoc');
		if ($find_user) {
			if ($find_user['mail_user']!=$mail) {
				//~ Email does not meet this login.
				self::$error='Email не соответствует этим логином';
				return false;
			} else {
				//~ email and login is correct
				$new_passwd = $this->generateCode(8);
				$new_passwd_sql = md5($find_user['key_user'].$new_passwd.SECRET_KEY); //~ password hash with the private key and user key
				$message="You have requested a password recovery site sitename.\nYour new password: ".$new_passwd;
				if ($this->send_recovery_mail($find_user['mail_user'], $message)) {
					mysql::query("UPDATE `users` SET `passwd_user`='".$new_passwd_sql."' WHERE `id_user` = ".$find_user['id_user'].";");
					return true;
				} else {
					self::$error='Новый пароль был отправлен. Контакты с администрацией.';
					return false;
				}
			}
		} else {
			//~ this login - not found
			self::$error='Пользователь не найден';
			return false;
		}
	}

	/**
	 * This method sends an email with a new password for that user.
	 * @return boolean				true or false
	 */
	function send_recovery_mail($mail,$message) {
		if (mail($mail, "Recovery password from site sitename", $message, "From: webmaster@sitename.ru\r\n"."Reply-To: webmaster@sitename.ru\r\n"."X-Mailer: PHP/" . phpversion())) {
			return true;
		} else {
			return false;
		}
	}

 	/**
 	 *	This method generate random string
 	 * @param		$length				int - length string
 	 * @return	string				result random string
 	 */
	function generateCode($length) { 
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; 
		$code = ""; 
		$clen = strlen($chars) - 1;   
		while (strlen($code) < $length) { 
			$code .= $chars[mt_rand(0,$clen)];   
		} 
		return $code; 
	}

	/**
	 *	This method returns the current error
	 */
	function error_reporting() {
		$r='';
		if (mb_strlen(self::$error)>0) {
			$r.=self::$error;
		}
		if (count(self::$error_arr)>0) {
			$r.='<h2>Произошли следующие ошибки:</h2>'."\n".'<ul>';
			foreach(self::$error_arr as $key=>$value) {
				$r.='<li>'.$value.'</li>';
			}
			$r.='</ul>';
		}
		return $r;
	}
}


//~ Параметры потключения к бд
include_once "mysql";
DEFINE("SECRET_KEY", $secret_key);
mb_internal_encoding("UTF-8");

// подключаемся к бд
mysql::connect($db_host, $db_login, $db_passwd, $db_name);
?>
