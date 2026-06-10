<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
