<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Comments form">
        <meta name="author" content="MaximSolodovnikov">
        <link rel="icon" href="favicon.png">

        <title>Гостевая книга</title>

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
    </head>
<body>
    <div class="header">
        <div class="title_form">Оставить отзыв</div>
    </div>
    <div class="wrapper">
 
        <div class="comment-form">
		
		<?php echo $ip_author . " " . $browser_author; ?>
		
        <div id="errors" class="info"></div>
            <form method="POST" enctype="multipart/form-data" action="index.php">
                <label>Ваше имя:</label>
				<br>
                <input type="text" name="author" value="" class="text_input" required>
				<br><br>
				<label>E-mail:</label>
				<br>
                <input type="text" name="email" value="" class="text_input" required>
				<br><br>
				<label>Homepage:</label>
				<br>
                <input type="text" name="homepage" value="" class="text_input">
				<br><br>
                <label>Оставить отзыв:</label>
				<br>
                <textarea name="comment" class="form_textarea"></textarea>
				<br><br>
                <label>Введите цифры для проверки:</label>
				<br>
                <input name="captcha" value="" readonly="readonly" size="2" class="captcha">
                <input name="captcha2" value="" size="2" maxlength="3" class="captcha" />
				<br><br>
                <input type="file" name="uploadfile" />
				<br><br>
                <input type="submit" name="send" value="Отправить" class="button">
            </form>
        </div>
    </div>
    <script src="js/my_valid.js"></script>
    </body>
</html>