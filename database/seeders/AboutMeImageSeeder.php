<?php

namespace Database\Seeders;

use App\Models\AboutMeImage;
use Illuminate\Database\Seeder;

class AboutMeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutMeImage::create([
            'name' => "Picture 1",
            'image_path' => ""
        ]);
    }
}
