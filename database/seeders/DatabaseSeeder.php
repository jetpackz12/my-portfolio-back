<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HomeImageSeeder::class,
            HomeMovingTextSeeder::class,
            HomeDescriptionSeeder::class,
            OfferSeeder::class,
            AboutMeWorkSeeder::class,
            AboutMeSkillSeeder::class,
            AboutMeEducationalSeeder::class,
            AboutMeImageSeeder::class,
            ResumeSeeder::class,
            ContactSeeder::class
        ]);
    }
}
