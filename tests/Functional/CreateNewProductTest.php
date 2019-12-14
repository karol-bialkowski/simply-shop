<?php


namespace App\Tests\Functional;

use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateNewProductTest extends WebTestCase
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testShouldCorrectCreateProductViaAPI()
    {
        //tmp disabled
//        $client = static::createClient();
//        $client->request('GET', '/product');
//        $content = json_decode($client->getResponse()->getContent());
//
//        $this->assertTrue($content->status);
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}