<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Title',
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
            ->map(function($paragraph){
                return "<p>$paragraph</p>";
            })
            ->implode(''),
            'image' => '',
            'category_id' => 1,
            'user_id' => 1,
        ];
    }
}
