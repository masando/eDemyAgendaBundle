<?php

namespace eDemy\AgendaBundle\Controller;

use eDemy\MainBundle\Controller\BaseController;
use eDemy\MainBundle\Event\ContentEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use eDemy\MainBundle\Entity\Param;

class AgendaController extends BaseController
{
    public static function getSubscribedEvents()
    {
        return self::getSubscriptions('agenda', ['actividad', 'responsable', 'horario', 'imagen'], array(
            'edemy_agenda_actividad_frontpage_lastmodified' => array('onActividadFrontpageLastModified', 0),
            'edemy_agenda_frontpage_cache_validation' => array('onCacheValidation', 0),
            'edemy_agenda_actividad_details_lastmodified' => array('onActividadDetailsLastModified', 0),
            'edemy_agenda_actividad_details' => array('onActividadDetails', 0),
            'edemy_agenda_frontpage'                        => array('onFrontpage', 0),
            'edemy_mainmenu'                        => array('onAgendaMainMenu', 0),
        ));
    }

    public function onAgendaMainMenu(GenericEvent $menuEvent) {
        $items = array();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $item = new Param($this->get('doctrine.orm.entity_manager'));
            $item->setName('Admin_Agenda');
            if($namespace = $this->getNamespace()) {
                $namespace .= ".";
            }
            $item->setValue($namespace . 'edemy_agenda_actividad_index');
            $items[] = $item;
        }

        $menuEvent['items'] = array_merge($menuEvent['items'], $items);

        return true;
    }

    public function onFrontpage(ContentEvent $event)
    {
        $this->get('edemy.meta')->setTitlePrefix("Agenda");
    }

    public function onActividadFrontpageLastModified(ContentEvent $event)
    {
        $entity = $this->getRepository('edemy_agenda_actividad_frontpage')->findLastModified($this->getNamespace());
        //die(var_dump($actividad->getUpdated()));        
        $lastmodified = $entity->getUpdated();
//        $lastmodified_files = $this->getLastModifiedFiles('/../../AgendaBundle/Resources/views', '*.html.twig');
        $lastmodified_files = null;
        if($lastmodified_files > $lastmodified) {
            $lastmodified = $lastmodified_files;
        }

        $event->setLastModified($lastmodified);

        return true;
    }

    public function onActividadFrontpage(ContentEvent $event) {
        $this->get('edemy.meta')->setTitlePrefix("Actividades");

        $this->addEventModule($event, 'templates/agenda/agenda_actividad_frontpage', array(
            'entities' => $this->getRepository($event->getRoute())->findAllOrdered($this->getNamespace()),
        ));
    }

    public function onActividadDetailsLastModified(ContentEvent $event)
    {
        $entity = $this->getRepository($event->getRoute())->findOneBy(array(
            'slug'        => $this->getRequestParam('slug'),
            'namespace' => $this->getNamespace(),
        ));
        //die(var_dump($entity));
        if (!$entity) {
            throw $this->createNotFoundException('Objeto no encontrado');
        }
        if($entity->getUpdated()) {
            //die(var_dump($entity->getUpdated()));
            $event->setLastModified($entity->getUpdated());
        }
    }

    public function onActividadDetails(ContentEvent $event) {
        $entity = $this->getRepository($event->getRoute())->findOneBy(array(
            'namespace' => $this->getNamespace(),
            'slug'        => $this->getRequestParam('slug'),
        ));
        if (!$entity) {
            throw $this->createNotFoundException('Actividad no encontrada.');
        }

        $this->get('edemy.meta')->setTitlePrefix($entity->getNombre() . ' Elda Petrer');
        $this->get('edemy.meta')->setDescription($entity->getMetaDescription());
        $this->get('edemy.meta')->setKeywords($entity->getMetaKeywords());

        $this->addEventModule($event, 'templates/agenda/agenda_actividad_details', array(
            'entity' => $entity,
        ));
    }

    public function onResponsableFrontpage(ContentEvent $event) {}

    public function onHorarioFrontpage(ContentEvent $event) {}

    public function onCacheValidation(ContentEvent $event) {
        $event->stopPropagation();
    }
}
