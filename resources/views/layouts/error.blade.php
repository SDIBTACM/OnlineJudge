<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('/css/error.css')) }}">
</head>

<body>
<div class="full-height flex-center position-ref ">
        <div class="code">
            @yield('code')
        </div>

        <div class="message" style="padding: 10px;">
            @yield('message')
        </div>
</div>
</body>
</html>
