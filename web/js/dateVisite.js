$(function() {
	$('#commande_dateVisite').datepicker({
		format: 'dd/mm/yyyy',
		startDate: 'd',
		datesDisabled: '[01/11/2017, 11/11/2017, 25/12/2017, 01/01/2018, 01/05/2018, 08/05/2018, 14/07/2018, 15/08/2018, 01/11/2018, 11/11/2018, 25/12/2018]',
		daysOfWeekDisabled: '0,2', 
		endDate: '31/12/2018',
		todayHighlight: true,
		weekStart: '1',
	});

	var $subButton = $('#commande_save');
	var $date = $('#commande_dateVisite');

	$subButton.prop('disabled', true);//Pour empêcher de submit sans date de visite

	$date.on('change', function() {
		//On évite d'avoir un nombre différent entre la valeur de l'input Nombre de billets et le nombre de form imbriqués
		if(Number($('#commande_nbTicket').val()) === $('.tickets').children().length) {
			$subButton.prop('disabled', false);
		}
	})

	
});

