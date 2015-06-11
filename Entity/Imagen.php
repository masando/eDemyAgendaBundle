<?php

namespace eDemy\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use eDemy\MainBundle\Entity\BaseImagen;

/**
 * @ORM\Table("AgendaImagen")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Imagen extends BaseImagen
{
    /**
     * @ORM\ManyToOne(targetEntity="eDemy\AgendaBundle\Entity\Actividad", inversedBy="imagenes")
     */
    protected $actividad;

    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    public function getActividad()
    {
        return $this->actividad;
    }
}
