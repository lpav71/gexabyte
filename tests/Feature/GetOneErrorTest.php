<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneErrorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET', '/api/ad/0', [
            'page' => '1',
            'price' => 'sort',
        ]);

        $response
            ->assertStatus(404)
            ->assertJsonStructure([
                'result',
                'reason'
            ]);
        //------------------------------------------------------
     }
}
