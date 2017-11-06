<?php

namespace Louvre\BilletterieBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Louvre\BilletterieBundle\Entity\Ticket;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateVisite", type="date")
     */
    private $dateVisite;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTicket", type="smallint")
     */
    private $nbTicket;

    /**
     * @var int
     *
     * @ORM\Column(name="prixTotal", type="smallint")
     */
    private $prixTotal;


    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;


    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;



    /**
     * @ORM\OneToMany(targetEntity="Louvre\BilletterieBundle\Entity\Ticket", mappedBy="commande", cascade={"persist"})
     */
    private $tickets;


    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->code = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateVisite
     *
     * @param \DateTime $dateVisite
     *
     * @return Commande
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Commande
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nbTicket
     *
     * @param integer $nbTicket
     *
     * @return Commande
     */
    public function setNbTicket($nbTicket)
    {
        $this->nbTicket = $nbTicket;

        return $this;
    }

    /**
     * Get nbTicket
     *
     * @return int
     */
    public function getNbTicket()
    {
        return $this->nbTicket;
    }



    public function getTickets()
    {
        return $this->tickets;
    }




    public function setTickets(Ticket $tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }



    public function getPrix()
    {
        return $this->prix;
    }


    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Add ticket
     *
     * @param \Louvre\BilletterieBundle\Entity\Ticket $ticket
     *
     * @return Commande
     */
    public function addTicket(\Louvre\BilletterieBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        $ticket->setCommande($this);

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Louvre\BilletterieBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\Louvre\BilletterieBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Set code
     *
     * @param $code
     *
     * @return Commande
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set prixTotal
     *
     * @param integer $prixTotal
     *
     * @return Commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return integer
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
