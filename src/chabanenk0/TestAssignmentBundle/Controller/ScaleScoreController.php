<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chabanenk0\TestAssignmentBundle\Entity\ScaleScore;
use chabanenk0\TestAssignmentBundle\Form\ScaleScoreType;

/**
 * ScaleScore controller.
 *
 */
class ScaleScoreController extends Controller
{

    /**
     * Lists all ScaleScore entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chabanenk0TestAssignmentBundle:ScaleScore')->findAll();

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ScaleScore entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ScaleScore();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('scalescore_show', array('id' => $entity->getId())));
        }

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ScaleScore entity.
    *
    * @param ScaleScore $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ScaleScore $entity)
    {
        $form = $this->createForm(new ScaleScoreType(), $entity, array(
            'action' => $this->generateUrl('scalescore_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ScaleScore entity.
     *
     */
    public function newAction()
    {
        $entity = new ScaleScore();
        $form   = $this->createCreateForm($entity);

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ScaleScore entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:ScaleScore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScaleScore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ScaleScore entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:ScaleScore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScaleScore entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ScaleScore entity.
    *
    * @param ScaleScore $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ScaleScore $entity)
    {
        $form = $this->createForm(new ScaleScoreType(), $entity, array(
            'action' => $this->generateUrl('scalescore_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ScaleScore entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:ScaleScore')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScaleScore entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('scalescore_edit', array('id' => $id)));
        }

        return $this->render('chabanenk0TestAssignmentBundle:ScaleScore:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ScaleScore entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chabanenk0TestAssignmentBundle:ScaleScore')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScaleScore entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('scalescore'));
    }

    /**
     * Creates a form to delete a ScaleScore entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scalescore_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
