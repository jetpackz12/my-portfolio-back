<?php

namespace Database\Seeders;

use App\Models\AboutMeSkill;
use Illuminate\Database\Seeder;

class AboutMeSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutMeSkill::create([
            'title' => "Web Development",
            'skills' => "HTML, CSS, JavaScript, PHP, Bootstrap, Tailwind CSS, Ajax, jQuery, MySQL, Laravel, CodeIgniter, Vue js",
        ]);

        AboutMeSkill::create([
            'title' => "Android Development",
            'skills' => "Java",
        ]);

        AboutMeSkill::create([
            'title' => "Version Control",
            'skills' => "Git",
        ]);

        AboutMeSkill::create([
            'title' => "Server Side",
            'skills' => "Linux",
        ]);
    }
}
