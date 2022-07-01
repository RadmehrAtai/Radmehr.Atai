<?php

namespace App\Tests\Controller;

use App\Controller\SecurityController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request("GET","/login");

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains("h1", "Please sign in");
    }
}
