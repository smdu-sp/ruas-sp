<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function loads_home_page()
    {
        // Arrange
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
    }
}
