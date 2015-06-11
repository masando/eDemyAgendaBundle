<?php

namespace eDemy\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use eDemy\MainBundle\Entity\BaseEntity;

/**
 * @ORM\Table(name="AgendaResponsable")
 * @ORM\Entity()
 */
class Responsable extends BaseEntity
{
    public function __construct($em = null)
    {
        parent::__construct($em);
        $this->actividades = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellido1() . ' ' . $this->getApellido2();
    }

    /**
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function showNombreInPanel()
    {
        return true;
    }

    public function shownombreInForm()
    {
        return true;
    }

    /**
     * @ORM\Column(name="apellido1", type="string", length=255, nullable=true)
     */
    protected $apellido1;

    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido1()
    {
        return $this->apellido1;
    }

    public function showapellido1InForm()
    {
        return true;
    }

    /**
     * @ORM\Column(name="apellido2", type="string", length=255, nullable=true)
     */
    protected $apellido2;

    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    public function getApellido2()
    {
        return $this->apellido2;
    }
    
    public function showapellido2InForm()
    {
        return true;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Actividad", mappedBy="responsables")
     */
    protected $actividades;

    public function addActividades(\eDemy\AgendaBundle\Entity\Actividad $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    public function removeActividades(\eDemy\AgendaBundle\Entity\Actividad $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    public function getActividades()
    {
        return $this->actividades;
    }

    public function addActividade(\eDemy\AgendaBundle\Entity\Actividad $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    public function removeActividade(\eDemy\AgendaBundle\Entity\Actividad $actividades)
    {
        $this->actividades->removeElement($actividades);
    }
    
    public function showmeta_descriptionInForm()
    {
        return false;
    }

    public function showmeta_keywordsInForm()
    {
        return false;
    }
}
