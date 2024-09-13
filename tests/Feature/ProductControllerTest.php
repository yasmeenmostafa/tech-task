<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_new_product()
    {
        // Arrange
        $data = [
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 10,
            'category_id' => 1 // Make sure this category exists in your test database
        ];

        // Act
        $response = $this->post('/api/products', $data);

        // Assert
        $response->assertStatus(201); // Assuming successful creation returns HTTP 201
        $this->assertDatabaseHas('products', $data);
    }
}
