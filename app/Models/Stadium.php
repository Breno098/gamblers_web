<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    protected $fillable = [
        'name',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
