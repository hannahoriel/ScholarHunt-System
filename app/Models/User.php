<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
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
            'password'          => 'hashed',
            'birthday'          => 'date',
        ];
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
