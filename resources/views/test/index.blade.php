<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test view</title>


    
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</head>
<body class="bg-gray-900 p-3" >
    
    
    <p class="text-white font-mono text-center md:text-left">Here are he file lists:</p>

  
    <ul>
        @foreach ($files as $key=>$value)
            <li>
                <span class="mr-3 text-red-400">{{$key}}.</span> 
                <a class="text-white inline-block ml-4 hover:text-pink-400 transition"  href="#" onclick="update(this)">{{$value}}</a>
            </li>    
        @endforeach
    </ul>

    <div class="container  mx-auto pt-4">
        <p class="font-mono uppercase text-pink-300 text-center p-2">Showing content of: <span class="text-green-200" id="showFileName"></span></p>
        <textarea id="fileContent" class="p-2 w-full font-mono tracking-wider border-none outline-none rounded-md text-white bg-gray-700"  rows="20"></textarea>
    </div>



    <script>

       var content = document.getElementById("fileContent")
       var showFileName = document.getElementById("showFileName")
     
     
        
    
        function update(e){
            var filename = e.innerHTML.replace('.json', ''); 
            
            axios.get(window.location.origin+'/api/content/'+filename).then(res=>{
            content.innerHTML = res.data.data
            showFileName.innerText = filename
            })

        }
        
    </script>
</body>
</html>