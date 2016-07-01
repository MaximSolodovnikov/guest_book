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
    $captcha = rand(100, 999);
    return $captcha;
}

function add_comment($author, $comment)
{
    mysql_query("INSERT INTO `comments` (`author`, `comment`) VALUES ('$author', '$comment')");
    return mysql_insert_id();
}

function add_image($file_name, $comment_id)
{
    mysql_query("INSERT INTO `images` (`image`, `comment_id`) VALUES ('$file_name', '$comment_id')");
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