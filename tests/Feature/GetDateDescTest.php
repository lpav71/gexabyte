<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetDateDescTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('GET', '/api/ad', [
            'page' => '1',
            'date' => 'desc',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                "current_page",
                "data" => [
                    0 => [
                        "text",
                        "price",
                        "links"
                    ],
                ],
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"
            ]);
     }
}
