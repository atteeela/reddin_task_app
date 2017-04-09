<?php

namespace Tests\AppBundle\Helpers;
use AppBundle\Entity\User;

class LoginHelpers
{
    /**
     * Initiate a login for the user
     *
     * @param $client
     * @param $container
     * @param $email
     * @param $password
     * @param $client
     * @return mixed
     */
    static public function newLoggedInUserClient($client, $container, $email = 'DefaultControllerTest-test123@example.com', $password = 'pass123')
    {
        self::createTestUser($container);
        return self::loginUserClient($client, $email, $password);
    }

    /**
     * Initiate a login for the user
     *
     * @param $client
     * @param $container
     * @param $email
     * @param $password
     * @param $client
     * @return mixed
     */
    static public function loginUserClient($client, $email = 'DefaultControllerTest-test123@example.com', $password = 'pass123')
    {
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $data = array('_email' => $email, '_password' => $password);
        $client->submit($form, $data);
        return $client;
    }

    /**
     *
     * Create test user for testing out logins
     *
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @param $container
     */
    static public function createTestUser($container, $firstName = 'Alice', $lastName = 'Jones', $email = 'DefaultControllerTest-test123@example.com', $password = 'pass123')
    {
        $doctrine = $container->get('doctrine');

        /** @var User $user */
        $user = $doctrine
            ->getRepository('AppBundle:User')
            ->findOneByEmail($email);

        if (empty($user)) {
            $user = new User();
        }
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setIsActive(true);
        $user->setPassword($password);
        $em = $doctrine->getManager();
        $em->persist($user);
        $em->flush();
    }
}
