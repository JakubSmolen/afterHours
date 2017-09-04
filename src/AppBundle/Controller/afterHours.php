<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Activity;
use AppBundle\Entity\ActivityList;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class afterHours extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     */
    public function homePageAction()
    {

        $em = $this->getDoctrine()->getManager();

        $activity = $em->getRepository('AppBundle:Activity')->findAll();
        return $this->render('AppBundle:View:homepage.html.twig', ['activity' => $activity]);


    }

    /**
     * @Route("/kontakt", name="contacts")
     *
     */
    public function ContactAction()
    {
        return $this->render('AppBundle:View:contact.html.twig');
    }

    /**
     * @Route("/post/{id}")
     *
     */
    public function createMeetAction($id)
    {
        $post = new ActivityList();
        $form = $this->createFormBuilder($post)
            ->add('placeMeeting', 'text', [
                'required' => true,
                'label' => 'Miejsce spotania'])
            ->add('date', 'datetime', [
                'required' => true,
                'label' => 'Podaj datę i czas spotania'])
            ->add('description', 'textarea', [
                'required' => false,
                'label' => 'Opisz Spotkanie'])
            ->add('save', 'submit', ['label' => 'Create meet'])
            ->getForm();

        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('AppBundle:Activity')->findAll();

        return $this->render('AppBundle:View:post.html.twig', ['form' => $form->createView()]);

    }

}