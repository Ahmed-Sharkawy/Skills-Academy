<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SettingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Cat::factory()->has(
            Skill::factory()->has(
                Exam::factory()->has(
                    Question::factory()->count(rand(5,20))
                )->count(2)
            )->count(8)
        )->count(5)->create();

        $this->call([
            SettingSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
