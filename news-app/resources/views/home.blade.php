@extends('layout')

@section('title')
    Главная старница
@endsection

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <h1>Избранные новости</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($data as $el)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ $el->image }}">
                            <div class="card-body">
                                @php
                                    echo '<h4>' . $el->title . '</h4>';
                                    echo '<p class="card-text">' . $el->description . '</p>';
                                @endphp
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/news/{{ $el->id }}" class="btn btn-sm btn-outline-success">Просмотреть</a>
                                        @if($el->chosen !== 1)
                                            <button id="addToChosen-{{ $el->id }}" onclick="addToChosen({{ $el->id }})" type="button" class="btn btn-sm btn-outline-primary">Добавить в избранное</button>
                                        @else
                                            <button id="addToChosen-{{ $el->id }}" onclick="addToChosen({{ $el->id }})" type="button" class="btn btn-sm btn-outline-danger">Удалить из избранного</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
