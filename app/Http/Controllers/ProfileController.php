<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(): View
    {
        abort_unless(auth()->user() instanceof \App\Models\User, 403, 'Profile settings require a registered account.');
        return view('pages.profile');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        abort_unless($user instanceof \App\Models\User, 403, 'Profile settings require a registered account.');
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'middle_name' => ['nullable', 'string', 'max:80'],
            'surname' => ['required', 'string', 'max:80'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'birthday' => ['required', 'date', 'before:today'],
            'sex' => ['required', Rule::in(['male', 'female'])],
            'contact_number' => ['required', 'string', 'max:15'],
            'education_level' => ['required', Rule::in(['shs', 'college'])],
            'shs_grade' => ['nullable', Rule::in(['11', '12'])],
            'shs_strand' => ['nullable', 'string', 'max:20'],
            'college_year' => ['nullable', Rule::in(['1', '2', '3', '4', '5'])],
            'college_course' => ['nullable', 'string', 'max:150'],
            'school_name' => ['required', 'string', 'max:150'],
            'school_address' => ['required', 'string', 'max:255'],
            'address_street' => ['required', 'string', 'max:150'],
            'address_barangay' => ['required', 'string', 'max:100'],
            'address_city' => ['required', 'string', 'max:100'],
            'address_province' => ['required', 'string', 'max:100'],
            'address_zip' => ['required', 'digits:4'],
        ]);
        if ($data['email'] !== $user->email) {
            $data['email_verified_at'] = null;
        }
        $birthday = \Illuminate\Support\Carbon::parse($data['birthday']);
        $data['age'] = $birthday->age;
        if ($data['education_level'] === 'shs') {
            $data['college_year'] = $data['college_course'] = null;
        } else {
            $data['shs_grade'] = $data['shs_strand'] = null;
        }
        $user->update($data);
        return back()->with('status', 'Your profile has been updated.');
    }

    public function password(Request $request): RedirectResponse
    {
        abort_unless($request->user() instanceof \App\Models\User, 403, 'Password settings require a registered account.');
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        $request->user()->update(['password' => Hash::make($data['password'])]);
        return back()->with('status', 'Password changed successfully.');
    }
}
