<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\Post;
use Acme\DemoBundle\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Gedmo\Mapping\Annotation as Gedmo;


class PostController extends Controller
{
    public function indexAction(Request $request, $id=-1)
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        $post =  new Post();
        $guestForm = $this->createForm(new PostType(), $post);
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == 'POST') {
            $guestForm->bind($request);
            if ($id >= 0) {
                $test = $em->getRepository('AcmeDemoBundle:TestAssignment')->findOneById($id);
                $post->setTestReference($test);
            }
            if ($guestForm->isValid()) {
                $em->persist($post);
                $em->flush();

                return $this->redirect($this->generateUrl('_guestbook'));
            }
        }

        $dql   = "SELECT a FROM AcmeDemoBundle:Post a";
        $query = $em->createQuery($dql);

        
        //$limitPerPage =  $this->container->getParameter('knp_paginator.page_range');
    
        //$paginator  = $this->get('knp_paginator');
        //$pagination = $paginator->paginate(
        //    $query,
        //    $this->get('request')->query->get('page', 1)/*page number*/,
        //    $limitPerPage/*limit per page*/
        //);

        // parameters to template
        //return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));

        $posts = $em->getRepository('AcmeDemoBundle:Post')->findAll();

        return $this->render('AcmeDemoBundle:Post:index2.html.twig',array(
            'entity' => $post,
            'form' => $guestForm->createView(),
            'posts' => $posts//,
            //'pagination' => $pagination
        ));
    }
}
