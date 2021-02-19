<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('POST', '/api/ad', [
            'text' => 'text ad',
            'price' => '100',
            'description' => 'description ad',
            'images' => '["image1","image2","img"]'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'result',
                'id'
            ]);
    }
}
