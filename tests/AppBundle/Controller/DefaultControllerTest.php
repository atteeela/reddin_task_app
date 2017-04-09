<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use AppBundle\Entity\User;
use Tests\AppBundle\Helpers\LoginHelpers;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;
    private $container = null;

    public function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();

        LoginHelpers::createTestUser($this->container);

        // Ensure everything after gets rolled back
        $this->container
            ->get('doctrine.orm.entity_manager')
            ->getConnection()
            ->beginTransaction();
    }

    public function tearDown()
    {
        // Happens automatically
        // Todo: verify
        /**  $this->container
         * ->get('doctrine.orm.entity_manager')
         * ->getConnection()->rollback();**/
    }

    public function testIndexNotLoggedIn()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );
        $client->followRedirect();
        $crawler = $client->getCrawler();
        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Login', $crawler->filter('#container')->text());
        $this->assertContains('Email', $crawler->filter('#container')->text());
        $this->assertContains('Password', $crawler->filter('#container')->text());
        $this->assertContains('Login', $crawler->filter('#container')->text());
        $this->assertContains('Users can be loaded via the following command:', $crawler->filter('#container')->text());

    }

    public function testLoginSuccessAndRedirectToWelcomeHome()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/home/welcome')
        );

        $client->followRedirect();
        $crawler = $client->getCrawler();

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Welcome Alice Jones!', $crawler->filter('#container')->text());
        $this->assertContains('Navigation', $crawler->filter('#container')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('Welcome page', $crawler->filter('#container')->text());
        $this->assertContains('Logout', $crawler->filter('#container')->text());
    }

    public function testRedirectFromRootToHomeWelcomeWhenLoggedIn()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $client->followRedirect();
        $crawler = $client->getCrawler();
        $crawler = $client->request('GET', '/');

        $this->assertTrue(
            $client->getResponse()->isRedirect('/home/welcome')
        );

        $client->followRedirect();
        $crawler = $client->getCrawler();

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Welcome Alice Jones!', $crawler->filter('#container')->text());
        $this->assertContains('Navigation', $crawler->filter('#container')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('Welcome page', $crawler->filter('#container')->text());
        $this->assertContains('Logout', $crawler->filter('#container')->text());
    }
}
