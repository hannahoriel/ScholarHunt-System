<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'birthday',
        'age',
        'sex',
        'contact_number',
        'education_level',
        'shs_grade',
        'shs_strand',
        'college_year',
        'college_course',
        'school_name',
        'school_address',
        'address_street',
        'address_barangay',
        'address_city',
        'address_province',
        'address_zip',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }

    public static function demoAccount(): self
    {
        return self::firstOrCreate(
            ['email' => 'demo@scholarhunt.test'],
            [
                'first_name' => 'Demo',
                'surname' => 'Scholar',
                'birthday' => '2005-01-01',
                'age' => 21,
                'sex' => 'male',
                'contact_number' => '09171234567',
                'education_level' => 'college',
                'college_year' => '1',
                'college_course' => 'Undeclared',
                'school_name' => 'ScholarHunt Demo University',
                'school_address' => 'Manila, Metro Manila',
                'address_street' => 'Demo Street',
                'address_barangay' => 'Demo Barangay',
                'address_city' => 'Manila',
                'address_province' => 'Metro Manila',
                'address_zip' => '1000',
                'password' => 'demo1234',
            ]
        );
    }

    /** Full display name built from stored parts. */
    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->surname,
        ])));
    }
}
