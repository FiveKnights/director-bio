<?php // app/Models/SocialLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    /** Same keys the Blade network block already uses. */
    public function toPortfolio(): array
    {
        return [
            'icon'   => $this->icon,
            'name'   => $this->name,
            'handle' => $this->handle,
            'desc'   => $this->description,
            'url'    => $this->url,
        ];
    }
}