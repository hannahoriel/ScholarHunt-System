<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScholarshipApplication extends Model
{
    protected $fillable = [
        'user_id', 'scholarship_id', 'scholarship_title', 'provider',
        'scholarship_type', 'applied_at', 'application_reference', 'notes', 'status',
    ];

    protected function casts(): array
    {
        return ['applied_at' => 'date'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
