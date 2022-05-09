<?php

namespace Database\Factories;

use App\Models\Cat;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    static $i = 0;
    $i++;

    return [
      'name'    => json_encode([
        'en'  => $this->faker->word(),
        'ar'  => $this->faker->word(),
      ]),
      'image'   => "$i.png",
      // 'cat_id'  =>  Cat::get(['id'])->random()->id,
    ];
  }
}
