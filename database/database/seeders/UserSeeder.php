<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$name = Str::random(10);
        $data = [
            "name" => $name,
            "email" => $name . '@gmail.com',
            "password" => Hash::make('belloseiamo'),
            "created_at" => Carbon::now(),
            "email_verified_at" => Carbon::now()
        ];
        DB::table('users')->insert($data);*/

        User::factory(30)->create();


    }
}
