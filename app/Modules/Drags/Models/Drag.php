<?php

namespace App\Modules\Drags\Models;

use Illuminate\Database\Eloquent\Model;

class Drag extends Model
{
    protected $fillable = ['name', 'deleted'];

    public function ingredients()
    {
        return $this->belongsToMany('App\Modules\Drags\Models\Ingredient');
    }
}
