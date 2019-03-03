<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;

class TelefoneTest extends TestCase
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
     * Test if it's possible to save a clients contact info.
     *
     * @return void
     */
    public function testCanCreateContact() {

        $clientData = [
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
            'email' => $this->faker->email,
        ];

        $client = \App\Cliente::create($clientData);

    	$data = [
            'id_cliente' => $client->id,
    		'nome' => $this->faker->name,
    		'numero' => $this->faker->numerify('(##) #####-####'),
    	];

        $phone = \App\Telefone::create($data);

        $this->assertDatabaseHas('telefones', $data);
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}