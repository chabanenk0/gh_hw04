<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use chabanenk0\TestAssignmentBundle\Entity\OneCaseTestQuestion;
use chabanenk0\TestAssignmentBundle\Form\OneCaseTestQuestionType;

/**
 * OneCaseTestQuestion controller.
 *
 */
class OneCaseTestQuestionController extends Controller
{

    /**
     * Lists all OneCaseTestQuestion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chabanenk0TestAssignmentBundle:OneCaseTestQuestion')->findAll();

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new OneCaseTestQuestion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OneCaseTestQuestion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('onecasetestquestion_show', array('id' => $entity->getId())));
        }

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a OneCaseTestQuestion entity.
    *
    * @param OneCaseTestQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(OneCaseTestQuestion $entity)
    {
        $form = $this->createForm(new OneCaseTestQuestionType(), $entity, array(
            'action' => $this->generateUrl('onecasetestquestion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OneCaseTestQuestion entity.
     *
     */
    public function newAction($testid)
    {
        $entity = new OneCaseTestQuestion();
        if ($testid) {
            $test = $this->getDoctrine()
                ->getRepository('chabanenk0TestAssignmentBundle:Test')
                ->findOneById($testid);
            $entity->setTestId($test);
        }

        $form   = $this->createCreateForm($entity);

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OneCaseTestQuestion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:OneCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OneCaseTestQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing OneCaseTestQuestion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:OneCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OneCaseTestQuestion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OneCaseTestQuestion entity.
    *
    * @param OneCaseTestQuestion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OneCaseTestQuestion $entity)
    {
        $form = $this->createForm(new OneCaseTestQuestionType(), $entity, array(
            'action' => $this->generateUrl('onecasetestquestion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OneCaseTestQuestion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:OneCaseTestQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OneCaseTestQuestion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('onecasetestquestion_edit', array('id' => $id)));
        }

        return $this->render('chabanenk0TestAssignmentBundle:OneCaseTestQuestion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OneCaseTestQuestion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chabanenk0TestAssignmentBundle:OneCaseTestQuestion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OneCaseTestQuestion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('onecasetestquestion'));
    }

    /**
     * Creates a form to delete a OneCaseTestQuestion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('onecasetestquestion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
