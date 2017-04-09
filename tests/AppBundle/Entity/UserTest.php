<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateAndGetEntity()
    {
        $user = new User();

        $id = 123;
        $user->setId($id);
        $this->assertEquals($id, $user->getId());

        $firstName = 'Alice';
        $user->setFirstName($firstName);
        $this->assertEquals($firstName, $user->getFirstName());

        $lastName = 'Jones';
        $user->setLastName($lastName);
        $this->assertEquals($lastName, $user->getLastName());

        $email = 'Alice@Example.com';
        $user->setEmail($email);
        $this->assertEquals(strtolower($email), $user->getEmail());
        $this->assertEquals(strtolower($email), $user->getUsername());

        $password = 'passABC';
        $user->setPassword($password);

        $isActive = true;
        $user->setIsActive($isActive);
        $this->assertEquals($isActive, $user->getIsActive());
        $this->assertEquals($isActive, $user->isEnabled());

        $isActive = false;
        $user->setIsActive($isActive);
        $this->assertEquals($isActive, $user->getIsActive());
        $this->assertEquals($isActive, $user->isEnabled());

        $this->assertEquals(['ROLE_USER'], $user->getRoles());

    }
}