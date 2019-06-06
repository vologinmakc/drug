@extends('Drags::layouts.public')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Поиск лекарства по ингридиентам</h3>
        </div>
    </div>
            <div class="row">
                <div class="col">
            <form action="{{ URL::route('drags.search') }}" method="post">
                @csrf
                <label for=""><small>Для множественного выбора используйте Ctrl</small></label><br>
                <select class="custom-select" size="3" name="ingredients[]" multiple="multiple" id="ingredients" required>
                    @foreach($ingredients as $ingredient)
                        <option value="{{$ingredient['id']}}">{{ $ingredient['name'] }}</option>
                    @endforeach
                </select>
                <small>Не менее 2 ингридиентов</small>
                <hr>
                <input type="submit" class="btn btn-outline-primary btn-sm" value="Искать">
            </form>
        </div>
    </div>
</div>
@endsection
