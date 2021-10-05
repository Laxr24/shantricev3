<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? ''}}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body class="bg-gray-900">

    {{-- Navigation or header content --}}
    {{-- @include('client.views.layouts.sections.header_nav') --}}

    {{-- Main Body content --}}
    @yield('template_content')


    {{-- Include Footer content  --}}
    @include('client.views.layouts.sections.footer')




    <script src="//unpkg.com/alpinejs" ></script>

    <script>
        Alpine.store('showMenu', {
            isShowing: false 
        })
    </script>
</body>
</html>