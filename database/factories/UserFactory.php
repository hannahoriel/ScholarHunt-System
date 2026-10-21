<?php

namespace Database\Factories;

use App\Models\User;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $birthday = fake()->dateTimeBetween('-25 years', '-18 years');

        return [
            'name' => fake()->name(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'surname' => fake()->lastName(),
            'birthday' => $birthday->format('Y-m-d'),
            'age' => (new DateTimeImmutable)->diff($birthday)->y,
            'sex' => fake()->randomElement(['male', 'female']),
            'contact_number' => fake()->numerify('09#########'),
            'education_level' => 'college',
            'shs_grade' => null,
            'shs_strand' => null,
            'college_year' => fake()->randomElement(['1', '2', '3', '4', '5']),
            'college_course' => fake()->word(),
            'school_name' => fake()->company(),
            'school_address' => fake()->address(),
            'address_street' => fake()->streetAddress(),
            'address_barangay' => fake()->citySuffix(),
            'address_city' => fake()->city(),
            'address_province' => fake()->state(),
            'address_zip' => fake()->numerify('####'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
