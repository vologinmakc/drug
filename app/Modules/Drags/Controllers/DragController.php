<?php

namespace App\Modules\Drags\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Drags\Models\Drag;
use App\Modules\Drags\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $drag = Drag::find($id);
        $drag_ingredients = Ingredient::all();

        return view('Drags::admin.edit-drag', [
            'drag' => $drag,
            'ingredients' => $drag_ingredients
        ]);
    }


    public function update(Request $request, $id)
    {
        if (Auth::user())
        {
            Validator::extend('ingredients_array', function ($attribute, $value, $parameters)
            {
                if (is_array($value) and count($value) > 1)
                {
                    return true;
                }

                session()->flash('warning', 'Более 2 ингридиентов');
                return false;
            });

            $this->validate($request, [
                'name' => 'string|required',
                'ingredients' => 'ingredients_array|required'
            ]);

            $data = $request->all();

            # первым делом сохраним Лекарство, если более одного ингридиента!
            if (isset($data['ingredients']) and count($data['ingredients']) > 1)
            {
                $drag = Drag::find($id);
                $drag->name = $data['name'];
                $drag->ingredients()->detach();
                $drag->save();

                foreach ($data['ingredients'] as $ingredient)
                {
                    $drag_ingredients = Ingredient::find($ingredient);
                    $drag->ingredients()->save($drag_ingredients);
                }
            }

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
        $drag = Drag::find($id);
        $drag->deleted = true;
        $drag->save();

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $this->create_validator($request);

        $drags = $this->search_drags($request);

        if ($drags)
        {
            # Добавим доп поле с количеством элементов
            $drags->transform(function ($item)
            {
                $item->count_ingredients = $item->ingredients()->count();
                foreach ($item->ingredients as $ingredient_active)
                {
                    if (($ingredient_active->active == false) or ($ingredient_active->deleted == true))
                    {
                        $item->active = 'forbidden';
                    }
                }

                return $item;
            });


            return view('Drags::search', [
                'drags' => $drags->where('active', '!=', 'forbidden')->where('deleted', '!=', true)
                    ->sortByDesc('count_ingredients')
            ]);
        }
    }

    public function create_validator($request)
    {
        Validator::extend('ingredients_array', function ($attribute, $value, $parameters)
        {
            if (is_array($value) and count($value) > 1)
            {
                return true;
            }
            session()->flash('warning', 'не ленись, добавь веществ');
            return false;
        });

        $this->validate($request, [
            'ingredients' => 'ingredients_array'
        ]);
    }

    public function search_drags($request)
    {
        # Получим все лекаства по ингридиентам с точным совпадением по ингридиентам
        $drags = Drag::whereHas('ingredients', function ($q) use ($request)
        {
            $q->whereIn('ingredient_id', $request['ingredients'])->havingRaw('count(*) >=' . count($request['ingredients']))
                ->where('ingredients.active', true)->where('ingredients.deleted', false);

        })->with('ingredients')->get();

        # Если точных совпадений нет то ищем частичные
        if (!$drags->count() > 0)
        {
            $drags = Drag::whereHas('ingredients', function ($q) use ($request)
            {
                $q->whereIn('ingredient_id', $request['ingredients'])->havingRaw('count(*) >= 2');

            })->with('ingredients')->get();

        }

        return $drags;
    }
}
