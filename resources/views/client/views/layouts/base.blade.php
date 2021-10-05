<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->config['site_name'] ?? "" }} | {{ $data->config['tag'] }} </title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    {{-- Alpine JS --}}
    <script src="{{ mix('js/app.js')}}" defer></script>

</head>
<body class="bg-gray-900">

    {{-- Navigation or header content --}}
    {{-- @include('client.views.layouts.sections.header_nav') --}}

    {{-- Main Body content --}}
    @yield('template_content')
    {{-- Include Footer content  --}}
    @include('client.views.layouts.sections.footer')



</body>
</html>