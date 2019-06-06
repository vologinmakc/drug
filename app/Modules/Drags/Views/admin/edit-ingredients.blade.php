@extends('Drags::layouts.public')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Страница Админа</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4>Изменить ингридиент</h4>
            <div>
                <form action="{{ URL::route('drags.ingredient.update', ['Ingredient' => $ingredient]) }}" method="post" name="create_ingredient">
                    @csrf
                    <label for="ingredient_name">Название:</label>
                    <input class="form-control" type="text" name="name" value="{{ $ingredient->name }}">

                    <div class="form-group form-check">
                        <input type="checkbox" name="active" class="form-check-input" @if($ingredient->active) checked @endif>
                        <label class="form-check-label" for="">Разрешенный элемент?</label>
                    </div>

                    <input class="btn btn-primary btn-sm m-2" type="submit" value="Отправить">
                </form>
            </div>
        </div>
    </div>

    <hr>
</div>
@endsection
