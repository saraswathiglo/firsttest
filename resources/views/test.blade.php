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

            <div class="title">Test</div>
            <div class="title"><a href="{{ url('create') }}">Create New Test</a></div>
            <div class="title"><h4>Articles</h4></div>
            <table>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Descrition</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($articles as $article)
                        <tr>
                            <td> {{ $i }}</td>
                            <td> <a href="{{ $article->url }}"> {{ $article->title }} </a></td>
                            <td> <img src="{{ $article->image }}" style="width:80px;"></td>
                            <td>{{ str_limit($article->description , $limit = 50) }}</td>
                            <td>
                                <a href="{{ url('/show', $article->id) }}"> View </a> &nbsp; 
                                <a href="{{ url('/edit', $article->id) }}"> Edit </a> &nbsp; 
                                <a href="{{ url('/delete', $article->id) }}"> Delete </a> &nbsp; 
                            </td>
                        </tr>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </body>
</html>
