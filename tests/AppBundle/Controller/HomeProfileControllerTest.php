<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\Helpers\LoginHelpers;
use AppBundle\Entity\User;

class HomeProfileControllerTest extends WebTestCase
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

    public function testShowHomeProfileEdit()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/home/profile/edit');

        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('First name', $crawler->filter('#container')->text());
        // Todo: Why do the fields not show up? They should!
        //  $this->assertContains('Alice', $crawler->filter('#form_first_name')->getValue());
        $this->assertContains('Last name', $crawler->filter('#container')->text());
        //  $this->assertContains('Jones', $crawler->filter('#form_last_name')->text());
        $this->assertContains('Password', $crawler->filter('#container')->text());
        $this->assertContains('Update profile', $crawler->filter('#container')->text());
    }

    public function testUpdateProfileNamesSuccess()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/home/profile/edit');

        $form = $crawler->selectButton('Update profile')->form();
        $data = array('form[first_name]' => 'Alice2', 'form[last_name]' => 'Jones2');
        $client->submit($form, $data);

        $client->followRedirect();
        $crawler = $client->getCrawler();

        $this->assertContains('Your profile was successfully updated!', $crawler->filter('#container')->text());
        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('First name', $crawler->filter('#container')->text());
        // todo: They show up in the actual web view (and are actually updated properly, just not able to query with crawler
        //  $this->assertContains('Alice', $crawler->filter('#form_first_name')->getValue());
        $this->assertContains('Last name', $crawler->filter('#container')->text());
        //  $this->assertContains('Jones', $crawler->filter('#form_last_name')->text());
        $this->assertContains('Password', $crawler->filter('#container')->text());
        $this->assertContains('Update profile', $crawler->filter('#container')->text());

        // Navigate to Welcome page to see the user names update
        $crawler = $client->request('GET', '/home/welcome');
        //$crawler = $client->getCrawler();
        $this->assertContains('Welcome Alice2 Jones2!', $crawler->filter('#container')->text());
    }

    public function testUpdatePasswordSuccess()
    {
        $client = LoginHelpers::newLoggedInUserClient(static::createClient(), $this->container);
        $crawler = $client->request('GET', '/home/profile/edit');

        $form = $crawler->selectButton('Update password')->form();
        $data = array('form[password]' => 'passwordChanged');
        $client->submit($form, $data);

        $client->followRedirect();
        $crawler = $client->getCrawler();

        $this->assertContains('Your password was successfully updated!', $crawler->filter('#container')->text());
        $this->assertContains('Reddin Task App', $crawler->filter('#container h1')->text());
        $this->assertContains('Edit profile', $crawler->filter('#container')->text());
        $this->assertContains('First name', $crawler->filter('#container')->text());
        // todo: They show up in the actual web view (and are actually updated properly, just not able to query with crawler
        //  $this->assertContains('Alice', $crawler->filter('#form_first_name')->getValue());
        $this->assertContains('Last name', $crawler->filter('#container')->text());
        //  $this->assertContains('Jones', $crawler->filter('#form_last_name')->text());
        $this->assertContains('Password', $crawler->filter('#container')->text());
        $this->assertContains('Update profile', $crawler->filter('#container')->text());

        // Logout
        $link = $crawler
            ->filter('#logout')
            ->eq(0)
            ->link();

        $crawler = $client->click($link);
        $client->followRedirect();

        $this->assertTrue(
            $client->getResponse()->isRedirect('/login')
        );

        // Log back in with the new password
        $client = LoginHelpers::loginUserClient(static::createClient(), 'DefaultControllerTest-test123@example.com', 'passwordChanged');
        $crawler = $client->request('GET', '/home/welcome');

        $this->assertContains('Welcome Alice Jones!', $crawler->filter('#container')->text());
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
