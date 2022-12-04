<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    public function testPageIsSuccessful()
    {
        $client = static::createClient([], [
            'HTTP_HOST' => 'localhost:9092',
        ] );

        $url = $client->request('GET', '/login');

        if ($url) {
            echo 'HELLO WORLD';
        }

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

}
