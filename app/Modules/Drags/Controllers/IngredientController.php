<?php

namespace App\Modules\Drags\Controllers;

use App\Http\Controllers\Controller;
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
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

