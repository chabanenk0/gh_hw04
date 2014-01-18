<?php

namespace chabanenk0\TestAssignmentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnswerControllerTest extends WebTestCase
{
    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/answer/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /answer/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'chabanenk0_testassignmentbundle_answer[number]'  => 1,
            'chabanenk0_testassignmentbundle_answer[answerText]'  => 'What is Your name?',
            'chabanenk0_testassignmentbundle_answer[questionID]'  => 566,
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("What is Your name?")')->count(), 'Missing element td:contains("What is Your name?")');

        // Edit the entity
        /*
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'chabanenk0_testassignmentbundle_answer[number]'  => 1,
            'chabanenk0_testassignmentbundle_answer[answerText]'  => 'What is Your name, dude?',
            'chabanenk0_testassignmentbundle_answer[questionID]'  => 509,
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
        */
    }

}
