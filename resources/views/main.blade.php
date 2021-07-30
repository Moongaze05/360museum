<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Музей</title>
</head>

<body>
<header class="header">
    <div class="header-flex">
        <div class="logo">
            <img src="{{ Storage::url('assets/logo2.svg') }}" alt="logo">
        </div>
        <h1 class="logo-description">Виртуальная экскурсия</h1>
        <img class="logo-description-img" src="{{ Storage::url('assets/logoname.svg') }}" alt="logo">
    </div>
</header>
<main class="main">
    <div class="main-container">
        @foreach($museums as $museum)
        <a href="{{ route('museum', ['museum' => $museum]) }}">
            <section class="main-card">
                <div class="main-card-img">
                    <img src="{{ $museum->preview }}" alt="first museum" class="main-card-img">
                    <img class="play" src="{{ Storage::url('assets/play.svg') }}" alt="">
                </div>
                <div class="main-card-description">
                    <img src="{{ $museum->logo }}" alt="description">
                    <h4 class="main-card-city">&thinsp;{{ $museum->title }}</h4>
            </div>
            </section>
        </a>
        @endforeach
    </div>

</main>
<footer></footer>

</body>

</html>
