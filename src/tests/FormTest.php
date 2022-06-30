<?php

namespace App\Tests;

use App\Entity\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    public function testSomething(): void
    {
        $form = new Form();
        $form->setName("Rad");
        $form->setEmail("rad@rad.com");

        $this->assertEquals("Rad", $form->getName());
        $this->assertEquals("rad@rad.com", $form->getEmail());
    }
}
