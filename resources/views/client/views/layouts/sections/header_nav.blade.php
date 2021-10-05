{{-- Menu button --}}
<div class=" shadow-md w-10 h-10 flex justify-center items-center fixed md:top-5 cursor-pointer right-10 top-10   md:left-10 bg-purple-800 rounded-full">
   <p class=" text-purple-200 text-center">m</p>
</div>




{{-- menu body --}}

<div x-show="$store.showMenu.isShowing" class="bg-green-200 overflow-hidden opacity-100 p-4 rounded absolute top-20 left-10 z-100 ">

    <div class="">
        <div>
            <p class="text-center text-2xl text-pink-500" >Quick links</p>
            <ul>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Timeline</a></li>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Projects</a></li>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Researchs</a></li>
            </ul>
        </div>
        <div>
            <p class="text-center text-2xl text-pink-500" >Quick links</p>
            <ul>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Timeline</a></li>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Projects</a></li>
                <li class="text-center my-2 "><a class=" transition-all hover:text-purple-600" href="#">Researchs</a></li>
            </ul>
        </div>
        <p class="px-4 py-2 cursor-pointer rounded shadow-md my-4 bg-red-300">close</p>
    </div>


</div>

