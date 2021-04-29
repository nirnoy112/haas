<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding months
        DB::table('months')->insert([
            ['title' => 'January'],
            ['title' => 'February'],
            ['title' => 'March'],
            ['title' => 'April'],
            ['title' => 'May'],
            ['title' => 'June'],
            ['title' => 'July'],
            ['title' => 'August'],
            ['title' => 'Sepetember'],
            ['title' => 'October'],
            ['title' => 'November'],
            ['title' => 'December']
        ]);
    }
}
