<?php

namespace proyecto1\SeminarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto1\SeminarioBundle\Entity\Responsable;

use proyecto1\SeminarioBundle\Entity\Seminario;
use proyecto1\SeminarioBundle\Form\SeminarioType;

/**
 * Seminario controller.
 *
 */
class SeminarioController extends Controller
{

    /**
     * Lists all Seminario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SeminarioBundle:Seminario')->findAll();

        return $this->render('SeminarioBundle:Seminario:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Seminario entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Seminario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seminario_show', array('id' => $entity->getId())));
        }

        return $this->render('SeminarioBundle:Seminario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Seminario entity.
     *
     * @param Seminario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Seminario $entity)
    {
        $form = $this->createForm(new SeminarioType(), $entity, array(
            'action' => $this->generateUrl('seminario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Seminario entity.
     *
     */
    public function newAction()
    {
        $entity = new Seminario();
        $form   = $this->createCreateForm($entity);

        return $this->render('SeminarioBundle:Seminario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Seminario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Seminario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seminario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Seminario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seminario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Seminario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seminario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Seminario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Seminario entity.
    *
    * @param Seminario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Seminario $entity)
    {
        $form = $this->createForm(new SeminarioType(), $entity, array(
            'action' => $this->generateUrl('seminario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Seminario entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Seminario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seminario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('seminario_edit', array('id' => $id)));
        }

        return $this->render('SeminarioBundle:Seminario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Seminario entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SeminarioBundle:Seminario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seminario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seminario'));
    }

    /**
     * Creates a form to delete a Seminario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seminario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
