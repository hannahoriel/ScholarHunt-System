<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $user = User::updateOrCreate(
            ['email' => 'annadelacruz@gmail.com'],
            [
                'first_name' => 'Anna',
                'middle_name' => null,
                'surname' => 'Dela Cruz',
                'birthday' => '2000-01-01',
                'email' => 'annadelacruz@gmail.com',
                'age' => 26,
                'sex' => 'female',
                'contact_number' => '09170000000',
                'education_level' => 'college',
                'shs_grade' => null,
                'shs_strand' => null,
                'college_year' => '1',
                'college_course' => 'Information Technology',
                'school_name' => 'ScholarHunt Demo School',
                'school_address' => '1 Demo Street, Manila',
                'address_street' => '1 Demo Street',
                'address_barangay' => 'Barangay 1',
                'address_city' => 'Manila',
                'address_province' => 'Metro Manila',
                'address_zip' => '1000',
                'password' => 'Demo1234',
            ],
        );

        $user->markEmailAsVerified();
    }
}
