<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name', 'category', 'level', 'description', 'sort_order', 'is_visible',
    ];

    protected $casts = [
        'level'      => 'integer',
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

    public function toPortfolio(): array
    {
        return [
            'name'     => $this->name,
            'category' => $this->category,
            'level'    => $this->level,
            'desc'     => $this->description,
        ];
    }
}