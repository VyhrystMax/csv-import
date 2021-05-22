<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Max Vyhryst">
        <title>CSV Import Test</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
                        <strong>CSV Import Test</strong>
                    </a>
                    <a href="{{ route('products') }}" class="navbar-brand d-flex align-items-center">
                        <strong>Products</strong>
                    </a>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </body>
</html>
