<?php

namespace App\Modules\Drags\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Drags\Models\Drag;
use App\Modules\Drags\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DragController extends Controller
{

    public function index()
    {
        return view('Drags::index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if (Auth::user())
        {
            $data = $request->all();

            # первым делом сохраним Лекарство, если более одного ингридиента!
            if (isset($data['ingredients']) and count($data['ingredients']) > 1)
            {
                $drag = new Drag([
                    'name' => $data['name']
                ]);

                $drag->save();

                foreach ($data['ingredients'] as $ingredient)
                {
                    $drag_ingredients = Ingredient::find($ingredient);
                    $drag->ingredients()->save($drag_ingredients);
                }
            }

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

    public function search(Request $request)
    {
        dd($request->all());
    }
}
