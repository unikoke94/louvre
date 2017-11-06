$(function() {

	var now = new Date();
	var currentDay = '';
	var type = $('#commande_type option');

	
	/* On rajoute un 0 dans la date courante pour les jours et les mois 
	< 10 afin de faire correspondre le format avec la valeur de l'input dateVisite
	*/
	if(now.getDate() < 10 && (now.getMonth()+1) < 10) {
		currentDay = '0' + (now.getDate()) + '/' + '0' + (now.getMonth()+1) + '/' + now.getFullYear();
	} else {
		currentDay = now.getDate() + '/' + (now.getMonth()+1) + '/' + now.getFullYear();
	}


	/* Sur le changement de valeur de dateVisite, on vérifie
	si le jour courant correspond au jour sélectionné et si l'heure 
	courante est supérieure à 13h, alors on rend le champs 'Journée'
	disabled
	*/
	$('#commande_dateVisite').on('change', function(){
		if((currentDay == $(this).val()) && (now.getHours() > 13)) {
			disableFullDay();
			$('#commande_type').val(''); //On empêche que la valeur soit restée sur 'Journée'
		} else {
			type[2].disabled = false;
		}	
	});

	function disableFullDay() {
		type[2].disabled = true;
	}
})
