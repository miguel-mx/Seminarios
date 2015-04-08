<?php

namespace proyecto1\SeminarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aviso
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Aviso
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
     * @ORM\ManyToOne(targetEntity="proyecto1\SeminarioBundle\Entity\Responsable")
     * @ORM\JoinColumn(name="responsable_id", referencedColumnName="id")
     **/
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="aviso", type="text")
     */
    private $aviso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cap", type="datetime")
     */
    private $fechaCap;

    public function __construct()
    {
        $this->fechaCap = new \DateTime();
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
     * Set responsable
     *
     * @param \proyecto1\SeminarioBundle\Entity\Responsable $responsable
     * @return Aviso
     */
    public function setResponsable(\proyecto1\SeminarioBundle\Entity\Responsable $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \proyecto1\SeminarioBundle\Entity\Responsable
     */
    public function getResponsable()
    {

        return $this->responsable;
    }

    /**
     * Set aviso
     *
     * @param string $aviso
     * @return Aviso
     */
    public function setAviso($aviso)
    {
        $this->aviso = $aviso;

        return $this;
    }

    /**
     * Get aviso
     *
     * @return string 
     */
    public function getAviso()
    {
        return $this->aviso;
    }

    /**
     * Set fechaCap
     *
     * @param \DateTime $fechaCap
     * @return Aviso
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
}
