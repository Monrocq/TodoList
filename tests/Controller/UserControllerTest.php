<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testListAction()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $link = $crawler->selectLink('Utilisateurs')->link();
        $crawler = $client->click($link);

        $this->assertSame("Liste des utilisateurs", $crawler->filter('h1')->text());
    }

    public function testCreatePage()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $link = $crawler->selectLink('Créer un utilisateur')->link();
        $crawler = $client->click($link);

        $this->assertSame("Créer un utilisateur", $crawler->filter('h1')->text());
    }

    public function testCreateUser()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'demo';
        $form['user[password][first]'] = 'demo';
        $form['user[password][second]'] = 'demo';
        $form['user[email]'] = 'demo@demo.fr';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());

        $crawler = $client->request('GET', '/users');

        $id = $crawler->filter("#user-demo p")->text();

        $crawler = $client->request('DELETE', '/users/' . $id . '/delete');

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
    }

    public function testEditUser()
    {
        $array = Connexion::connexion();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]'] = 'demo';
        $form['user[password][first]'] = 'demo';
        $form['user[password][second]'] = 'demo';
        $form['user[email]'] = 'demo@demo.fr';
        $crawler = $client->submit($form);

        //$crawler = $client->followRedirect();

        $crawler = $client->request('GET', '/users');

        $id = $crawler->filter("#user-demo p")->text();

        $crawler = $client->request('DELETE', '/users/' . $id . '/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[email]'] = 'demo@demo.com';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());

        $crawler = $client->request('DELETE', '/users/' . $id . '/delete');
    }

}