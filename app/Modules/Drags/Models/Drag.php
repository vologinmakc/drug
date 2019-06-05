<?php

namespace App\Modules\Drags\Models;

use Illuminate\Database\Eloquent\Model;

class Drag extends Model
{
    protected $fillable = ['name'];

    public function ingredients()
    {
        return $this->belongsToMany('App\Modules\Drags\Models\Ingredient');
    }
}
