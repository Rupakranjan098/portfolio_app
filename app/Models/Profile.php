<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profile extends Model
{
    protected $guarded = [];

    protected function linkedinUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }

    protected function githubUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }

    protected function twitterUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }

    protected function websiteUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
            set: fn ($value) => $value ? (preg_match('/^(https?:)?\/\//i', $value) ? $value : 'https://' . $value) : null,
        );
    }
}
