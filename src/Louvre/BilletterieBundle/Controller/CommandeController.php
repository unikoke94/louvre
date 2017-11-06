<?php

namespace Louvre\BilletterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Ticket;
use Louvre\BilletterieBundle\Form\CommandeType;
use Louvre\BilletterieBundle\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;
use Louvre\BilletterieBundle\Services\Prix\LouvrePrix;
use Louvre\BilletterieBundle\Services\Stripe\Stripe;


class CommandeController extends Controller
{
    public function indexAction(Request $request)
    {
    	$commande = new Commande();
    	$form = $this->get('form.factory')->create(CommandeType::class, $commande);

    	if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

           /* $jourChoisi = $form->get('dateVisite');
            $diff = $jourChoisi->diff(new\DateTime());
            $interval = $diff->d;

            if($interval > 0) {
                return $this->redirectToRoute('')
            } */

            $this->get('louvre_billetterie.prix')->prixCommande($commande);

            $this->get('session')->set('commande', $commande);
    		$request->getSession()->getFlashbag()->add('notice', 'Commande validée.');
            return $this->redirectToRoute('louvre_billetterie_paiement');

    	}

        return $this->render('LouvreBilletterieBundle:Billetterie:index.html.twig', array(
        	'form' => $form->createView(),
        	));
    }

    public function paiementAction(Request $request) {

    
        $commande = $request->getSession()->get('commande');

        if($commande == null) {
            throw new \Exception('Vous n\'avez rempli ancun billet.');
        }

        $limite = 1000;
        //On set la date de visite à tous les tickets de la commande
        $tickets = $commande->getTickets();
        foreach($tickets as $ticket) {
            $ticket->setDateVisite($commande->getDateVisite());
        }

        //On compte le nombre de tickets vendus à la date sélectionnée
        $em = $this->getDoctrine()->getManager();
        $ticketsVendus = $em->getRepository('LouvreBilletterieBundle:Ticket')->findBy(array('dateVisite' => $commande->getDateVisite()));
        $nombre = count($ticketsVendus);

        if($request->isMethod('POST')) {
            $token = $request->get('stripeToken');
            $key = $this->getParameter("secret_key");
            
            $this->get('louvre_billetterie.stripe')->charge($key, $token, ($commande->getPrixTotal()));    

            return $this->redirectToRoute('louvre_billetterie_confirmation');
        }

        return $this->render('LouvreBilletterieBundle:Billetterie:paiement.html.twig', array(
            'commande' => $commande,
            'limite' => $limite,
            'nombre' => $nombre,
            'public_key' => $this->getParameter('publishabled_key'),
            ));
    }


    public function confirmationAction(Request $request)
    {
        $commande = $request->getSession()->get('commande');

        if($commande == null) {
            throw new \Exception('Vous n\'avez pas encore commandé.');
        }

        $message = (new \Swift_Message('Votre réservation au musée du Louvre'))
            ->setFrom(array('tombar.test@gmail.com' => 'Musée du Louvre'))
            ->setTo($commande->getEmail())
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->renderView('LouvreBilletterieBundle:Billetterie:mail.html.twig', array('commande' => $commande)));

        $this->get('mailer')->send($message);

        $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
        
        return $this->render('LouvreBilletterieBundle:Billetterie:confirmation.html.twig', array(
            'commande' => $commande,
            ));
    }


    public function mentionsLegalesAction()
    {
        return $this->render('LouvreBilletterieBundle:Billetterie:mentions.html.twig');
    }

    public function cgvAction()
    {
        return $this->render('LouvreBilletterieBundle:Billetterie:cgv.html.twig');
    }
}
