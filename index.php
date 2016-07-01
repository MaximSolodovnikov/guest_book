<?php
require_once 'functions/fns.php';

	db();

	/*accept values from the form*/
	
    $author = mysql_entities_fix_string($_POST['author']);
	$email = mysql_entities_fix_string($_POST['email']);
	$homepage = mysql_entities_fix_string($_POST['homepage']);
    $comment = mysql_entities_fix_string($_POST['comment']);
    $captcha = mysql_entities_fix_string($_POST['captcha']);
    $captcha2 = mysql_entities_fix_string($_POST['captcha2']);
	
	$ip_author = $_SERVER['REMOTE_ADDR'];
	$browser_author = $_SERVER['HTTP_USER_AGENT'];
	
	if (isset($_POST['send'])) {
        if (!empty($author) && !empty($email) && !empty($comment) && !empty($captcha2)) {
            if ($captcha == $captcha2) {
                $max_image_size = 102400; //100 * 1024 = 100Kb
                if(is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {
                    if ($_FILES['uploadfile']['size'] < $max_image_size) {
                        
                        if (($_FILES['uploadfile']['type'] == "image/gif") ||
                            ($_FILES['uploadfile']['type'] == "image/jpeg") || 
                            ($_FILES['uploadfile']['type'] == "image/png")) {
                        }
                        else {
                            $error = 'Не верный формат файла';
                        }
                    }
                    else {
                        $error = 'Превышен размер файла';
                    }
                if (!$error) {
                $comment_id = add_comment($author, $comment);
                $uploaddir = './uploadedfiles/';
                $uploadfilename = time() . $_FILES['uploadfile']['name'];
                $uploadfile = $uploaddir.basename($uploadfilename);
                if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
                    add_image($uploadfilename, $comment_id);
                    header("Location: .");
                }
            } 
        }
        else {
            add_comment($author, $comment);
            header("Location: .");
        }
            }
        else {
            $error = "Введенные цифры не совпадают";
        }
    }
        else {
            $error = "Заполните все поля";
        }       
    }
    
    /*output of comments*/
    $comments = get_comments();
	
	require_once 'views/guest_book.php';