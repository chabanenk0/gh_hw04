<?php

namespace chabanenk0\TestAssignmentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use chabanenk0\TestAssignmentBundle\Entity\Scale;
use chabanenk0\TestAssignmentBundle\Form\ScaleType;

/**
 * Scale controller.
 *
 * @Route("/scale")
 */
class ScaleController extends Controller
{

    /**
     * Lists all Scale entities.
     *
     * @Route("/", name="scale")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('chabanenk0TestAssignmentBundle:Scale')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Scale entity.
     *
     * @Route("/", name="scale_create")
     * @Method("POST")
     * @Template("chabanenk0TestAssignmentBundle:Scale:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Scale();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('scale_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Scale entity.
    *
    * @param Scale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Scale $entity)
    {
        $form = $this->createForm(new ScaleType(), $entity, array(
            'action' => $this->generateUrl('scale_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Scale entity.
     *
     * @Route("/new/{testid}", name="scale_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($testid=null)
    {
        $entity = new Scale();
        if ($testid) {
            $test = $this->getDoctrine()
                ->getRepository('chabanenk0TestAssignmentBundle:Test')
                ->findOneById($testid);
            $entity->setTestId($test);
        }

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Scale entity.
     *
     * @Route("/{id}", name="scale_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:Scale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Scale entity.
     *
     * @Route("/{id}/edit", name="scale_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:Scale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scale entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Scale entity.
    *
    * @param Scale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Scale $entity)
    {
        $form = $this->createForm(new ScaleType(), $entity, array(
            'action' => $this->generateUrl('scale_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Scale entity.
     *
     * @Route("/{id}", name="scale_update")
     * @Method("PUT")
     * @Template("chabanenk0TestAssignmentBundle:Scale:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('chabanenk0TestAssignmentBundle:Scale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Scale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('scale_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Scale entity.
     *
     * @Route("/{id}", name="scale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('chabanenk0TestAssignmentBundle:Scale')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Scale entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('scale'));
    }

    /**
     * Creates a form to delete a Scale entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scale_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
