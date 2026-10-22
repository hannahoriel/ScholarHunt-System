<?php

namespace App\Http\Middleware;

use App\Models\ScholarshipApplication;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateOrDemo
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() && $request->session()->has('demo_user')) {
            $demoAccount = User::demoAccount();
            Auth::login($demoAccount);

            foreach ($request->session()->pull('demo_tracker', []) as $data) {
                if (! is_array($data) || ! isset($data['scholarship_id'], $data['scholarship_title'], $data['applied_at'])) {
                    continue;
                }

                ScholarshipApplication::firstOrCreate(
                    [
                        'user_id' => $demoAccount->id,
                        'scholarship_id' => $data['scholarship_id'],
                    ],
                    [
                        'scholarship_title' => $data['scholarship_title'],
                        'provider' => $data['provider'] ?? null,
                        'scholarship_type' => $data['scholarship_type'] ?? null,
                        'applied_at' => $data['applied_at'],
                        'application_reference' => $data['application_reference'] ?? null,
                        'notes' => $data['notes'] ?? null,
                        'status' => $data['status'] ?? 'applied',
                    ]
                );
            }

            $request->session()->forget('demo_user');
            $request->session()->regenerate();
        }

        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
