<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Поиск лекарства!</title>
</head>
<body>

<h3>Поиск лекарства по ингридиентам</h3>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ URL::route('drags.search') }}" method="post">
                @csrf
                <label for=""><small>Для множественного выбора используйте Ctrl</small></label><br>
                <select class="custom-select" size="3" name="ingredients[]" multiple="multiple" required>
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



</body>
</html>
