<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(50);

        return [
            'community_id' => rand(1, 50),
            'user_id' => rand(1, 100),
            'title' =>  $title,
            'post_text' => $this->faker->text(200),
            'approved' => 1,
            "slug" =>  Str::slug($title),
        ];
    }
}
