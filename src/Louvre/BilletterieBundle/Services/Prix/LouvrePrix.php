<?php

namespace Louvre\BilletterieBundle\Services\Prix;

use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Ticket;

class LouvrePrix
{


	public function prixCommande(Commande $commande)
	{
		$prixCommande = 0;
		$tickets = $commande->getTickets();
		foreach($tickets as $ticket) {

			$dateNaissance = $ticket->getDateNaissance();

			$difference = $dateNaissance->diff(new\DateTime());
			$interval = $difference->y;


			if($ticket->getTarifReduit() != null && $interval > 12) {
				$ticket->setTarif('Réduit');
				if($commande->getType() === 'Demi-journée') {
					$ticket->setPrix(5);
				} else {
					$ticket->setPrix(10);
				}
			} else {
				if($interval < 4) {
					$ticket->setTarif('Bébé');
					$ticket->setPrix(0);
				} elseif(($interval >= 4) && ($interval < 12)) {
					$ticket->setTarif('Enfant');
					if($commande->getType() === 'Demi-journée') {
						$ticket->setPrix(4);
					} else {
						$ticket->setPrix(8);
					}
				} elseif(($interval >= 12) && ($interval < 60)) {
					$ticket->setTarif('Normal');
					if($commande->getType() === 'Demi-journée') {
						$ticket->setPrix(8);
					} else {
						$ticket->setPrix(16);
					}
				} elseif($interval >= 60) {
					$ticket->setTarif('Sénior');
					if($commande->getType() === 'Demi-journée') {
						$ticket->setPrix(6);
					} else {
						$ticket->setPrix(12);
					}	
				}
			}

			$prixCommande = $prixCommande + $ticket->getPrix();
			
		}
		$commande->setPrixTotal($prixCommande);

		if($commande->getPrixTotal() <= 0) {
			throw new \LogicException('Le prix de la commande ne peut pas être nul.');
		} 
	}


}