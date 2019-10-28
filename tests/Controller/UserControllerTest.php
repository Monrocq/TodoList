<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function clientConnected()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Se connecter')->form();
        $form['_username'] = 'test';
        $form['_password'] = 'test';
        $crawler = $client->submit($form);

        $crawler = $client->followRedirect();

        return ['client' => $client, 'crawler' => $crawler];
    }

    public function testCreateUserPage()
    {
        $array = $this->clientConnected();
        $client = $array['client'];
        $crawler = $array['crawler'];

        $link = $crawler->selectLink('Créer un utilisateur')->link();
        $crawler = $client->click($link);

        $this->assertSame("Créer un utilisateur", $crawler->filter('h1')->text());
    }
}