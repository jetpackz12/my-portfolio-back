<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'title' => "Email",
            'sub_title' => "jetpackzabela12@gmail.com",
            'icon' => "envelope"
        ]);

        Contact::create([
            'title' => "Facebook",
            'sub_title' => "Joseph Jett Tado Abela",
            'icon' => '["fab", "facebook"]'
        ]);

        Contact::create([
            'title' => "Phone",
            'sub_title' => "09630075173",
            'icon' => "phone"
        ]);

        Contact::create([
            'title' => "LinkedIn",
            'sub_title' => "Joseph Jett Abela",
            'icon' => '["fab", "linkedin"]'
        ]);

        Contact::create([
            'title' => "GitHub",
            'sub_title' => "https://github.com/jetpackz12",
            'icon' => '["fab", "github"]'
        ]);

        Contact::create([
            'title' => "Address",
            'sub_title' => "Purok 6 - Poblacion Trinidad, Bohol",
            'icon' => "map-location-dot"
        ]);
    }
}
