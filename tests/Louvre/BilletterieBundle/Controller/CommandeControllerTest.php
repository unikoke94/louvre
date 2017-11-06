<?php

namespace Tests\BilletterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Ticket;



class CommandeControllerTest extends WebTestCase
{

	public function testHomepageIsUp()
	{
		$client = static::createClient();
		$client->request('GET', '/');

		$this->assertSame(200, $client->getResponse()->getStatusCode());
	}


	public function testPaiementPageWithoutData()
	{

		$client = static::createClient();
		$client->request('GET', '/paiement');

		$this->assertSame(500, $client->getResponse()->getStatusCode());
	}



	public function testHomepageForm()
	{
		$client = static::createClient();
		$commande = new Commande();
		$ticket = new Ticket();

		$ticket
			->setNom('Abc')
			->setPrenom('Def')
			->setPays('FR')
			->setDateNaissance(new \DateTime())
			->setDateVisite(new \DateTime('1978-12-10'))
			->setTarifReduit(0)
			->setCommande($commande);

		$commande
			->setDateVisite('2017-12-10')
			->setType('Journée')
			->setNbTicket(1)
			->setEmail('barriac.thomas@laposte.net')
			->addTicket($ticket);

		$crawler = $client->request('POST', '/paiement', array($commande, $ticket));

		$this->assertSame(2, $crawler->filter('table')->count());

	}


	
}