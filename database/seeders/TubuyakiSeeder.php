<?php

namespace Database\Seeders;

use App\Models\Tubuyaki;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TubuyakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tubuyaki::factory()
            ->count(50)
            ->create();
    }
}
