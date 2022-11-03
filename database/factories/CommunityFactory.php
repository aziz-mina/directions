<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(15);

        return [
            "name" => $name,
            "user_id" => rand(1, 100),
            "description" => $this->faker->text(250),
            "verified" => true,
            "slug" =>  Str::slug($name),
            "color_palette" =>  ["#41BDF3", "#85D1F3"],
        ];
    }
}
