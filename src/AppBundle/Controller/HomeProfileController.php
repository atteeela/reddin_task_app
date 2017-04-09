<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class HomeProfileController extends Controller
{
    /**
     * @Route("/home/profile/edit", name="home_profile_edit")
     */
    public function editAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createFormBuilder($user, array(
            'validation_groups' => array('Profile')
        ))
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('update_profile', SubmitType::class, array('label' => 'Update profile'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', "Your profile was successfully updated!");
            return $this->redirectToRoute('home_profile_edit');
        }

        // Handle updating the password and rest of profile
        // Todo: Why must we include the names in the update?
        // Investigate why it is so hard to update just certain fields
        $form_password = $this->createFormBuilder($user, array(
            'validation_groups' => array('Profile')
        ))
            ->add('first_name', HiddenType::class, array('mapped' => true))
            ->add('last_name', HiddenType::class, array('mapped' => true))
            ->add('password', PasswordType::class)
            ->add('update_password', SubmitType::class, array('label' => 'Update password'))
            ->getForm();

        $form_password->handleRequest($request);

        if ($form_password->isSubmitted() && $form_password->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form_password->getData();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', "Your password was successfully updated!");
            return $this->redirectToRoute('home_profile_edit');
        }

        return $this->render('home/profile/edit.html.twig', [
            'form' => $form->createView(),
            'form_password' => $form_password->createView(),
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }
}

