<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneFieldsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET', '/api/ad/232', [
            'fields' => 'images'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'price',
                'image',
                'images'
            ]);

        $response = $this->json('GET', '/api/ad/232', [
            'fields' => 'description'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'price',
                'image',
                'description'
            ]);

        $response = $this->json('GET', '/api/ad/232', [
            'fields' => 'images, description'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'text',
                'price',
                'image',
                'images',
                'description'
            ]);
     }
}
