  
    <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
        <div class="container  justify-center items-center flex">
            <div>
                <p class=" text-lg text-green-400 font-mono text-center md:text-left">Here are the model files 🏀</p>
            <ul>
                @foreach ($files as $key=>$value)
                    <li class="my-2">
                        <span class="mr-3 text-red-400">{{$key+1}}.</span> 
                        <a class="text-white inline-block ml-4 hover:text-pink-400 transition"  href="#" onclick="fetchFile(this)">{{$value}}</a> 
                        <a href="#" id="{{str_replace('.json', '', $value)}}" onclick="event.preventDefault(); deleteFile(this)" class="text-red-500 transition hover:text-gray-300 uppercase ml-2">delete</a>
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



        function deleteFile( dom){
            console.log(dom)
            axios.post(window.location.origin+'/api/model/delete', {'file': dom.id }).then(res=>{
                alert("File deleted!"); 
                window.location.reload()
            })


        }
        
    </script>
