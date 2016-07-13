function validate(form) {
	
	fail  = validateUsername(form.user_name.value)
	fail += validateEmail(form.email.value)
	fail += validateText(form.text.value)
	fail += validateCaptcha(form.captcha2.value)
	
	if (fail == '') return true
	else {alert(fail); return false }
}

function validateUsername(field) {
	
	if (field == '') return "Не заполнено поле Ваше имя.\n";
	else if (field.length < 5) return "В поле Ваше имя должно быть не менее 5 символов.\n";
	else if (/[^a-zA-Z0-9]/.test(field)) return "В поле Ваше имя разрешены только цифры и буквы латинского алфавита.\n";
	return '';
}

function validateEmail(field) {
	
	if (field == "") return "Не заполнено поле Email.\n";
	else if (!((field.indexOf('.') > 0) && 
			   (field.indexOf('@') > 0)) || 
			   /[^a-zA-Z0-9.@_-]/.test(field))
		return "Поле Email имеет неверный формат";
	return "";
}

function validateText(field) {
	
	if (field == '') return "Не заполнено поле Оставить отзыв.\n";
}

function validateCaptcha(field) {
	
	if (field == '') return "Не заполнено поле Символы для проверки.\n";
	else if (/[^a-zA-Z0-9]/.test(field)) return "В поле Символы для проверки разрешены только цыфры и буквы латинского алфавита";
	return "";
}