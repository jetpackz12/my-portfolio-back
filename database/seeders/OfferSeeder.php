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
    }
}
