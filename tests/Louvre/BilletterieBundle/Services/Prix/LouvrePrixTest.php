<?php 

namespace Test\BilletterieBundle\Services\Prix;

use PHPUnit\Framework\TestCase;
use Louvre\BilletterieBundle\Services\Prix\LouvrePrix;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Ticket;



class LouvrePrixTest extends TestCase
{

	public function testPrixCommandeOk()
	{
		$ticket1 = new Ticket();
		$ticket2 = new Ticket();
		$commande = new Commande();
		$service = new LouvrePrix();


		$ticket1
			->setNom('Abc')
			->setPrenom('Def')
			->setPays('FR')
			->setDateNaissance(new \DateTime('1989-03-19'))
			->setDateVisite(new \DateTime('2017-12-10'))
			->setTarifReduit(0)
			->setCommande($commande);

		$ticket2
			->setNom('Ghi')
			->setPrenom('Jkl')
			->setPays('FR')
			->setDateNaissance(new \DateTime('1992-04-28'))
			->setDateVisite(new \DateTime('2017-12-10'))
			->setTarifReduit(1)
			->setCommande($commande);


		$commande
			->setDateVisite('2017-12-10')
			->setType('Journée')
			->setNbTicket(2)
			->setEmail('barriac.thomas@laposte.net')
			->addTicket($ticket1)
			->addTicket($ticket2);


		$service->prixCommande($commande);	
		$result = $commande->getPrixTotal();

		$this->assertSame(26, $result);			
	}


	public function testNegativeOrNullPrixCommande()
	{
		$ticket = new Ticket();
		$commande = new Commande();
		$service = new LouvrePrix();


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


		$this->expectException('LogicException');

		$service->prixCommande($commande);
	}
}