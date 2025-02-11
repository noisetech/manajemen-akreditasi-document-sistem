<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @include('partials.be.style')
</head>

<body>
    <div id="app">

        @include('partials.be.sidebar')

        <div id="main">

            @yield('content')

            @include('partials.be.footer')

        </div>
    </div>

    @include('partials.be.script')
</body>

</html>
