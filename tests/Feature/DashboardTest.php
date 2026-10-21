<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_verified_user_sees_the_dashboard_home_and_discover_link(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('YOUR SCHOLARHUNT DASHBOARD')
            ->assertSee('Dashboard')
            ->assertSee('aria-label="Main navigation"', false)
            ->assertSee('id="menu-btn"', false)
            ->assertSee(route('dashboard.discover'), false);
    }

    public function test_discover_route_displays_scholarship_feed_and_type_filters(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard.discover'))
            ->assertOk()
            ->assertSee('All types')
            ->assertSee('Government')
            ->assertSee('DOST-SEI Undergraduate Scholarship')
            ->assertSee('Back to dashboard')
            ->assertSee('id="menu-btn"', false)
            ->assertSee('id="feed-data"', false)
            ->assertDontSee('<style')
            ->assertDontSee('<script>')
            ->assertDontSee('Toggle sidebar')
            ->assertDontSee('id="feed-sidebar-toggle"', false)
            ->assertSee('href="'.route('dashboard').'"', false);
    }

    public function test_reviewer_sidebar_link_opens_reviewer_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('href="'.route('dashboard.reviewer').'"', false);

        $this->get(route('dashboard.reviewer'))
            ->assertOk()
            ->assertSee('Prepare with purpose.');
    }

    public function test_verified_login_redirects_to_dashboard_home(): void
    {
        $user = User::factory()->create([
            'email' => 'student@example.com',
            'password' => 'password',
        ]);

        $this->post(route('login.submit'), [
            'email' => 'student@example.com',
            'password' => 'password',
        ])->assertRedirectToRoute('dashboard');

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('YOUR SCHOLARHUNT DASHBOARD');
    }
}
