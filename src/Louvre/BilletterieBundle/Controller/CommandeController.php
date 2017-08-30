<?php

namespace Louvre\BilletterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Ticket;
use Louvre\BilletterieBundle\Form\CommandeType;
use Louvre\BilletterieBundle\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;


class CommandeController extends Controller
{
    public function indexAction(Request $request)
    {
        
    	$order = new Commande();
    	$form = $this->get('form.factory')->create(CommandeType::class, $order);

    	if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		//$order->addTicket($ticket);
    		$em = $this->getDoctrine()->GetManager();
    		$em->persist($order);
    		$em->flush();

    		$request->getSession()->getFlashbag()->add('notice', 'Commande validée.');
            //return $this->render('LouvreBilletterieBundle:confirmation.html.twig');


    	}

        return $this->render('LouvreBilletterieBundle:Billetterie:index.html.twig', array(
        	'form' => $form->createView(),
        	));
    }
}
