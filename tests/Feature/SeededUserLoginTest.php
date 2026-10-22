<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DemoUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeededUserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_user_can_log_in_and_reseeding_does_not_duplicate_it(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'first_name' => 'Test',
        ]);

        $this->post(route('login.submit'), [
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assertRedirectToRoute('dashboard');
    }

    public function test_demo_user_is_not_seeded_in_production(): void
    {
        $originalEnvironment = $this->app['env'];
        $this->app['env'] = 'production';

        try {
            $this->app->make(DemoUserSeeder::class)->run();
        } finally {
            $this->app['env'] = $originalEnvironment;
        }

        $this->assertDatabaseMissing('users', [
            'email' => 'test@example.com',
        ]);
    }
}
