<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('_layouts/_head')
    <body>
        <main style="padding-left:0; padding-right: 0" role="main" class="container-fluid">
             @include('_layouts/_nav')
                @yield('content')
            @include('_layouts/_footer')
        </main>
    </body>
</html>