<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
<h2>Страница Админа</h2>
<div class="container">
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
                    <hr>
                    <input class="btn btn-primary btn-sm" type="submit" value="Создать лекарство">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
