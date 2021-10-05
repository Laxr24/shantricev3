<script>
    function newField(container, type,name,  css){
  if(type=="text"){
    let element = document.createElement("input")
    element.type = "text"
    element.name = name
    element.className = `${css}`
    container.appendChild(element)
  }
  else if(type == "textarea"){
    let element = document.createElement("textarea")
    element.name = name
    element.className = `${css}`
    container.appendChild(element)
  }

  
  
}
</script>

<div class="bg-gray-700 p-6"  x-data="{ content: false, blog: false, addFieldType: '', fieldName: ''}">

{{--  Content creation mode selector  --}}
<button class="px-3 py-1 m-2 rounded bg-purple-700 text-white font-bold uppercase " @click="content= !content; blog = false">Content</button>
<button class="px-3 py-1 m-2 rounded bg-pink-800 text-white font-bold uppercase" @click="blog= !blog; content= false ">Blog</button>


{{-- Content Form Group --}}
<div class="mx-auto   p-3" x-show="content" >
    <form action="{{ route("api.content")}}" method="post" x-ref="contentContainer" >
        @csrf
        <input  class=" md:w-6/12 w-full my-2 px-2 py-1 font-mono rounded outline-none border-none"type="text" name="name" id="" placeholder="Name">
        <br>
        <input class="my-2 md:w-6/12  w-full px-2 py-1 font-mono rounded outline-none border-none" type="text" name="handler" id="" placeholder="Handler">
        <br>
        <input class="my-2 md:w-6/12  w-full px-2 py-1 font-mono rounded outline-none border-none" type="text" name="thumb" id="" placeholder="Thumbnail URI">
        <br>
        <textarea class="my-2 md:w-6/12 w-full px-2 py-1 font-monorounded outline-none border-none" name="content" id=""  rows="10" placeholder="Content"></textarea>
        

   

    <br>
        <button class="py-2 my-2 text-center uppercase text-white font-bold px-4 rounded bg-blue-600" @click.prevent="newField($refs.contentContainer,addFieldType,fieldName, 'md:w-6/12 w-full my-2 px-2 py-1 font-mono rounded outline-none block border-none')">add field</button>

        <select name="type" id="" x-model="addFieldType">
            <option value="" selected>None</option>
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
        </select>

        <input type="text" id="" x-model="fieldName" placeholder="Field Name" class="my-2  px-2 py-1 font-mono rounded outline-none border-none">

        <br>
        <button class="py-2 text-center uppercase text-white font-bold px-4 rounded bg-green-600" >save blog</button>

    </form>
</div>

{{-- Blog Form Group --}}
<div class="mx-auto   p-3" x-show="blog" >
    <form action="{{ route("api.blog")}}" method="post" x-ref="blogContainer" >
        @csrf
        <input  class=" md:w-6/12 w-full my-2 px-2 py-1 font-mono rounded outline-none border-none"type="text" name="name" id="" placeholder="Name">
        <br>
        <input class="my-2 md:w-6/12  w-full px-2 py-1 font-mono rounded outline-none border-none" type="text" name="handler" id="" placeholder="Handler">
        <br>
        <input class="my-2 md:w-6/12  w-full px-2 py-1 font-mono rounded outline-none border-none" type="text" name="thumb" id="" placeholder="Thumbnail URI">
        <br>
        <textarea class="my-2 md:w-6/12 w-full px-2 py-1 font-monorounded outline-none border-none" name="content" id=""  rows="10" placeholder="Content"></textarea>
        

   

    <br>
        <button class="py-2 my-2 text-center uppercase text-white font-bold px-4 rounded bg-blue-600" @click.prevent="newField($refs.blogContainer,addFieldType,fieldName, 'md:w-6/12 w-full my-2 px-2 py-1 font-mono rounded outline-none block border-none')">add field</button>

        <select name="type" id="" x-model="addFieldType">
            <option value="" selected>None</option>
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
        </select>

        <input type="text" id="" x-model="fieldName" placeholder="Field Name" class="my-2  px-2 py-1 font-mono rounded outline-none border-none">

        <br>
        <button class="py-2 text-center uppercase text-white font-bold px-4 rounded bg-green-600" >save blog</button>

    </form>
</div>


</div>

