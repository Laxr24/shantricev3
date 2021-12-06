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



</head>
<body class="bg-gray-900 md:px-20 px-3 py-3" >
    
    
    <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
        <div class="container pt-4 ">
            <p class="font-mono uppercase text-pink-300 text-center p-2">Showing content of: <span class="text-green-200" id="showFileName"></span></p>
            <textarea id="fileContent" class="p-2 w-full  font-mono tracking-wider border-none outline-none rounded-md text-white bg-gray-700" rows="20">{{$content}}</textarea>
    
            <button class="rounded-md bg-gradient-to-br from-green-400 to-green-300 px-4 py-2 m-2" onclick="">Update</button>
            <button class="rounded-md bg-gradient-to-br from-yellow-400 to-yellow-300 px-4 py-2 m-2" onclick="">Reset</button>
        </div>
    </div>


</body>
</html>