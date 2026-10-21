<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public const SHS_STRANDS = [
        'ABM'     => 'ABM — Accountancy, Business and Management',
        'STEM'    => 'STEM — Science, Technology, Engineering and Mathematics',
        'HUMSS'   => 'HUMSS — Humanities and Social Sciences',
        'GAS'     => 'GAS — General Academic Strand',
        'TVL-HE'  => 'TVL — Home Economics',
        'TVL-ICT' => 'TVL — Information and Communications Technology',
        'TVL-IA'  => 'TVL — Industrial Arts',
        'TVL-AFA' => 'TVL — Agri-Fishery Arts',
        'SPORTS'  => 'Sports Track',
        'ARTS'    => 'Arts and Design Track',
    ];

    public function create()
    {
        return view('pages.auth.register', ['strands' => self::SHS_STRANDS]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'first_name'  => ['required', 'string', 'max:80'],
            'middle_name' => ['nullable', 'string', 'max:80'],
            'surname'     => ['required', 'string', 'max:80'],
            'age'         => ['required', 'integer', 'between:12,80'],
            'sex'         => ['required', Rule::in(['male', 'female'])],
            'birthday'    => ['required', 'date', 'before:today', 'after:1930-01-01'],
            'email'       => ['required', 'email:rfc', 'max:254', 'unique:users,email'],
            'contact_number' => ['required', 'regex:/^(09|\+639)\d{9}$/'],

            'education_level' => ['required', Rule::in(['shs', 'college'])],
            'shs_grade'      => ['required_if:education_level,shs', 'nullable', Rule::in(['11', '12'])],
            'shs_strand'     => ['required_if:education_level,shs', 'nullable', Rule::in(array_keys(self::SHS_STRANDS))],
            'college_year'   => ['required_if:education_level,college', 'nullable', Rule::in(['1', '2', '3', '4', '5'])],
            'college_course' => ['required_if:education_level,college', 'nullable', 'string', 'max:150'],
            'school_name'    => ['required', 'string', 'max:150'],
            'school_address' => ['required', 'string', 'max:255'],

            'address_street'   => ['required', 'string', 'max:150'],
            'address_barangay' => ['required', 'string', 'max:100'],
            'address_city'     => ['required', 'string', 'max:100'],
            'address_province' => ['required', 'string', 'max:100'],
            'address_zip'      => ['required', 'digits:4'],

            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'terms'    => ['accepted'],
        ], [
            'contact_number.regex' => 'Use a Philippine mobile number, e.g. 09171234567.',
            'terms.accepted'       => 'Please agree to the Terms and Privacy Policy to continue.',
        ]);

        // Create the user — password is auto-hashed via the model cast.
        $user = User::create([
            'first_name'      => $data['first_name'],
            'middle_name'     => $data['middle_name'] ?? null,
            'surname'         => $data['surname'],
            'birthday'        => $data['birthday'],
            'age'             => $data['age'],
            'sex'             => $data['sex'],
            'contact_number'  => $data['contact_number'],
            'education_level' => $data['education_level'],
            'shs_grade'       => $data['shs_grade'] ?? null,
            'shs_strand'      => $data['shs_strand'] ?? null,
            'college_year'    => $data['college_year'] ?? null,
            'college_course'  => $data['college_course'] ?? null,
            'school_name'     => $data['school_name'],
            'school_address'  => $data['school_address'],
            'address_street'  => $data['address_street'],
            'address_barangay'=> $data['address_barangay'],
            'address_city'    => $data['address_city'],
            'address_province'=> $data['address_province'],
            'address_zip'     => $data['address_zip'],
            'email'           => $data['email'],
            'password'        => $data['password'],
        ]);

        // Fire the Registered event — this triggers the VerifyEmail notification
        // because User implements MustVerifyEmail.
        event(new Registered($user));

        // Log the user in immediately (unverified); they'll be shown the notice page.
        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}
