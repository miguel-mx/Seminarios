<?php

namespace proyecto1\SeminarioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventoControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // La tabla de Eventos no debe contener la cadena Test

        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/seminario/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /seminario/");
        $crawler = $client->click($crawler->selectLink('Crear Evento')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Guardar')->form(array(
            'proyecto1_seminariobundle_evento[fecha]'  => '15-05-2015',             // La fecha debe ser posterior, de lo contrario no se podrá editar
            'proyecto1_seminariobundle_evento[ponente]'  => 'Ponente-Test',
            'proyecto1_seminariobundle_evento[origen]'  => 'UMSNH',
            'proyecto1_seminariobundle_evento[platica]'  => 'Titulo Platica Ponente-Test',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('div:contains("Your changes were saved!")')->count(), 'Missing element div:contains("Your changes were saved!")');

        // Edit the entity
        //$crawler = $client->click($crawler->selectLink('Editar')->link());

        $crawler = $client->click($crawler->selectLink('Editar')->link());

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for Editar");
        $this->assertGreaterThan(0, $crawler->filter('legend:contains("Datos de Evento")')->count(), 'Missing element legend:contains("Datos de Evento")');

        $form = $crawler->selectButton('Actualizar')->form(array(
            'proyecto1_seminariobundle_evento[ponente]'  => 'Ponente Edit Test',
            'proyecto1_seminariobundle_evento[fecha]'  => '15-05-2015',             // Reescribir la fecha para que no quede en ceros error 404
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /Show actualizar/");
        $this->assertContains('Ponente Edit Test', $client->getResponse()->getContent(), 'Missing edited name' );

        // Delete the entity
        $client->submit($crawler->selectButton('Eliminar')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test/', $client->getResponse()->getContent());
    }

}
