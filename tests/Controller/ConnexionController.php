<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConnexionController extends WebTestCase
{
    protected function connexion()
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
}