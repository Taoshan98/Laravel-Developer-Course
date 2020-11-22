<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Album::truncate();
        Photo::truncate();

        User::factory(5)->has(
            Album::factory(2)->has(
                Photo::factory(3)
            )
        )->create();

        User::factory(10)->create();
    }
}
