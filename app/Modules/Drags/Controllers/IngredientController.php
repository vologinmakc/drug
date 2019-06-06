<?php

namespace App\Modules\Drags\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Drags\Models\Drag;
use App\Modules\Drags\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //

    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        if (Auth::user())
        {
            $this->validate($request, [
                'name' => 'required|string'
            ]);
            $data = $request->all();

            $ingredients = new Ingredient();
            $ingredients->fill($data);
            $ingredients->save();

            return redirect()->back();

        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $ingredients = Ingredient::find($id);
        return view('Drags::admin.edit-ingredients', [
            'ingredient' => $ingredients
        ]);
    }


    public function update(Request $request, $id)
    {
        if (Auth::user())
        {
            $this->validate($request, [
                'name' => 'string|required'
            ]);
            $data = $request->all();

            $ingredients = Ingredient::find($id);
            $ingredients->fill($data);

            if (isset($data['active']) and $data['active'] == 'on')
            {
                $ingredients->active = true;
            } else
            {
                $ingredients->active = false;
            }

            $ingredients->save();

            $ingredient = Ingredient::all();
            $drags = Drag::all();

            return view('Drags::admin.index', [
                'ingredients' => $ingredient,
                'drags' => $drags
            ]);

        }
    }


    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->drags()->detach();

        $ingredient->delete();

        return redirect()->back();
    }
}

