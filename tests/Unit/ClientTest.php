<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;

class ClientTest extends TestCase
{
	use DatabaseMigrations;

    protected $faker;

    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    /**
     * Test if it's possible to save a client.
     *
     * @return void
     */
    public function testCanCreateClient()
    {
        $data = [
        	'nome' => $this->faker->name,
        	'rg' => $this->faker->numerify('##.###.###-#'),
        	'nascimento' => $this->faker->date(),
        	'cpf' => $this->faker->numerify('###.###.###-##'),
        	'endereco' => $this->faker->streetName,
        	'numero' => $this->faker->randomNumber(4),
        	'complemento' => $this->faker->sentence,
        	'bairro' => $this->faker->sentence,
        	'cidade' => $this->faker->city,
        	'estado' => $this->faker->stateAbbr,
        	'cep' => $this->faker->randomNumber(8),
        ];

        print_r($data);
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
