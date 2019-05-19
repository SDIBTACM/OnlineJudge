<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.component.backstage.header')
    <body>

        <header>
            @include('layouts.component.backstage.navbar')
        </header>

        <div id="left-col">
            @include('layouts.component.backstage.sidebar')
        </div>

        <div id="right-col">
            <div id="app">
                <main class="py-4">
                    @yield('content')
                </main>

            </div>
            <script>
                const app = new Vue({
                    el: '#app'
                });
            </script>
            @include('layouts.component.footer')
        </div>

    </body>
    @yield('script')
</html>
