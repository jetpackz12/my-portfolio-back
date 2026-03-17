<?php

namespace Database\Seeders;

use App\Models\AboutMeWork;
use Illuminate\Database\Seeder;

class AboutMeWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutMeWork::create([
            'job' => "BSIS Intructor",
            'company' => "Talibon Polytechnic College",
            'duration_type' => 2,
            'date_start' => "Aug 2024",
            'date_end' => "Present",
            'description' => "Currently working as an instructor in BSIS programs I handle the following subjects: Introduction of Computing, Computer Programming l, Computer Programming ll, Information Management, System Analysis and Design, Human Computer Interaction and Software Engineering.",
        ]);

        AboutMeWork::create([
            'job' => "Junior Web Developer",
            'company' => "GrounLink",
            'duration_type' => 2,
            'date_start' => "Feb 2024",
            'date_end' => "May 2024",
            'description' => "I was assigned to the server team and was responsible for maintaining, adding new features, and fixing bugs. Implemented security measures including iptables, ModSecurity, and Maldet. Monitored and managed server operations.",
        ]);

        AboutMeWork::create([
            'job' => "Data Processor",
            'company' => "Dynata",
            'duration_type' => 2,
            'date_start' => "Dec 2022",
            'date_end' => "Sep 2023",
            'description' => "Processed and validated survey data performed data checks and analysis, prepared client-ready files, and communicated issues professionally while meeting tight deadlines in a fast-paced environment.",
        ]);
    }
}
