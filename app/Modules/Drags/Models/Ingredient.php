<?php

namespace App\Modules\Drags\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        'name',
        'active',
        'deleted'
    ];

    public function Drags()
    {
        return $this->belongsToMany('App\Modules\Drags\Models\Drag');
    }
}
