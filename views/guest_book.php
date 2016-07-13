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
	
	<?php /* Output comments ------------------------->*/ ?>
       <?php if (!empty($comments)): ?>

            <?php foreach($comments as $item): ?>
                <div class="comment-answ">
					<table>
						<tr>
							<td><span class="author_comm">Автор: </span><?= $item['user_name']; ?></td>
						</tr>
						<tr>
							<td><span class="author_comm">E-mail: </span><?= $item['email']; ?></td>
						</tr>
						<tr>
							<td><span class="author_comm">Дата: </span><?= $item['date']; ?></td>
						</tr>
						<tr>
							<td><span class="author_comm">Комментарий:</span></td>
						</tr>
						<tr>
							<td><?= $item['text']; ?></td>
						</tr>
						<tr>
							<td>
								<?php if ($item['uploadfiles_name']): ?>
									<br /><img src="uploadedfiles/<?= $item['uploadfiles_name']; ?>" class="uploadfile" alt="uploadfile" />
								<?php endif; ?><br /><br />
							</td>
						</tr>
					</table>
                </div>
            <?php endforeach; ?>
         
       <?php endif; ?>
<?php /*<------------------------- Output comments */ ?>

        <div class="comment-form">
		    <div id="errors" class="info"><?php echo $error; ?></div>
            <form method="POST" enctype="multipart/form-data">
				<div id="errors" class="info"><?= $errorUserName; ?></div>
                <label>Ваше имя:</label>
				<br>
                <input type="text" name="user_name" value="<?= $user_name; ?>" class="text_input" ><!--required-->
				<br><br>
				<div id="errors" class="info"><?= $errorEmail; ?></div>
				<label>E-mail:</label>
				<br>
                <input type="text" name="email" value="<?= $email; ?>" class="text_input" ><!--required-->
				<br><br>
				<label>Homepage:</label>
				<br>
                <input type="text" name="homepage" value="<?= $homepage; ?>" class="text_input">
				<br><br>
				<div id="errors" class="info"><?= $errorText; ?></div>
                <label>Оставить отзыв:</label>
				<br>
                <textarea name="text" class="form_textarea"><?= $text; ?></textarea>
				<br><br>
				<div id="errors" class="info"><?= $errorCaptcha . $errorCaptcha2; ?></div>
                <label>Введите символы для проверки:</label>
				<br>
                <input name="captcha" value="<?= captcha(); ?>" readonly="readonly" size="2" class="captcha">
                <input name="captcha2" value="" size="2" maxlength="3" class="captcha2" />
				<br><br>
				<div id="errors" class="info"><?= $errorType . $errorSize; ?></div>
                <input type="file" name="uploadfile" />
				<br><br>
                <input type="submit" name="send" value="Отправить" class="button">
            </form>
        </div>
    </div>
    <script src="js/valid.js"></script>
    </body>
</html>