<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TGC Societies Leaderboards</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/screen.css') }}">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <spaan class="branding">
                    TGC Societies
                </spaan>
                <nav class="main-nav">
                    <a href="#" class="active">Home</a>
                    <a href="#">Societies</a>
                    <span class="sep"><i class="fa fa-circle"></i></span>
                    @if(Auth::check())
                    <div class="dropdown">
                        <span>
                            {{ Auth::user()->gamer_tag }}
                            <i class="fa fa-caret-down"></i>
                        </span>
                        <div class="hitspot"></div>
                        <nav class="dropdown-nav">
                            <a href="/my/societies">Your Societies</a>
                            <a href="/my/tourneys">Your Tournaments</a>
                            <form method="post" action="/logout">
                                {{ csrf_field() }}
                                <button type="submit">Logout</button>
                            </form>
                        </nav>
                    </div>
                    @else
                    <a href="/login" class="login-register">Login</a>
                    <span class="slash">/</span>
                    <a href="/register" class="login-register">Register</a>
                    @endif
                </nav>
            </div>
        </header>
        <main class="main-content">
            @yield('contents')
        </main>
        <footer class="footer">
            Made by <a href="https://www.reddit.com/user/enjoibp6/" target="_blank">/u/enjoibp6</a>. Not associated with HB Studios, or Maximum Games.
        </footer>
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
