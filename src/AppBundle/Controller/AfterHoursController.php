<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ActivityList;

class AfterHoursController extends Controller
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
     * @Route("/kontakt/", name="contacts")
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
    public function createMeetAction(Request $request, $id)
    {
        $post = new ActivityList();

        $post->setDate(new \DateTime);
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

        $repository = $em->getRepository('AppBundle:ActivityList');
        $obiect = $repository->find($id);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $post->setName($obiect);// ustawić obiekt

            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('list');

        }
        return $this->render('AppBundle:View:post.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/list/", name="list")
     *
     */
    public function ActivityListAction()
    {

        $em = $this->getDoctrine()->getManager();

        $activityList = $em->getRepository('AppBundle:ActivityList')->findAll();

        $repository = $em->getRepository('AppBundle:Activity')->findAll();

        return $this->render('AppBundle:View:activityList.html.twig', ['activityList' => $activityList, 'repository' => $repository]);


    }

    /**
     * @Route("/list/joinMeeting/{id}", name="join_meeting")
     *
     */
    public function MeetAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:ActivityList');
        $obiect = $repository->find($id);

        $user = $this->getUser();
        $obiect->addUser($user);
        $user->addActivity($obiect);

        $em->persist($user);
        $em->persist($obiect);
        $em->flush();

        return $this->redirectToRoute('list');
    }

    public function confirmedAction()
    {
        return $this->redirectToRoute('homepage');
    }
}