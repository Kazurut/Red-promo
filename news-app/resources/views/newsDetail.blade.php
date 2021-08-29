@extends('layout')

@section('title')
{{ $data[0]->title }}
@endsection

<style>
    .h-img{
        height: 600px;
        object-fit: cover;
    }
    .similar-news{
        font-size: 20px;
        font-weight: 600;
    }
</style>

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <h1>Детальная страница новости</h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($data as $el)
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <img class="h-img" src="{{ $el->image }}">
                            <div class="card-body">
                                @php
                                    echo '<h2>' . $el->title . '</h2>';
                                    echo $el->text;
                                @endphp
                                <p class="similar-news">Похожие новости:</p>
                                @if(!empty($similarNews))
                                    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                                        @foreach($similarNews as $similarEl)
                                        <div class="col">
                                            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url({{ $similarEl->image }});">
                                                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                                                    <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ $similarEl->title }}</h2>
                                                    <ul class="d-flex list-unstyled mt-auto">
                                                        <li class="d-flex align-items-center me-3">
                                                            <small class="badge bg-primary text-wrap">tag: {{ $similarEl->category }}</small>
                                                        </li>
                                                        <li><a class="btn btn-Dark" href="/news/{{ $similarEl->id }}">Подробнее</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h2>Новость уникальна, и похожих нет(</h2>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a onclick="javascript:history.back(); return false;" class="btn btn-sm btn-outline-secondary">Назад</a>
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
