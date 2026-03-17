<?php

namespace Database\Seeders;

use App\Models\HomeDescription;
use Illuminate\Database\Seeder;

class HomeDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeDescription::create([
            'description' => 'I am a passionate developer with expertise in creating dynamic, user-friendly websites and applications. I specialize in both front-end and back-end development, ensuring responsive and high-performance web solutions.',
        ]);
    }
}
