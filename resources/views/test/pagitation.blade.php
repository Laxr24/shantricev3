<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagination</title>

    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon">
    
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        ul{
            list-style: none; 
        }

        a{
            padding: 1.8em 1.3em; 
            display: inline-block; 
           
        }
        li{
            padding: 1.3em .9em; 
            display: inline;
            border-radius: 5px; 
            margin: 2px; 
            background-color: rgb(67, 80, 85); 
            color: white; 
            font-weight: bold; 
        }
        .current_page{
            background-color: rgb(57, 92, 167);
        }
    </style>

</head>
<body class=" md:px-20 px-3 py-3 bg-gray-50" >
  
    <div>
        @foreach ($data['data'] as $item)
            <p>{{ $item['name'] }}</p>
            <script>
                console.log(" {{ $item['name'] }}" )
            </script>
        @endforeach
    </div>
    <br>
    <br>
    <ul>
    @foreach ($data["html_links"] as $link )
        {!! $link !!}
    @endforeach
    </ul>


    
</body>
</html>