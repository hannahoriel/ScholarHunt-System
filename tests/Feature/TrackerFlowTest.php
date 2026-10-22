<?php

namespace Tests\Feature;

use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackerFlowTest extends TestCase
{
    use RefreshDatabase;

    private function payload(): array
    {
        return [
            'scholarship_id' => 'dost-sei',
            'scholarship_title' => 'DOST-SEI Scholarship',
            'provider' => 'DOST',
            'scholarship_type' => 'government',
            'applied_at' => now()->toDateString(),
        ];
    }

    public function test_save_shows_in_tracker(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(
            route('dashboard.tracker.store'),
            $this->payload()
        );

        $response->assertCreated();
        $this->assertDatabaseHas('scholarship_applications', [
            'user_id' => $user->id,
            'scholarship_id' => 'dost-sei',
            'scholarship_title' => 'DOST-SEI Scholarship',
            'status' => 'applied',
        ]);

        $tracker = $this->actingAs($user)->get(route('dashboard.tracker'));
        $tracker->assertOk();
        $tracker->assertSee('DOST-SEI Scholarship');
        $tracker->assertSee('In progress');
    }

    public function test_update_changes_status_and_fields(): void
    {
        $user = User::factory()->create();
        $application = ScholarshipApplication::create([
            'user_id' => $user->id,
            'scholarship_id' => 'dost-sei',
            'scholarship_title' => 'DOST-SEI Scholarship',
            'applied_at' => now()->toDateString(),
            'status' => 'applied',
        ]);

        $response = $this->actingAs($user)->patch(
            route('dashboard.tracker.update', $application),
            [
                'status' => 'passed',
                'applied_at' => now()->toDateString(),
                'application_reference' => 'CONF-123',
                'notes' => 'Interview done',
            ]
        );

        $response->assertRedirect(route('dashboard.tracker'));
        $this->assertDatabaseHas('scholarship_applications', [
            'id' => $application->id,
            'status' => 'passed',
            'application_reference' => 'CONF-123',
            'notes' => 'Interview done',
        ]);

        $tracker = $this->actingAs($user)->get(route('dashboard.tracker'));
        $tracker->assertOk();
        $tracker->assertSee('Passed');
        $tracker->assertSee('CONF-123');
    }

    public function test_remove_deletes_from_tracker(): void
    {
        $user = User::factory()->create();
        $application = ScholarshipApplication::create([
            'user_id' => $user->id,
            'scholarship_id' => 'dost-sei',
            'scholarship_title' => 'DOST-SEI Scholarship',
            'applied_at' => now()->toDateString(),
            'status' => 'applied',
        ]);

        $response = $this->actingAs($user)->delete(
            route('dashboard.tracker.destroy', $application)
        );

        $response->assertRedirect(route('dashboard.tracker'));
        $this->assertDatabaseMissing('scholarship_applications', [
            'id' => $application->id,
        ]);

        $tracker = $this->actingAs($user)->get(route('dashboard.tracker'));
        $tracker->assertOk();
        $tracker->assertDontSee('DOST-SEI Scholarship');
    }

    public function test_real_login_flow_save_update_remove(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        // Real login form submission (goes through demo.or.auth middleware downstream).
        $this->post(route('login'), ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        // Save via the JSON endpoint like feed.js does.
        $this->postJson(route('dashboard.tracker.store'), $this->payload())->assertCreated();

        $application = ScholarshipApplication::where('user_id', $user->id)->first();
        $this->assertNotNull($application);

        // It shows on the tracker page.
        $this->get(route('dashboard.tracker'))->assertOk()->assertSee('DOST-SEI Scholarship');

        // Update the result.
        $this->patch(route('dashboard.tracker.update', $application), [
            'status' => 'passed',
            'applied_at' => now()->toDateString(),
        ])->assertRedirect(route('dashboard.tracker'));

        $this->get(route('dashboard.tracker'))->assertOk()->assertSee('Passed');

        // Remove it.
        $this->delete(route('dashboard.tracker.destroy', $application))
            ->assertRedirect(route('dashboard.tracker'));

        $this->get(route('dashboard.tracker'))->assertOk()->assertDontSee('DOST-SEI Scholarship');
    }

    public function test_user_cannot_update_another_users_application(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $application = ScholarshipApplication::create([
            'user_id' => $owner->id,
            'scholarship_id' => 'dost-sei',
            'scholarship_title' => 'DOST-SEI Scholarship',
            'applied_at' => now()->toDateString(),
            'status' => 'applied',
        ]);

        $response = $this->actingAs($intruder)->patch(
            route('dashboard.tracker.update', $application),
            ['status' => 'failed', 'applied_at' => now()->toDateString()]
        );

        $response->assertForbidden();
        $this->assertDatabaseHas('scholarship_applications', [
            'id' => $application->id,
            'status' => 'applied',
        ]);
    }
}
