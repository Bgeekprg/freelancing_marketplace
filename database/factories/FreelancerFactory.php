<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Freelancer>
 */
class FreelancerFactory extends Factory
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
            'email'=>$this->faker->safeEmail,
            'contact'=>$this->faker->unique()->isbn10,
            'password'=>$this->faker->password($minLength = 6, $maxLength = 20),
            'gender'=>$this->faker->randomElement(['M','F']),
            'description'=>$this->faker->text(80),
            'profile_pic'=>$this->faker->imageUrl($width=120,$height=120),

        ];
    }
}
