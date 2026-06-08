<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'additional_images' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
