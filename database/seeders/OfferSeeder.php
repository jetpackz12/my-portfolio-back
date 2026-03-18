<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::create([
            'title' => "Front-End Development",
            'description' => "Creating visually appealing, responsive, and user-friendly interfaces using HTML, CSS, Bootstrap, Tailwind CSS, JavaScript, jQuery, Ajax, and modern frameworks like Vue.js.",
            'icon' => "display",
        ]);

        Offer::create([
            'title' => "Back-End Development",
            'description' => "Building robust and scalable server-side applications with PHP, Laravel and databases like MySQL.",
            'icon' => "laptop-code",
        ]);
        
        Offer::create([
            'title' => "Full-Stack Development",
            'description' => "Handling both front-end and back-end development to deliver complete web solutions.",
            'icon' => "code",
        ]);
        
        Offer::create([
            'title' => "API Integration",
            'description' => "Connecting and integrating third-party APIs to enhance website functionality.",
            'icon' => "network-wired",
        ]);
        
        Offer::create([
            'title' => "Website Deployment",
            'description' => "Deploying websites using Hostinger hosting platforms, ensuring smooth and reliable launches.",
            'icon' => "cloud-arrow-up",
        ]);
        
        Offer::create([
            'title' => "Maintenance & Support",
            'description' => "Providing ongoing maintenance, updates, and technical support for existing websites.",
            'icon' => "screwdriver-wrench",
        ]);
    }
}
