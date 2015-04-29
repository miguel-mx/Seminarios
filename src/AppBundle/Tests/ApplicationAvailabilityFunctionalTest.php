<?php
// src/AppBundle/Tests/ApplicationAvailabilityFunctionalTest.php
namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/login'),
            array('/evento/'),
            array('/evento/semana'),
            array('/evento/semanasiguiente'),

// ...
        );
    }
}
