<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 2; $i < 12; $i++)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'birthday' => $faker->date('Y-m-d', '2010-01-01'),
                'sex' => $faker->boolean, // true or false (man or woman)
                'status' => $faker->boolean,
                'address' => $faker->address,
                'code_id' => $i,
            ]);
        }
    }
}
