<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Estabelecimento;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewEstabelecimentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function makes_new_estabelecimento_object()
    {
        // Arrange
        $estabelecimento = new Estabelecimento;

        $expectedColumns = [
            'nome',
            'email',
            'celular',
            'endereco',
            'numero',
            'complemento',
            'cep',
            'coords_xy',
            'sql',
            'razao_social',
            'cnpj',
            'licenca_funcionamento'
        ];

        $missingColumns = array_diff($expectedColumns, $estabelecimento->getFillable());

        $extraColumns = array_diff($estabelecimento->getFillable(), $expectedColumns);

        // Assert
        $this->assertEquals(0, count($missingColumns));
        $this->assertEquals(0, count($extraColumns));
    }
}
