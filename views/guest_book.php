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
                    <span class="author_comm"><?= $item['user_name']; ?></span> | <?= $item['text']; ?>
                    <?php if ($item['uploadfiles_name']){ ?>
                        <br /><img src="uploadedfiles/<?= $item['uploadfiles_name']; ?>" class="uploadfile" alt="uploadfile" />
                    <?php } ?><br /><br />
                    <?= $item['date']; ?>
                </div>
            <?php endforeach; ?>
         
       <?php endif; ?>
<?php /*<------------------------- Output comments */ ?>

        <div class="comment-form">
		    <div id="errors" class="info"><?= $error; ?></div>
            <form method="POST" enctype="multipart/form-data">
				<div id="errors" class="info"><?= $errorAuthor; ?></div>
                <label>Ваше имя:</label>
				<br>
                <input type="text" name="author" value="<?= $author; ?>" class="text_input" ><!--required-->
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
				<div id="errors" class="info"><?= $errorComment; ?></div>
                <label>Оставить отзыв:</label>
				<br>
                <textarea name="comment" class="form_textarea"><?= $comment; ?></textarea>
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
    <script src="js/my_valid.js"></script>
    </body>
</html>