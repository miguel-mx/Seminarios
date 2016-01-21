<?php

namespace proyecto1\SeminarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seminario
 *
 * @ORM\Table()
 * @ORM\Entity
 */

/**
* @ORM\Entity(repositoryClass="proyecto1\SeminarioBundle\Entity\SeminarioRepository")
*/

class Seminario
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=255)
     */
    private $lugar;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estatus", type="boolean")
     */
    private $estatus;

    /**
     * @ORM\ManyToMany(targetEntity="Responsable", inversedBy="seminarios")
     * @ORM\JoinTable(name="seminarios_responsables")
     **/
    private $responsables;


    public function __construct() {
        $this->responsables = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function addResponsable(Responsable $responsable)
    {
        $responsable->addSeminario($this); // synchronously updating inverse side
        $this->responsables[] = $responsable;
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
     * Set nombre
     *
     * @param string $nombre
     * @return Seminario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Seminario
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
     * Set hora
     *
     * @param string $hora
     * @return Seminario
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return string 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set estatus
     *
     * @param boolean $estatus
     * @return Seminario
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return boolean 
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    public function __toString()
    {
    return $this->getNombre();
    }


    /**
     * Remove responsables
     *
     * @param \proyecto1\SeminarioBundle\Entity\Responsable $responsables
     */
    public function removeResponsable(\proyecto1\SeminarioBundle\Entity\Responsable $responsables)
    {
        $this->responsables->removeElement($responsables);
    }

    /**
     * Get responsables
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
     * Get responsablesStr
     *
     * @return string
     */
    public function getResponsablesStr()
    {
        $listaResp= "";

        foreach($this->responsables as $resp){

            $listaResp .= $resp->getNombre() . ' ' . $resp->getApellidos() . ', ';

        }

        // Borra la última coma
        if(strlen($listaResp))
            $listaResp = substr($listaResp, 0, -2);

        return $listaResp;
    }

}
