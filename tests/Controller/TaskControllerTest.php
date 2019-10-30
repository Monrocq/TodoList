<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class TaskControllerTest extends WebTestCase
{
    public function testListAction()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks');

        $this->assertSame("Liste des tâches en cours", $crawler->filter('h2')->text());
    }

    public function testListActionFinished()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks');

        $link = $crawler->selectLink('Accéder à la liste des tâches terminés')->link();
        $crawler = $client->click($link);

        $this->assertSame("Liste des tâches terminées", $crawler->filter('h2')->text());
    }

    public function testCreatePage()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    
    public function testCreateTask()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Test';
        $form['task[content]'] = 'Ceci est un article de test';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }


    public function testEditPage()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks');

        $link = $crawler->selectLink('Test')->link();
        $crawler = $client->click($link);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testEditTask()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks');

        $link = $crawler->selectLink('Test')->link();
        $crawler = $client->click($link);

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'Test';
        $form['task[content]'] = 'Ceci est un article de test modifié';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testToggleTask()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks');

        $id = $crawler->filter("#taskTest p")->text();

        $crawler = $client->request('GET', '/tasks/' . $id . '/toggle');

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }


    public function testDeleteTask()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/tasks-finished');

        $id = $crawler->filter("#taskTest p")->text();

        $crawler = $client->request('GET', '/tasks/' . $id . '/delete');

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }
}