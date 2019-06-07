@extends('Drags::layouts.public')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Результат поиска</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if(isset($drags))
                @foreach($drags as $drag)
                    <h5>{{ $drag->name }}</h5>
                    <small>Количество ингридиентов:{{ $drag->ingredients()->count() }}</small><br>
                    @foreach($drag->ingredients as $ingredient)
                        <small class="text-info">{{ $ingredient->name }}</small><br>
                    @endforeach
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
