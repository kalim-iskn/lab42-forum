<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (Section::count() == 0) {
            Section::factory()->create([
                "name" => "Компьютерные игры"
            ]);

            Section::factory()->create([
                "name" => "Психология"
            ]);

            Section::factory()->create([
                "name" => "Политика"
            ]);
        }
    }
}
