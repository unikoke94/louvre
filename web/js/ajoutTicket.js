var $collectionHolder = $('div.tickets');
var $valeurInput = Number($('#commande_nbTicket').val());
var $ticketPlusUn = $('#plus');
var $ticketMoinsUn = $('#moins');
var $valeurEmail = $('#commande_email').val();


$(window).load(function() {
	addTicketForm();
	var now = new Date();
	var currentDay = now.getDate() + '/' + (now.getMonth()+1) + '/' + now.getFullYear();
});


$ticketPlusUn.on('click', function() {
	if($valeurInput < 5) {
		$valeurInput++;
		addTicketForm();
		$('#commande_nbTicket').val($valeurInput);
	}
});

$ticketMoinsUn.on('click', function() {
	
	if ($valeurInput > 1) {
		$valeurInput--;
		delTicketForm();
		$('#commande_nbTicket').val($valeurInput);
	} 
}); 


function addTicketForm() {

	var prototype = $collectionHolder.data('prototype');
	var index = $collectionHolder.find('.block-ticket').length;
	var newForm = prototype.replace(/__name__/g, index);	

	$collectionHolder.data('index', index);
	$collectionHolder.append(newForm);
	index++;

	//Code pour rajouter le widget datepicker sur chaque champ date de naissance
	$('.block-dateNaissance').datepicker({
		format: 'dd/mm/yyyy',
		startDate: '01/01/1900',
		endDate: '1d',
	})

}

function delTicketForm() {
	$('.block-ticket').last().remove();
}






