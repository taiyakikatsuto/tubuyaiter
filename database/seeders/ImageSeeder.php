<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('images');
        $table->truncate();

        $table->insert([
            // [
            //     'id' => 1,
            //     'tubuyaki_id' => 1,
            //     'file_path' => 'c:\\test\\test.pdf',
            //     'file_name' => 'test.pdf',
            //     'created' => now(),
            //     'modified' => now(),
            // ],
         ]);
    }
}
