$(document).ready(function(){
	$('div[data-ngcaptcha="recaptcha"]').each(function() {
		var id=$(this).attr('id');
		var recaptchapublic=$(this).attr('data-recaptchapublic');
		Recaptcha.create(recaptchapublic, id, {theme: "clean"}
	  );
	});
});