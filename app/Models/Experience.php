<?php // app/Models/Experience.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tags'       => 'array',
        'is_current' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /** Same keys the Blade timeline already uses. */
    public function toPortfolio(): array
    {
        return [
            'type'    => $this->type,
            'icon'    => $this->icon,
            'period'  => $this->period,
            'title'   => $this->title,
            'org'     => $this->org,
            'desc'    => $this->description,
            'tags'    => $this->tags ?? [],
            'current' => $this->is_current,
        ];
    }
}