<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
<header>
    <nav class="navbar navbar-dark bg-dark shadow-sm navbar-expand-lg">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a href="/news" class="nav-link">Все новости</a>
                    </li>
                </ul>
                <form class="d-flex" method="POST" action="/search">
                    @csrf
                    <input name="search" id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" required>
                    <button class="btn btn-outline-info" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>
</header>

@yield('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function addToChosen(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/addToChosen",
            method: 'post',
            data: {id: id},
            success: function(result){
                console.log(result);
                if(result[0]['chosen'] == 1){
                    $( '#addToChosen-' + id ).html('Добавить в избранное');
                    $( '#addToChosen-' + id ).toggleClass('btn-outline-danger');
                    $( '#addToChosen-' + id ).toggleClass('btn-outline-primary');
                }else if(result[0]['chosen'] == 0){
                    $( '#addToChosen-' + id ).html('Удалить из избранного');
                    $( '#addToChosen-' + id ).toggleClass('btn-outline-danger');
                    $( '#addToChosen-' + id ).toggleClass('btn-outline-primary');
                }
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
                console.log('error');
            },
        });
    }
</script>
</body>
</html>
