<?php

namespace eDemy\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use eDemy\MainBundle\Entity\BaseEntity;
use eDemy\AgendaBundle\Entity\Imagen;

/**
 * @ORM\Entity(repositoryClass="eDemy\AgendaBundle\Entity\ActividadRepository")
 * @ORM\Table(name="AgendaActividad")
 */
class Actividad extends BaseEntity
{
    public function __construct($em = null)
    {
        parent::__construct($em);
        $this->imagenes = new ArrayCollection();
        $this->responsables = new ArrayCollection();
        $this->horarios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
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

    public function showNombreInForm()
    {
        return true;
    }

    /**
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    protected $description;

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @ORM\ManyToMany(targetEntity="Responsable", inversedBy="actividades", cascade={"persist"})
     */
    protected $responsables;


    public function getResponsables()
    {
        return $this->responsables;
    }
    
    public function addResponsable(\eDemy\AgendaBundle\Entity\Responsable $responsable)
    {
        $this->responsables[] = $responsable;

        return $this;
    }

    public function removeResponsable(\eDemy\AgendaBundle\Entity\Responsable $responsable)
    {
        $this->responsables->removeElement($responsable);
    }

    public function setResponsables(ArrayCollection $responsables)
    {
        $this->responsables = $responsable;
    }

    /**
     * @ORM\OneToMany(targetEntity="Horario", mappedBy="actividad", cascade={"persist","remove"})
     */
    protected $horarios;


    public function getHorarios()
    {
        return $this->horarios;
    }

    public function addHorario(Horario $horario)
    {
        $horario->setActividad($this);
        $this->horarios->add($horario);
    }

    public function removeHorario(Horario $horario)
    {
        $this->horarios->removeElement($horario);
        $this->getEntityManager()->remove($horario);
    }

    /**
     * @ORM\OneToMany(targetEntity="Imagen", mappedBy="actividad", cascade={"persist","remove"})
     */
    protected $imagenes;


    public function getImagenes()
    {
        return $this->imagenes;
    }

    public function addImagen(Imagen $imagen)
    {
        $imagen->setActividad($this);
        $this->imagenes->add($imagen);
    }

    public function removeImagen(Imagen $imagen)
    {
        $this->imagenes->removeElement($imagen);
        $this->getEntityManager()->remove($imagen);
    }

    public function showmeta_descriptionInForm()
    {
        return true;
    }

    public function showmeta_keywordsInForm()
    {
        return true;
    }
    
    public function showNamespaceInForm() {
        return true;
    }
}
