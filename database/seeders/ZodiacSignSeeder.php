<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZodiacSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding zodiac signs
        DB::table('zodiac_signs')->insert([
            ['title' => 'Aries'],
            ['title' => 'Taurus'],
            ['title' => 'Gemini'],
            ['title' => 'Cancer'],
            ['title' => 'Leo'],
            ['title' => 'Virgo'],
            ['title' => 'Libra'],
            ['title' => 'Scorpio'],
            ['title' => 'Sagittarius'],
            ['title' => 'Capricorn'],
            ['title' => 'Aquarius'],
            ['title' => 'Pisces']
        ]);
    }
}
