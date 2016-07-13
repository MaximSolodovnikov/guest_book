<?php
require_once 'functions/fns.php';

	db();
	
	//register_globals = Off;

	$error = $errorUserName = $errorEmail = 
	$errorText = $errorCaptcha = $errorCaptcha2 = 
	$user_name = $email = $homepage = 
	$text = $captcha = $captcha2 = 
	$errorType = $errorSize = '';
	
	if (isset($_POST['send'])) {

		$user_name   = mysql_entities_fix_string($_POST['user_name']);
		$email       = mysql_entities_fix_string($_POST['email']);
		$homepage    = mysql_entities_fix_string($_POST['homepage']);
		$text        = mysql_entities_fix_string($_POST['text']);
		$captcha     = mysql_entities_fix_string($_POST['captcha']);
		$captcha2    = mysql_entities_fix_string($_POST['captcha2']);
		
		$ip_user_name = mysql_entities_fix_string($_SERVER['REMOTE_ADDR']);
		$browser_user_name = mysql_entities_fix_string($_SERVER['HTTP_USER_AGENT']);

	
		if (empty($_POST['user_name']) && empty($_POST['email']) && empty($_POST['text']) && empty($_POST['captcha2'])) {
			$error = "Вы не заполнили все поля";
		} elseif (empty($_POST['user_name'])) {
			$errorUserName = "Вы не заполнили поле Ваше имя";
		} elseif (empty($_POST['email'])) {
			$errorEmail = "Вы не заполнили поле Email";
		} elseif (empty($_POST['text'])) {
			$errorText = "Вы не заполнили поле Оставить отзыв";
		} elseif (empty($_POST['captcha2'])) {
			$errorCaptcha = "Вы не заполнили поле Символы для проверки";
		} elseif ($captcha != $captcha2) {
			$errorCaptcha2 = "Вы ввели неверные Символы для проверки";
		} else {

			$max_image_size = 102400; //100 * 1024 = 100Kb
			
			if(is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
				if ($_FILES['uploadfile']['size'] < $max_image_size) {
					
					if (($_FILES['uploadfile']['type'] == "image/jpeg") ||
						($_FILES['uploadfile']['type'] == "image/gif") || 
						($_FILES['uploadfile']['type'] == "image/png")) {
							
					} else {
						$errorType = 'Не верный формат файла';
					}
				} else {
					$errorSize = 'Превышен размер файла';
				}
                if (!$errorType && !$errorSize) {

                $comment_id = add_comment($user_name, $email, $homepage, $text, $ip_user_name, $browser_user_name);
                $uploaddir = './uploadedfiles/';
                $uploadfilename = time() . $_FILES['uploadfile']['name'];
                $uploadfile = $uploaddir.basename($uploadfilename);
					
					if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
						
						add_image($uploadfilename, $comment_id);
						header("Location: .");
					}
				} 
			} else {

				add_comment($user_name, $email, $homepage, $text, $ip_user_name, $browser_user_name);
				header("Location: .");
			}
		}
	}
	
	$comments = get_comments();
	
	require_once 'views/guest_book.php';