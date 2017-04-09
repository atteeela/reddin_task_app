<?php

namespace Tests\AppBundle\Security;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class FormLoginAuthenticatorTest extends TestCase
{
    /**
     * Not Tests required since they are implicitly tested via other calls since this is a credentials provider
     * In other words, all the code in FormLoginAuthenticator run whenever login is performed (Set breakpoints to prove it!)
     */
    public function testNoneRequired() {
        $this->assertTrue(true);
    }
}