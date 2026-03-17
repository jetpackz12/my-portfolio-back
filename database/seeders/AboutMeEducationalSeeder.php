<?php

namespace Database\Seeders;

use App\Models\AboutMeEducational;
use Illuminate\Database\Seeder;

class AboutMeEducationalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutMeEducational::create([
            'title' => "Primary",
            'school' => "Trinidad Central Elementary School, Poblacion Trinidad, Bohol",
            'year' => "2005-2011",
        ]);

        AboutMeEducational::create([
            'title' => "Secondary Junior High",
            'school' => "St. Isidore Academy, Poblacion Trinidad, Bohol",
            'year' => "2012-2016",
        ]);
        
        AboutMeEducational::create([
            'title' => "Senior High",
            'school' => "St. Isidore Academy, Poblacion Trinidad, Bohol",
            'year' => "2016-2018",
        ]);
        
        AboutMeEducational::create([
            'title' => "Tertiary",
            'school' => "Trinidad Municipal College, Poblacion Trinidad, Bohol - Bachelor of Science in Information Technology",
            'year' => "2018-2022",
        ]);
    }
}
