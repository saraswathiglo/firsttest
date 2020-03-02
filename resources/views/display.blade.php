<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="title">Test</div><br>
            <div class="title">View Article</div>
            <div class="title"><a href="{{ url('test') }}"> > Back</a></div>

            @if (count($errors) < 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="title"><h5>Article Title: </h5> {{ $article->title }} </div>
            <div class="title"><h5>Article URL: </h5> <a href="{{ $article->url }}"> {{ $article->url }} </a></div>
            <div class="title"><h5>Article Image: </h5> <img src="../{{ $article->image }}" style="max-width: 100px;"> </div>
            <div class="title"><h5>Article Description: </h5> {{ $article->description }} </div>
            
        </div>
    </body>
</html>
