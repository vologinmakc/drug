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
            <h4>Добавить ингридиент</h4>
            <div>
                <form action="{{ URL::route('drags.ingredient.store') }}" method="post" name="create_ingredient">
                    @csrf
                    <label for="ingredient_name">Название:</label>
                    <input class="form-control" type="text" name="name">
                    <input class="btn btn-primary btn-sm m-2" type="submit" value="Отправить">
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            <h4>Создать лекарство</h4>
            <div>
                <form action="{{ URL::route('drags.store') }}" method="post">
                    @csrf
                    <label for="name">Название лекарства:</label>
                    <input class="form-control" type="text" name="name" required>
                    <label for=""><small>Для множественного выбора используйте Ctrl</small></label><br>
                    <select class="custom-select" size="3" name="ingredients[]" multiple="multiple">
                        @foreach($ingredients as $ingredient)
                            <option value="{{$ingredient['id']}}">{{ $ingredient['name'] }}</option>
                        @endforeach
                    </select>
                    <small>Не менее 2 ингридиентов</small>
                    <hr>
                    <input class="btn btn-primary btn-sm" type="submit" value="Создать лекарство">
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            <h4>Измененить ингридиент</h4>
            <div>
                <small>Доступные ингридиенты</small>
                <br>
                @if($ingredients->count() > 0)
                    @foreach($ingredients as $ingredient)
                        <a href="{{ URL::route('drags.ingredient.edit', ['Ingredient' => $ingredient]) }}">{{ $ingredient['name'] }}</a>
                        <form action="{{ URL::route('drags.ingredient.delete', ['Ingredient' => $ingredient]) }}" method="post">
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Удалить" />
                            <input type="hidden" name="_method" value="delete" />
                            @csrf
                        </form>
                    @endforeach
                @endif
                <hr>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col">
            <h4>Измененить лекарство</h4>
            <div>
                <small>Доступные лекарствa</small>
                <br>
                @if($drags->count() > 0)
                    @foreach($drags as $drag)
                        <a href="{{ URL::route('drags.edit', ['Drag' => $drag]) }}">{{ $drag->name }}</a>
                        <form action="{{ URL::route('drags.delete', ['Drag' => $drag]) }}" method="post">
                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Удалить" />
                            <input type="hidden" name="_method" value="delete" />
                            @csrf
                        </form>
                        <hr>
                    @endforeach
                @endif
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection
