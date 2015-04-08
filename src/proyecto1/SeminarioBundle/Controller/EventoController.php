<?php

namespace proyecto1\SeminarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use proyecto1\SeminarioBundle\Entity\Evento;
use proyecto1\SeminarioBundle\Form\EventoType;

/**
 * Evento controller.
 *
 */
class EventoController extends Controller
{
    public function anterioresAction($seminario)
    {

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SeminarioBundle:Seminario')->findEventosAnteriores($seminario);
        //findOneBy(array('ciudad' => $ciudad, 'fecha_publicacion' => new \DateTime('today')));

        if(!$entities)
        {
            throw $this->createNotFoundException('No se han encontrado eventos anteriores');
        }
        return $this->render('SeminarioBundle:Evento:eventos_ant.html.twig', array(
            'entities' => $entities,
        ));

    }
    public function semanaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SeminarioBundle:Seminario')->findEventosSemana();
        if(!$entities)
        {
            throw $this->createNotFoundException('No se han encontrado eventos anteriores');
        }
        return $this->render('SeminarioBundle:Evento:eventos_semanal.html.twig', array(
            'entities' => $entities,
        ));

    }
    public function semanasigAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SeminarioBundle:Seminario')->findEventosSemanaSig();
        if(!$entities)
        {
            throw $this->createNotFoundException('No se han encontrado eventos anteriores');
        }
        return $this->render('SeminarioBundle:Evento:eventos_sig_semana.html.twig', array(
            'entities' => $entities,
        ));

    }

    /**
     * Lists all Evento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SeminarioBundle:Evento')->findAll();

        return $this->render('SeminarioBundle:Evento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Evento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Evento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evento_show', array('id' => $entity->getId())));
        }

        return $this->render('SeminarioBundle:Evento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Evento entity.
     *
     * @param Evento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('evento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Evento entity.
     *
     */
    public function newAction()
    {

        $entity = new Evento();
        $form   = $this->createCreateForm($entity);

        return $this->render('SeminarioBundle:Evento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Evento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Evento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Evento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Evento')->find($id);
        $fecha = new \DateTime('now');
        $efecha = $entity->getFecha();
        if ( $efecha < $fecha ) {
            throw $this->createNotFoundException('No se puede editar.');
        }
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Evento entity.
    *
    * @param Evento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('evento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Evento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('evento_edit', array('id' => $id)));
        }

        return $this->render('SeminarioBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Evento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SeminarioBundle:Evento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evento'));
    }

    /**
     * Creates a form to delete a Evento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function icsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $eventos_semana = $em->getRepository('SeminarioBundle:Seminario')->findEventosToCalendar();



        $provider = $this->get('bomo_ical.ics_provider');

        $tz = $provider->createTimezone();
        $tz
            ->setTzid('America/Mexico_City')
            ->setProperty('X-LIC-LOCATION', $tz->getTzid())
            ;

        $cal = $provider->createCalendar($tz);

        $cal
            ->setName('Seminarios CCM UNAM')
            ->setDescription('Calendario de Coloquio y Seminario CCM-UNAM Campus Morelia')
        ;

        $datetime = new \Datetime('2015-03-23 13:00');
        $cad='';
        foreach ($eventos_semana as $evento_semana) {
            $fecha= $evento_semana->getFecha();
            $hora= $evento_semana->getHora();

            $fechahora = new \DateTime($fecha->format('Y-m-d') .' ' .$hora->format('H:i:s'));

            $nombre = $evento_semana->getSeminario()->getNombre();
            $descripcion = $evento_semana->getPlatica();
            $comentario = $evento_semana->getComent();
            $localizacion = $evento_semana->getOrigen();
            $organizador = $evento_semana->getOrigen();
            $cad= $cad.$nombre."<br/>".$comentario;


            $event = $cal->newEvent();
            $event
                ->setStartDate($fechahora)
                ->setEndDate($datetime->modify('+1 hours'))
                ->setName($nombre)
                ->setDescription($descripcion)
                ->setComment($comentario)
                ->setLocation($localizacion)
                ->setOrganizer($organizador)
            ;
        }

        $calStr = $cal->returnCalendar();

        return new Response(
            $calStr,
            200,
            array(
                'Content-Type' => 'text/calendar; charset=utf-8',
                'Content-Disposition' => 'attachment; filename="calendar.ics"',
            )
        );
    }
    public function mailAction()
    {
        $em = $this->getDoctrine()->getManager();
        $eventos_semana = $em->getRepository('SeminarioBundle:Seminario')->findEventosSemana();
        //$hola = $eventos_semana[0]->getPlatica();
        $cad='';
        foreach ($eventos_semana as $evento_semana) {
            $fecha = $evento_semana->getFecha();
            $hora = $evento_semana->getHora();

            $fechahora = new \DateTime($fecha->format('Y-m-d') . ' ' . $hora->format('H:i:s'));

            $nombre = $evento_semana->getSeminario()->getResponsables();
            $res= $nombre[0];
            $descripcion = $evento_semana->getPlatica();
            $comentario = $evento_semana->getResumen();
            $localizacion = $evento_semana->getOrigen();
            $organizador = $evento_semana->getOrigen();
            $cad = $res . "\n" . $comentario."\n".$cad."\n";
        }
        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject('Seminarios de la semana Centro de Ciencias Matemáticas XD')
            ->setFrom('usuariosccm15@gmail.com')
            ->setTo('abner1991@outlook.es'
               # 'abner1991@outlook.es'=> 'A name'
            )
            ->setBody($cad)
            //->addPart($hola.'<br>'.'<q>Here is the message itself</q>', 'text/html')
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $mailer->send($message);
        //$request->getSession()->getFlashBag()->add('success', 'Your email has been sent! Thanks!');
        //return $this->render('SeminarioBundle:Evento:otra.html.twig');
        //return $this->redirectToRoute('eventos_semana');
        return $this->redirect($this->generateUrl('eventos_semana'));

    }


}


