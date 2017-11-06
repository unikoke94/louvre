<?php

namespace Louvre\BilletterieBundle\Services\Stripe;

use Stripe\Charge;
use Stripe\Error\Card;

class Stripe {

	private $key;
	private $token;



	public function charge($key, $token, $prix) 
	{
		\Stripe\Stripe::setApiKey($key);

		try {
			Charge::create(array(
				"amount" => $prix * 100,
				"currency" => "eur",
				"source" => $token,
				"description" => "Billetterie - Musée du Louvre",
				));
		} catch(Card $e) {
			//erreur, paiement refusé
		}
	}



}