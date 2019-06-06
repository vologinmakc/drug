<?php

namespace App\Modules\Drags\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Drags\Models\Drag;
use App\Modules\Drags\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user())
        {
            $ingredient = Ingredient::all();
            $drags = Drag::all();
            return view('Drags::admin.index', [
                'ingredients' => $ingredient,
                'drags' => $drags
            ]);
        }

    }

}
