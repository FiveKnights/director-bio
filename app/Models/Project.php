<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'code', 'title', 'status', 'short_desc', 'full_desc',
        'tags', 'highlights', 'image', 'github_url', 'demo_url',
        'sort_order', 'is_visible',
    ];

    protected $casts = [
        'tags'       => 'array',
        'highlights' => 'array',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** Shape the front-end JavaScript expects. */
    public function toPortfolio(): array
    {
        return [
            'code'       => $this->code,
            'title'      => $this->title,
            'status'     => $this->status,
            'shortDesc'  => $this->short_desc,
            'tags'       => $this->tags ?? [],
            'fullDesc'   => $this->full_desc,
            'highlights' => $this->highlights ?? [],
            'imageUrl'   => $this->image ? asset($this->image) : null,
            'links'      => [
                'github' => $this->github_url,
                'demo'   => $this->demo_url,
            ],
        ];
    }
}