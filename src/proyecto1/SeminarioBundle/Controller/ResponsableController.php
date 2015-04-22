<?php

namespace proyecto1\SeminarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use proyecto1\SeminarioBundle\Entity\Responsable;
use proyecto1\SeminarioBundle\Form\ResponsableType;

/**
 * Responsable controller.
 *
 */
class ResponsableController extends Controller
{

    /**
     * Lists all Responsable entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SeminarioBundle:Responsable')->findAll();

        return $this->render('SeminarioBundle:Responsable:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Responsable entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Responsable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Your changes were saved!'
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('responsable_show', array('id' => $entity->getId())));
        }

        return $this->render('SeminarioBundle:Responsable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Responsable entity.
     *
     * @param Responsable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Responsable $entity)
    {
        $form = $this->createForm(new ResponsableType(), $entity, array(
            'action' => $this->generateUrl('responsable_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Responsable entity.
     *
     */
    public function newAction()
    {
        $entity = new Responsable();
        $form   = $this->createCreateForm($entity);

        return $this->render('SeminarioBundle:Responsable:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Responsable entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Responsable:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Responsable entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SeminarioBundle:Responsable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Responsable entity.
    *
    * @param Responsable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Responsable $entity)
    {
        $form = $this->createForm(new ResponsableType(), $entity, array(
            'action' => $this->generateUrl('responsable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Responsable entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SeminarioBundle:Responsable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Responsable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Tus cambios fueron guardados!'
            );
            return $this->redirect($this->generateUrl('responsable_edit', array('id' => $id)));
        }

        return $this->render('SeminarioBundle:Responsable:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Responsable entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SeminarioBundle:Responsable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Responsable entity.');
            }
            $request->getSession()->getFlashBag()->add(
                'notice',
                'Responsable eliminado exitosamente!'
            );

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('responsable'));
    }

    /**
     * Creates a form to delete a Responsable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn btn-danger'),))
            ->getForm()
        ;
    }
}
