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

		/*$form = $crawler->selectButton('Confirmer')->form();
		$form['commande[dateVisite]'] = '2017-10-30';
		$form['commande[email]'] = 'bar.tom@gmail.com';
		$form['commande[type]'] = 'Journée';
		$form['commande[nbTicket]'] = 1;
		$form['commande[tickets][0][nom]'] = 'Bar';
		$form['commande[tickets][0][prenom]'] = 'Tom';
		$form['commande[tickets][0][pays]'] = 'FR';
		$form['commande[tickets][0][dateNaissance]'] = '1989-03-19';
		$form['commande[tickets][0][tarif_reduit]'] = 0;*/

		//$client->submit($form);

		//$crawler = $client->followRedirect();

		$this->assertSame(2, $crawler->filter('table')->count());

	}


	
}