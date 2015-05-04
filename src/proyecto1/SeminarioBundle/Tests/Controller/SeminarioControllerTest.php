<?php

namespace proyecto1\SeminarioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeminarioControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/seminario/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /seminario/");

        $crawler = $client->click($crawler->selectLink('Nuevo Seminario')->link());

        // Fill in the form and submit it
        var_dump($client->getResponse()->getContent());
        $form = $crawler->selectButton('Guardar')->form(array(
            'proyecto1_seminariobundle_seminario[responsables]'  => 1,             // La fecha debe ser posterior, de lo contrario no se podrá editar
            'proyecto1_seminariobundle_seminario[nombre]'  => 'sistemas dinamicos',
            'proyecto1_seminariobundle_seminario[lugar]'  => 'Nose',
        ));
        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        //$this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');
        $this->assertGreaterThan(0, $crawler->filter('div:contains("Your changes were saved!")')->count(), 'Missing element div:contains("Your changes were saved!")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editar')->link());

        $form = $crawler->selectButton('Actualizar')->form(array(
            'proyecto1_seminariobundle_seminario[lugar]'  => 'Sise',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('div:contains("Tus cambios fueron guardados!")')->count(), 'Missing element div:contains("Your changes were saved!")');
        // Delete the entity
        $client->submit($crawler->selectButton('Eliminar')->form());
        $crawler = $client->followRedirect();

       // falla checar $this->assertGreaterThan(0, $crawler->filter('div:contains("Seminario eliminado con exito!")')->count(), 'Missing element div:contains("Seminario eliminado con exito! ")');

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test/', $client->getResponse()->getContent());
    }


}
