<?php

namespace Database\Seeders;

use App\Models\HomeMovingText;
use Illuminate\Database\Seeder;

class HomeMovingTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeMovingText::create([
            'text' => "Web Developer"
        ]);

        HomeMovingText::create([
            'text' => "Mobile Developer"
        ]);
    }
}
