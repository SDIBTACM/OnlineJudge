<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.component.app.header')
<body>
    <header>
        @include('layouts.component.app.navbar')
    </header>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.component.footer')
</body>
</html>
