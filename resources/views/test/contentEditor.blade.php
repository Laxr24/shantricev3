<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Content Editing Document</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-wnea99uKIC3TJF7v4eKk4Y+lMz2Mklv18+r4na2Gn1abDRPPOeef95xTzdwGD9e6zXJBteMIhZ1+68QC5byJZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="bg-gray-100">


  {{-- Main container of content editor --}}
    <div class="container max-w-lg mx-auto p-4 rounded-md shadow-sm bg-gray-200 mt-2">
      <h1 class="text-center ">Add content</h1>

      <label class="text-sm font-mono" for="configName">Select destination file</label>
      <br>
      <select name="configName" id="" class="text-sm bg-white px-2 py-1 rounded-md" >
        <option value="content">Content</option>
        <option value="Configuration">Configuration</option>
        <option value="Post">Post</option>
      </select>
      <br>
      <label class="text-sm font-mono tracking-wide mt-4" for="handlerName">HandlerName</label>
      <br>
      <input class="px-2 py-1 my-2 text-sm rounded-md" type="text" name="handlerName" id="handlerName" placeholder="handlerName">
      <br>
      <p class="text-md text-center font-mono">Select content type</p>
      <div class="container flex items-center justify-center p-2">
        <button class="px-4 py-2 text-center mx-4 bg-purple-700 rounded-md shadow-md text-white">Text</button>
        <button class="px-4 py-2 text-center mx-4 bg-yellow-700 rounded-md shadow-md text-white">JSON Object</button>
      </div>
      {{-- <br>
      <textarea name="content" placeholder="Plain Text data" class="w-full p-2 font-mono rounded-md" id="" rows="10"></textarea> --}}
    </div>
  {{-- End de Main container of content editor --}}
  
</body>
</html>