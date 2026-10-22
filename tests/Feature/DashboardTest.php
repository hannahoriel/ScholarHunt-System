<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\MockExamData;
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

    public function test_dashboard_sidebar_displays_a_csrf_protected_logout_button(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('method="POST"', false)
            ->assertSee('action="'.route('logout').'"', false)
            ->assertSee('name="_token"', false)
            ->assertSee('Log out');
    }

    public function test_logout_redirects_to_landing_page_and_ends_the_authenticated_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirectToRoute('landing');

        $this->assertGuest();
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

        $reviewerResponse = $this->get(route('dashboard.reviewer'));

        $reviewerResponse
            ->assertOk()
            ->assertSee('Prepare with purpose.')
            ->assertSee('id="mock-exam-data"', false)
            ->assertSee('max="70"', false)
            ->assertSee('Multiple choice');

        foreach (MockExamData::subjects() as $subject => $exam) {
            $reviewerResponse
                ->assertSee($exam['title'])
                ->assertSee(route('dashboard.reviewer.download', ['subject' => $subject]), false);

            $this->assertFileExists(storage_path('app/mock-exams/'.$exam['pdf']));
        }
    }

    public function test_verified_user_can_download_a_mock_exam_from_private_storage(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        foreach (MockExamData::subjects() as $subject => $exam) {
            $this->get(route('dashboard.reviewer.download', ['subject' => $subject]))
                ->assertDownload($exam['pdf'])
                ->assertHeader('Content-Type', 'application/pdf');
        }
    }

    public function test_guest_cannot_download_a_mock_exam(): void
    {
        $this->get(route('dashboard.reviewer.download', ['subject' => 'math']))
            ->assertRedirectToRoute('login');
    }

    public function test_unknown_mock_exam_subject_returns_not_found(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard.reviewer.download', ['subject' => '..']))
            ->assertNotFound();
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
