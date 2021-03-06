<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test view</title>

    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon">
    
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        html, body{
             scrollbar-3dlight-color: brown; 
        }
    </style>

</head>
<body class="  bg-gray-800 md:px-20 px-3 py-3" >
  <div class="">
    <ul>
        @foreach ($files as $file)
            <li><a class="hover:text-red-400 transition text-white font-mono my-2" href="{{'/file/'.nameResolver($file, true)}}"><span class="text-lg p-2 mr-1">🗂</span>{{ nameResolver($file)}}</a></li>            
        @endforeach
    </ul>
  </div>
</body>
</html>