<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                /* align-items: center; */
                display: flex;
                /* justify-content: center; */
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                /* text-align: center; */
                margin: 50px;
            }

            .title {
                font-size: 34px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            
            .post-box {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 15px;
                display: flex;
                
                -webkit-box-shadow: 0px 5px 3px 0px #ccc;
                -moz-box-shadow: 0px 5px 3px 0px #ccc;
                box-shadow: 0px 5px 3px 0px #ccc;
            }

            .post-box.odd {
                background-color: #eee;
            }

            .post-box .image {                
                /* flex-grow: 1; */
            }

            .post-box .story-image {
                width: 80px;
                height: 150px;
            }

            .post-box .body {
                border-right: 1px solid #ccc;
                padding: 0 15px;
                flex-grow: 1;
                max-width: 700px;
            }

            .post-box .body h3 {
                margin-top: 0;
            }
            
            .post-box .author {
                justify-content: flex-end;
                text-align: center;
                padding: 0 30px;
                width: 150px;
            }

            .post-box .author-img {
                border-radius: 50%;
                width: 100px;
            }

            .post-box .author-name {
                color: red;
                font-weight: bold;
            }

            .paging {
                display: flex;
                flex-direction: row;
                justify-content: center;
                margin: 30px 0;
                list-style-type: none;
            }

            .paging li {
                margin: 0 5px;
                padding: 5px 10px;
            }

            .paging li.active {
                background-color: red;
                border-radius: 50%;                
            }
            
            .paging li.active a {
                color: #fff;
            }

            .paging a {
                text-decoration: none;
                font-weight: bold;
            }
        </style>
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

            <div class="content">
                <div class="title m-b-md">
                    MAQE Forums<br>
                    Subtitle<br>
                    Posts
                </div>                
                <section>
                @foreach($posts->slice(0, 8) as $k => $post)
                    @if ($k % 2 == 0)
                    <div class="post-box">
                    @else
                    <div class="post-box odd">
                    @endif                    
                        <div class="image">
                            <img src="{{ $post['image_url'] }}" alt="{{ $post['title' ]}}">
                        </div>
                        <div class="body">
                            <h3>{{ $post['title'] }}</h3>
                            <p>{{ $post['body'] }}</p>
                            <p>{{ $post['created_at'] }}</p>
                        </div>
                        <div class=author>
                            <img class="author-img" src="{{ $post['author_detail']['avatar_url'] }}" alt="Author Avatar">
                            <div class="author-name">{{ $post['author_detail']['name'] }}</div>
                            <div>{{ $post['author_detail']['role'] }}</div>
                            <div>{{ $post['author_detail']['place'] }}</div>
                        </div>
                    </div>
                @endforeach
                </section>
                <ul class="paging">
                    <li><a href="#">Previous</a></li>
                    @for ($i = 1; $i <= $page_count; $i++)
                        @if ($i == 1)
                        <li class="active"><a href="#">{{ $i }}</a></li>
                        @else
                        <li><a href="#">{{ $i }}</a></li>
                        @endif                        
                    @endfor
                    <li><a href="#">Next</a></li>                    
                </div>
            </div>            
        </div>
    </body>
</html>
