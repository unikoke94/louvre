$(function() {

	$('#message-email').hide();

	$('#commande_email').blur(function(){
		var $valeurEmail = $('#commande_email').val();
		var regexEmail = /.+@.+\..+/;

		if($valeurEmail !== '') {
			if(!regexEmail.test($valeurEmail)) {
				$('#message-email').show();
				console.log('Faux');
			} else {
				$('#message-email').hide();
				console.log($valeurEmail);
			}
		}
	});


})