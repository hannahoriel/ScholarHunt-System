<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scholarship extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'provider',
        'type',
        'levels',
        'tags',
        'summary',
        'benefits',
        'eligibility',
        'requirements',
        'opens',
        'deadline',
        'link',
        'application_link',
        'is_published',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'levels' => 'array',
            'requirements' => 'array',
            'opens' => 'date',
            'deadline' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Scope: only published scholarships visible to students. */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    /** Scope: full-text-style search across title, provider, tags, summary. */
    public function scopeSearch(Builder $query, string $term): void
    {
        $like = '%'.mb_strtolower($term).'%';
        $query->where(function (Builder $q) use ($like): void {
            $q->whereRaw('LOWER(title) LIKE ?', [$like])
                ->orWhereRaw('LOWER(provider) LIKE ?', [$like])
                ->orWhereRaw('LOWER(tags) LIKE ?', [$like])
                ->orWhereRaw('LOWER(summary) LIKE ?', [$like])
                ->orWhereRaw('LOWER(type) LIKE ?', [$like]);
        });
    }

    /** Human-readable label for the scholarship type. */
    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst($this->type);
    }

    /** Whether the scholarship targets the given education level. */
    public function isForLevel(string $level): bool
    {
        return in_array($level, $this->levels ?? [], true);
    }

    public const TYPES = [
        'government' => 'Government',
        'school' => 'School / University',
        'nonprofit' => 'Non-Profit & Foundation',
        'corporate' => 'Corporate / Company',
        'community' => 'Community-Based',
        'cadetship' => 'Cadetship Programs',
        'international' => 'International',
    ];
}
