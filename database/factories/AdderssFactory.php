<?php

namespace Database\Factories;

use App\Models\Adderss;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdderssFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adderss::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'a_type' => $this->faker->word,
        'a_name' => $this->faker->word,
        'a_number' => $this->faker->word,
        'a_houser_no' => $this->faker->word,
        'a_lendmark' => $this->faker->word,
        'a_adderss' => $this->faker->word,
        'user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
