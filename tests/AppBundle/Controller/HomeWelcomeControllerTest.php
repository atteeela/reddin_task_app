<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\Helpers\LoginHelpers;
use AppBundle\Entity\User;

class HomeWelcomeControllerTest extends WebTestCase
{
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

    public function testShowHomeWelcome()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $crawler = $client->getCrawler();

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Welcome Alice Jones!', $crawler->filter('#container')->text());
        $this->assertContains('Navigation', $crawler->filter('#container')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('Welcome page', $crawler->filter('#container')->text());
        $this->assertContains('Logout', $crawler->filter('#container')->text());
    }

    public function testClickLogout()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $crawler = $client->getCrawler();

        $link = $crawler
            ->filter('#logout')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);

        $client->followRedirect();

        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );
    }

    public function testClickWelcomeHome()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $crawler = $client->getCrawler();

        $link = $crawler
            ->filter('#welcome-home')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Welcome Alice Jones!', $crawler->filter('#container')->text());
    }

    public function testClickEditProfile()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/');
        $client->followRedirect();
        $crawler = $client->getCrawler();

        $link = $crawler
            ->filter('#welcome-home')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('Alice', $crawler->filter('#container')->text());
        $this->assertContains('Jones', $crawler->filter('#container')->text());
    }
}
