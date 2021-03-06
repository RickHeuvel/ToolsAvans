<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')

        @yield('title')

        @include('includes.css')
        @yield('css')
    </head>
    <body class="@yield('body-class')">
        <header>
            @include('includes.header')
        </header>

        <main class="pb-5">
            @yield('content')
        </main>

        <footer class="footer">
            @include('includes.footer')
        </footer>

        @include('includes.js')
        @yield('js')
    </body>
</html>
