<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chabanenk0\TestAssignmentBundle\Entity\MultiCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Form\MultiCaseTestQuestionType;

/**
 * MultiCaseTestQuestion controller.
 *
 */
class MultiCaseTestQuestionController extends Controller
{

    /**
     * Lists all MultiCaseTestQuestion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion')->findAll();

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new MultiCaseTestQuestion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new MultiCaseTestQuestion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('multicasetestquestion_show', array('id' => $entity->getId())));
        }

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a MultiCaseTestQuestion entity.
    *
    * @param MultiCaseTestQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(MultiCaseTestQuestion $entity)
    {
        $form = $this->createForm(new MultiCaseTestQuestionType(), $entity, array(
            'action' => $this->generateUrl('multicasetestquestion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MultiCaseTestQuestion entity.
     *
     */
    public function newAction($testid)
    {
        $entity = new MultiCaseTestQuestion();
        if ($testid) {
            $test = $this->getDoctrine()
                ->getRepository('chabanenk0TestAssignmentBundle:Test')
                ->findOneById($testid);
            $entity->setTestId($test);
        }

        $form   = $this->createCreateForm($entity);

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MultiCaseTestQuestion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiCaseTestQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing MultiCaseTestQuestion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiCaseTestQuestion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a MultiCaseTestQuestion entity.
    *
    * @param MultiCaseTestQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MultiCaseTestQuestion $entity)
    {
        $form = $this->createForm(new MultiCaseTestQuestionType(), $entity, array(
            'action' => $this->generateUrl('multicasetestquestion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MultiCaseTestQuestion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MultiCaseTestQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('multicasetestquestion_edit', array('id' => $id)));
        }

        return $this->render('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a MultiCaseTestQuestion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chabanenk0TestAssignmentBundle:MultiCaseTestQuestion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MultiCaseTestQuestion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('multicasetestquestion'));
    }

    /**
     * Creates a form to delete a MultiCaseTestQuestion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('multicasetestquestion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
