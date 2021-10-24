{{-- Extent to the layout  --}}
@extends('client.views.layouts.base')
@section('template_content')
   <div class="w-full bg-cover bg-center bg-no repeat h-96" style="background-image:url('{{ asset('public/media/client/earth.jpg')}}')"></div>



   {{-- Site informatin --}}
   <h1 class=" my-8 text-center text-blue-300 font-mono text-3xl uppercase tracking-2xl">welcome to shantrice</h1>


   {{-- Card section --}}

   <div class="container mx-auto my-8 grid grid-cols-1 md:grid-cols-2 gap-2 p-2 shadow  rounded ">
        <div class="p-2">
            <img  src="{{asset('public/media/client/roverHead.jpg')}}" alt="">
        </div> 

        <div class="txt p-2 flex items-center">
            <p class="text-blue-200 font-mono tracking-xl ">
                This is all about a journey.
Time goes and we gather experience. Increase skills and share them for the good of the world. This is a good way indeed. 
            </p>
        </div>
   </div>

   {{-- End card section --}}




   {{-- Card section --}}

   <div class="container mx-auto my-8 grid grid-cols-1 md:grid-cols-2 gap-2 p-2 shadow  rounded ">
    <div class="p-2">
        <img  src="{{asset('public/media/client/satelite.jpg')}}" alt="">
    </div> 

    <div class="txt p-2 flex items-center">
        <p class="text-blue-200 font-mono tracking-xl ">
            If you had a chance to probe earth what would you do then?
Well, that's a big matter. But using information and technology synchronously is a very efficient way of learning and contributing for the future.
<br>
Where people are busy making noises willingly or unconcerned. 
        </p>
    </div>
</div>

{{-- End card section --}}



{{-- Card section --}}

<div class="container mx-auto my-8 grid grid-cols-1 md:grid-cols-2 gap-2 p-2 shadow  rounded ">
    <div class="p-2">
        <img  src="{{asset('public/media/client/earth horizon.jpg')}}" alt="">
    </div> 

    <div class="txt p-2 flex items-center">
        <p class="text-blue-200 font-mono tracking-xl ">
            It all starts from the early morning of your life. As a kid when you wanted to solve a problem that’s the moment it sparked inside. 
        </p>
    </div>
</div>

{{-- End card section --}}




{{-- Card section --}}

<div class="container mx-auto my-8 grid grid-cols-1 md:grid-cols-2 gap-2 p-2 shadow  rounded ">
    <div class="p-2">
        <img  src="{{asset('public/media/client/astronaut.jpg')}}" alt="">
    </div> 

    <div class="txt p-2 flex items-center">
        <p class="text-blue-200 font-mono tracking-xl ">
            Later it grows in with you. By learning a little with time you get the hang of it and everything starts to make sense. This is how the journey begins. A curious mind to what I don’t know yet!
        </p>
    </div>
</div>

{{-- End card section --}}





{{-- Card section --}}

<div class="container mx-auto my-8 grid grid-cols-1 md:grid-cols-2 gap-2 p-2 shadow  rounded ">
    <div class="p-2">
        <img  src="{{asset('public/media/client/shaan.jpg')}}" alt="">
    </div> 

    <div class="txt p-2 flex items-center">
        <p class="text-blue-200 font-mono tracking-xl ">
            Hi, I’m K. M. Shantonu. An undergrad engineer. I’m here to share my independent journey, curiosity, and experiences .
            <br>
            Goal here is to simplify things that bugs consumption. Obviously learning, no offense.
            <br>
            Here’s a little picture of me, so next time you see me, don’t forget to say hello!
        </p>
    </div>
</div>

{{-- End card section --}}
@endsection