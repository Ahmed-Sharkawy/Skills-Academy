<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Cat::factory()->has(
            Skill::factory()->has(
                Exam::factory()->has(
                    Question::factory()->count(15)
                )->count(2)
            )->count(8)
        )->count(5)->create();

        // Cat::factory()->count(5)->create();
        // Skill::factory()->count(8)->create();
        // Exam::factory()->count(2)->create();
        // Question::factory()->count(15)->create();
    }
}
