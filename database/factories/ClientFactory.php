<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username'=>$this->faker->unique()->userName,
            'firstname'=>$this->faker->firstName,//isbn10
            'lastname'=>$this->faker->lastName,
            'email'=>$this->faker->Email,
            'contact'=>$this->faker->unique()->isbn10,
            'password'=>$this->faker->password($minLength = 6, $maxLength = 30),
            'gender'=>$this->faker->randomElement(['M','F']),
        ];
    }
}
