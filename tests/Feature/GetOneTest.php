<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET', '/api/ad/126');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'price',
                'image'
            ]);
     }
}
