<?php

namespace eDemy\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use eDemy\MainBundle\Entity\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="AgendaHorario")
 */
class Horario extends BaseEntity
{
    public function __toString()
    {
        return $this->getDia() . ' ' . $this->getHora();
    }

    /**
     * @ORM\Column(name="dia", type="string", length=255)
     */
    protected $dia;

    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    public function getDia()
    {
        return $this->dia;
    }

    /**
     * @ORM\Column(name="hora", type="string", length=255)
     */
    protected $hora;

    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @ORM\Column(name="duracion", type="integer")
     */
    protected $duracion;

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    protected $activo;

    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    public function isActivo()
    {
        return $this->activo;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    protected $observaciones;

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Actividad", inversedBy="horarios")
     */
    protected $actividad;

    public function setActividad(\eDemy\AgendaBundle\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

    public function getActividad()
    {
        return $this->actividad;
    }

    public function showdiaInForm()
    {
        return false;
    }

    public function showhoraInForm()
    {
        return false;
    }

    public function showduracionInForm()
    {
        return false;
    }

    public function showactivoInForm()
    {
        return false;
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
