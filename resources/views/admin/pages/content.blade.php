<div class="bg-gray-700 p-2">
    <h1 class="text-white my-4">Collections</h1>
<?php 
foreach ($data as $key => $value) {
?>

    <ul>
        <li class="my-4"><a class="text-green-200 mr-2 uppercase hover:text-red-400 transition-all " href="#"><?php echo $key ?></a> <span>&copy; </span>
        
        <a href="#" class="px-2 py-1 mr-2 rounded text-white bg-red-500 uppercase font-semibold">delete</a>
        <a href="#" class="px-2 py-1 mr-2 rounded text-white bg-purple-500 uppercase font-semibold">edit</a>
        </li>
    </ul>
    <?php 
} 
?>
</div>