<?php

namespace proyecto1\SeminarioBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto1\SeminarioBundle\Entity\Seminario;
use proyecto1\SeminarioBundle\Entity\Evento;
use proyecto1\SeminarioBundle\Entity\Responsable;
use proyecto1\SeminarioBundle\Form\Seminario\EventoType;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SeminarioBundle:Default:index.html.twig', array('name' => $name));
    }
    /*public function menuAction()
    {
        return $this->render('SeminarioBundle:Default:menu.html.twig');
    }
    public function adminAction()
    {
        return new Response('Admin page!');
    }*/
}
