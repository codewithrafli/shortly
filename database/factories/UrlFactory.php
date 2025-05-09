<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'original_url' => $this->faker->url(),
            'short_url' => Str::random(6),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
