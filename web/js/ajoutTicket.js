$(window).load(function() {
	addTicketForm();
	//console.log();
});

var $collectionHolder = $('div.tickets');
var $valeurInput = Number($('#commande_nbTicket').val());
var $ticketPlusUn = $('#plus');
var $ticketMoinsUn = $('#moins');
var $dateNaissance = $('#commande_tickets_0_dateNaissance');


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
		//code pour supprimer un form ticket (soit appel fonction, soit code brut ici)
		$('#commande_nbTicket').val($valeurInput);
	} 
}); 


/*console.log(typeof $valeurInput);

$('#commande_nbTicket').on('change', function() {
	if($valeurInput > 5) {
		//$valeurInput = 1;
		console.log($valeurInput);
	} else {
		console.log('non');
		addTicketForm();
	}
});*/


function addTicketForm() {

	var prototype = $collectionHolder.data('prototype');
	//var index = Number($collectionHolder.data('index'));
	var index = $collectionHolder.find('div').length;
	var newForm = prototype.replace(/__name__/g, index);
		//.replace(/__name__label__/g, 'Visiteur n°' + (index+1))	

	$collectionHolder.data('index', index + 1);
	$collectionHolder.append(newForm);
	index++;

}

function delTicketForm() {
	$collectionHolder.last().remove();
}





//Tests sur le SELECT

/*

document.getElementById('commande_nbTicket').addEventListener("change", function (e) {
	var valeur = parseInt(e.target.options[e.target.selectedIndex].value);
	
	for (i = 0; i < valeur; i++) { 
	    addTicketForm();
	}
	
});
*/



