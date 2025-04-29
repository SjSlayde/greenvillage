<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function test(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Les Rubriques :');

        $tab = $crawler->filter('h5');
        $this->assertEquals($tab->count(), 11);
    }

    public function test2(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/sous-rubrique');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Les Sous-Rubriques :');

        $tab = $crawler->filter('h5');
        $this->assertEquals($tab->count(), 12);
    }

    public function test3(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produits');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Nos produits :');

        $tab = $crawler->filter('h5');
        $this->assertEquals($tab->count(), 20);
    }

    public function test4(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/produits-2');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Nos produits :');
        $this->assertSelectorTextContains('h5', 'VIOLON');

        $tab = $crawler->filter('h5');
        $this->assertEquals($tab->count(), 2);
    }
}
