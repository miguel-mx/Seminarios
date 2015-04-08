<?php

namespace proyecto1\SeminarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use proyecto1\SeminarioBundle\Entity\Aviso;
use proyecto1\SeminarioBundle\Form\AvisoType;

/**
 * Aviso controller.
 *
 */
class AvisoController extends Controller
{

    /**
     * Lists all Aviso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SeminarioBundle:Aviso')->findAll();

        return $this->render('SeminarioBundle:Aviso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Aviso entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Aviso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aviso_show', array('id' => $entity->getId())));
        }

        return $this->render('SeminarioBundle:Aviso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Aviso entity.
     *
     * @param Aviso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aviso $entity)
    {
        $form = $this->createForm(new AvisoType(), $entity, array(
            'action' => $this->generateUrl('aviso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aviso entity.
     *
     */
    public function newAction()
    {
        $entity = new Aviso();
        $form   = $this->createCreateForm($entity);

        return $this->render('SeminarioBundle:Aviso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Aviso entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Aviso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aviso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Aviso:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Aviso entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Aviso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aviso entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Aviso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Aviso entity.
    *
    * @param Aviso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aviso $entity)
    {
        $form = $this->createForm(new AvisoType(), $entity, array(
            'action' => $this->generateUrl('aviso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aviso entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Aviso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aviso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aviso_edit', array('id' => $id)));
        }

        return $this->render('SeminarioBundle:Aviso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Aviso entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SeminarioBundle:Aviso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aviso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aviso'));
    }

    /**
     * Creates a form to delete a Aviso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aviso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
