<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    protected function githubUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }

    protected function projectUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }
}
