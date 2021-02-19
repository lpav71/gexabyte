<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=10; $i++)
        {
            DB::table('ads')->insert([
                'text' => 'Текст объявления '.$i,
                'price' => rand(1,100000)/100,
                'description' => 'Описание '.$i,
                'links' => "[\"image1\",\"image2\",\"image3\"]",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}
