<?php

namespace Database\Seeders;

use App\Models\Resume;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resume::create([
            'title' => "Word",
            'icon' => "file-word",
            'file_path' => "",
            'image_path' => ""
        ]);

        Resume::create([
            'title' => "PDF",
            'icon' => "file-arrow-down",
            'file_path' => "",
            'image_path' => ""
        ]);
    }
}
