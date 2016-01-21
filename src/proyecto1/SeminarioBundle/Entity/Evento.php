<?php

namespace proyecto1\SeminarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evento
 *
 * @ORM\Table()
 * @ORM\Entity
 */

/**
 * @ORM\Entity(repositoryClass="proyecto1\SeminarioBundle\Entity\SeminarioRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="proyecto1\SeminarioBundle\Entity\Seminario")
     * @ORM\JoinColumn(name="seminario_id", referencedColumnName="id")
     **/
    private $seminario;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=255)
     */
    private $lugar;

    /**
     * @var string
     *
     * @ORM\Column(name="responsables", type="string", length=255)
     */
    private $responsables;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="ponente", type="string", length=255)
     */
    private $ponente;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255)
     */
    private $origen;

    /**
     * @var string
     *
     * @ORM\Column(name="platica", type="string", length=255)
     */
    private $platica;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="text",nullable=true)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="coment", type="text",nullable=true)
     */
    private $coment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cap", type="datetime")
     */
    private $fechaCap;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modified;

    public function __construct()
    {
       // $this->fechaCap = new \DateTime();
    }


    /**
 * @ORM\PrePersist
 */
    public function prePersist()
    {
        $this->fechaCap = new \DateTime();
        $this->setModified(new \DateTime());
    }
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModified(new \DateTime());
    }

    /**
     * Set modified
     *
     * @param datetime $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }
    /**
     * Get modified
     *
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Evento
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set responsables
     *
     * @param string $responsables
     * @return Evento
     */
    public function setResponsables($responsables)
    {
        $this->responsables = $responsables;

        return $this;
    }

    /**
     * Get responsables
     *
     * @return string
     */
    public function getResponsables()
    {
        return $this->responsables;
    }


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Evento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     * @return Evento
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set ponente
     *
     * @param string $ponente
     * @return Evento
     */
    public function setPonente($ponente)
    {
        $this->ponente = $ponente;

        return $this;
    }

    /**
     * Get ponente
     *
     * @return string 
     */
    public function getPonente()
    {
        return $this->ponente;
    }

    /**
     * Set origen
     *
     * @param string $origen
     * @return Evento
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set platica
     *
     * @param string $platica
     * @return Evento
     */
    public function setPlatica($platica)
    {
        $this->platica = $platica;

        return $this;
    }

    /**
     * Get platica
     *
     * @return string 
     */
    public function getPlatica()
    {
        return $this->platica;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Evento
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set coment
     *
     * @param string $coment
     * @return Evento
     */
    public function setComent($coment)
    {
        $this->coment = $coment;

        return $this;
    }

    /**
     * Get coment
     *
     * @return string 
     */
    public function getComent()
    {
        return $this->coment;
    }

    /**
     * Set fechaCap
     *
     * @param \DateTime $fechaCap
     * @return Evento
     */
    public function setFechaCap($fechaCap)
    {
        $this->fechaCap = $fechaCap;

        return $this;
    }

    /**
     * Get fechaCap
     *
     * @return \DateTime
     */
    public function getFechaCap()
    {
        return $this->fechaCap;
    }

    /**
     * Set seminario
     *
     * @param \proyecto1\SeminarioBundle\Entity\Seminario $seminario
     * @return Evento
     */
    public function setSeminario(\proyecto1\SeminarioBundle\Entity\Seminario $seminario = null)
    {
        $this->seminario = $seminario;

        return $this;
    }

    /**
     * Get seminario
     *
     * @return \proyecto1\SeminarioBundle\Entity\Seminario 
     */
    public function getSeminario()
    {
        return $this->seminario;
    }


}
