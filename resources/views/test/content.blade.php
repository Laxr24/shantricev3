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
        <div class="container  justify-center items-center flex">
            <div>
                <p class=" text-lg text-green-400 font-mono text-center md:text-left">Here are the model files 🏀</p>
            <ul>
                @foreach ($files as $key=>$value)
                    <li class="my-2">
                        <span class="mr-3 text-red-400">{{$key+1}}.</span> 
                        <a class="text-white inline-block ml-4 hover:text-pink-400 transition"  href="#" onclick="fetchFile(this)">{{$value}}</a> 
                        <a href="#" class="text-red-500 transition hover:text-gray-300 uppercase ml-2">delete</a>
                    </li>    
                @endforeach
            </ul>
            </div>
        </div>
    
        <div class="container pt-4 ">
            <p class="font-mono uppercase text-pink-300 text-center p-2">Showing content of: <span class="text-green-200" id="showFileName"></span></p>
            <textarea id="fileContent" class="p-2 w-full  font-mono tracking-wider border-none outline-none rounded-md text-white bg-gray-700" rows="20"></textarea>
    
            <button class="rounded-md bg-gradient-to-br from-green-400 to-green-300 px-4 py-2 m-2" onclick="updateContent()">Update</button>
            <button class="rounded-md bg-gradient-to-br from-yellow-400 to-yellow-300 px-4 py-2 m-2" onclick="resetFile()">Reset</button>
        </div>
    </div>



    <script>

       var content = document.getElementById("fileContent")
       content.value = ""
       var showFileName = document.getElementById("showFileName")
       var filename = ""
     
        
    
        function fetchFile(e){
            content.value = ""
            filename = e.innerHTML.replace('.json', ''); 
            axios.get(window.location.origin+'/api/content/'+filename).then(res=>{
            content.value = res.data.data
            showFileName.innerText = filename
            })

        }

         function updateContent(){
            var updatedData = content.value 
            axios.post(window.location.origin+'/api/content/'+filename, {data: updatedData}).then(res=>{
                if(res.data.status == 200){
                    content.value = res.data.content
                    alert('Content updated successfully! ✅')
                }
                console.log(res.data.content); 
            })
        }


        function resetFile(){
            if(content.value != '' && showFileName != ''){
                var a = confirm('Empty document? 🗑️'); 
                if(a){
                    content.value=''} 
            }
            else{
                alert('No file selected to reset! ⛔ \nSelect a file and try ♻️')
            }
        }
        
    </script>
</body>
</html>