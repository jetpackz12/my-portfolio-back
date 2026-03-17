<?php

namespace Database\Seeders;

use App\Models\HomeImage;
use Illuminate\Database\Seeder;

class HomeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeImage::create([
            'name' => "Picture 1",
            'image_path' => ""
        ]);
    }
}
