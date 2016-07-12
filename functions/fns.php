<?php
require_once 'config/database.php';

/*connect to DB*/

function db()
{
    $connect = mysql_connect(HOST, USER, PSWD);
    if(!$connect || !mysql_select_db(DB, $connect) ) {
        return die("Error with connection or selection of Database <br />" . mysql_error());
    }
    else {
        return $connect;
    }
}

/* >> function to prevent injection attacks of XSS and SQL*/

function mysql_entities_fix_string($string)
{
	return htmlentities(mysql_fix_string($string));
}

function mysql_fix_string($string)
{
	if (get_magic_quotes_gpc()) $string = stripcslashes($string);
	return mysql_real_escape_string($string);
}

/* << function to prevent injection attacks of XSS and SQL*/

function captcha()
{
    $captcha = substr(hash('ripemd160', mt_rand(100, 999)), 0, 3);
    return $captcha;
}

function add_comment($user_name, $email, $homepage, $text, $ip_user_name, $browser_user_name)
{
    mysql_query("INSERT INTO `comments` (`user_name`, `email`, `homepage`, `text`, `ip_author`, `browser`) 
				 VALUES ('$user_name', '$email', '$homepage', '$text', '$ip_user_name', '$browser_user_name')");
    return mysql_insert_id();
}

/*function add_comment($author, $email, $homepage, $comment, $ip_author, $browser_author)
{
	$query = 'PREPARE statement FROM "INSERT INTO comments VALUES (?, ?, ?, ?, ?, ?)"';
	mysql_query($query);
	
	$query = 'SET @user_name = "$author",' .
			 '@email = "$email",' .
			 '@homepage = "$homepage",' .
			 '@text = "$comment",' .
			 '@ip_author = "$ip_author",' .
			 '@browser = "$browser_author"';
	mysql_query($query);
	
	$query = 'EXECUTE statement USING @user_name, @email, @homepage, @text, @ip_author, @browser';
	mysql_query($query);
	
	$query = 'DEALOCATE PREPARE statement';
	mysql_query($query);
}*/

function add_image($file_name, $comment_id)
{
    mysql_query("INSERT INTO `images` (`uploadfiles_name`, `comment_id`) VALUES ('$file_name', '$comment_id')");
}

function get_comments()
{
    $sel = "SELECT * FROM `comments` LEFT JOIN `images` ON comments.id = images.comment_id ORDER BY comments.id DESC";
    $res = mysql_query($sel);
    while($row = mysql_fetch_array($res)) {
            $comments[] = $row;
        }
    return $comments;
}