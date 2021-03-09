<?php

namespace Database\Factories;

use App\Models\Estabelecimento;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstabelecimentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estabelecimento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'celular' => '(11) 98765-4321',
            'endereco' => 'Av. Nações Unidas',
            'numero' => '1500',
            'complemento' => 'bloco C',
            'cep' => '01234-567',
            'coords_xy' => null,
            'sql' => '',
            'razao_social' => 'EMPRESA LTDA',
            'cnpj' => '01.234.567/0001-89',
            'licenca_funcionamento' => '2021.012345'
        ];
    }
}
