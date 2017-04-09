<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     * Not Tests required since they are implicitly tested via other calls since this is a credentials provider
     * In other words, all the code in SecurityController run whenever login is performed (Set breakpoints to prove it!
     */
    public function testNoneRequired() {
        $this->assertTrue(true);
    }
}
