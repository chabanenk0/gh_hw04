<?php

namespace chabanenk0\TestAssignmentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Даний сайт призначений для розробки тестів")')->count() > 0);
    }

    public function testTestList()
    {
        $client = static::createClient();

        $client->request('GET', '/tests');
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('html:contains("Зараз доступні наступні тести:")')->count() > 0);

        $link = $crawler->filter('a:contains("Пройти тест")')->eq(1)->link();
        $crawler1 = $client->click($link);

        $this->assertTrue($crawler1->filter('html:contains("Пройдіть тест")')->count() > 0);
    }


    public function testTestviewList() 
    {
        $client = static::createClient();

        $client->request('GET', '/tests');
        $crawler = $client->followRedirect();

        $link = $crawler->filter('a:contains("Пройти тест")')->eq(1)->link();
        $crawler1 = $client->click($link);

        $this->assertTrue($crawler1->filter('html:contains("Пройдіть тест")')->count() > 0);


    }

    public function testAbout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about');
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('html:contains("Про нас")')->count() > 0);
    }

    public function testContacts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contacts');
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('html:contains("Дмитро Чабаненко")')->count() > 0);
    }

    public function testGuestbook()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/guestbook');
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('html:contains("Name")')->count() > 0);

        $form = $crawler->selectButton('Ok')->form();

        // set some values
        $form['post[name]'] = 'vasya';
        $form['post[email]'] = 'vasya@mail.ru';
        $form['post[message]'] = 'Test review text...';
        // submit the form
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertTrue($crawler->filter('html:contains("Test review text...")')->count() > 0);
    }

    public function testTags1() 
    {
        $client = static::createClient();

        $client->request('GET', '/tests');
        $crawler = $client->followRedirect();

        $link = $crawler->filter('a:contains("psychology")')->eq(1)->link();
        $crawler1 = $client->click($link);

        // !!! would work if you use default fixtures without any corrections!!!

        $this->assertTrue($crawler1->filter('html:contains("Тест темперамента Айзенка")')->count() > 0);
        //$this->assertFalse($crawler1->filter('html:contains("Арифметический тест")')->count() > 0);
    }

    public function testTags2() 
    {
        $client = static::createClient();

        $client->request('GET', '/tests');
        $crawler = $client->followRedirect();

        $link = $crawler->filter('a:contains("arithmetics")')->eq(1)->link();
        $crawler1 = $client->click($link);

        // !!! would work if you use default fixtures without any corrections!!!

        //$this->assertFalse($crawler1->filter('html:contains("Тест темперамента Айзенка")')->count() > 0);
        $this->assertTrue($crawler1->filter('html:contains("Арифметический тест")')->count() > 0);
    }


}
