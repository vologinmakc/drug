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
                <form action="{{ URL::route('drags.update', ['Drag' => $drag]) }}" method="post" name="update_drag">
                    @csrf
                    <label for="ingredient_name">Название:</label>
                    <input class="form-control" type="text" name="name" value="{{ $drag->name }}">

                    <label for=""><small>Для множественного выбора используйте Ctrl</small></label><br>
                    <select class="custom-select" size="3" name="ingredients[]" multiple="multiple" required>
                        @foreach($ingredients as $ingredient)
                            <option value="{{$ingredient['id']}}">{{ $ingredient['name'] }}</option>
                        @endforeach
                    </select>
                    <small>Не менее 2 ингридиентов</small>
                    <hr>

                    <input class="btn btn-primary btn-sm m-2" type="submit" value="Отправить">
                </form>
            </div>
        </div>
    </div>

    <hr>
</div>
@endsection
