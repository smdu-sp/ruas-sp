<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Estabelecimento;

class EstabelecimentoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function prevents_registering_duplicate_cnpj()
    {
        // Arrange
        $estabelecimento = Estabelecimento::factory()->create()->toArray();

        // Act
        $response = $this->postJson('/api/estabelecimento/store', $estabelecimento);

        // Assert
        $response->assertStatus(200)
        ->assertJson([
            'success' => 0,
            'message' => 'cnpj_ja_cadastrado'
        ]);
        $this->assertCount(1, Estabelecimento::all());
    }

    /** @test */
    public function prevents_registering_without_razao_social()
    {
        // Arrange
        $estabelecimento = Estabelecimento::factory()->make()->toArray();
        unset($estabelecimento['razao_social']);

        // Act
        $response = $this->postJson('/api/estabelecimento/store', $estabelecimento);
        
        // Assert
        $response->assertStatus(200)
        ->assertJson([
            'success' => 0,
            'message' => 'razao_social'
        ]);
    }

    /** @test */
    public function registers_new_estabelecimento()
    {
        // Arrange
        $estabelecimento = Estabelecimento::factory()->make()->toArray();

        // Act
        $response = $this->postJson('/api/estabelecimento/store', $estabelecimento);

        // Assert
        $response->assertStatus(200)
        ->assertJson([
            'success' => 1,
            'message' => 'Salvo com sucesso!'
        ]);
        $this->assertCount(1, Estabelecimento::all());
    }
}
