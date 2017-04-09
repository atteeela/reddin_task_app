<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Tests\AppBundle\Helpers\LoginHelpers;
use AppBundle\Entity\User;

class HomeWelcomeController extends Controller
{
    /**
     * @Route("/home/welcome", name="home_welcome_index")
     */
    public function indexAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->render('home/welcome/index.html.twig', [
            'user' => $user,
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}

