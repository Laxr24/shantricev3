<?php

use App\MyClass\Content;
use Illuminate\Support\Facades\Route;


// Default route 
Route::get('/', function(){
    $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 
            return view('client.views.pages.home')->with(['data'=>$content->get()]); 
})->name('home'); 





// Test CRUD route 
Route::get('test/', function(){

    $path = base_path()."/resources/config/";  

    $content = new Content(); 
    $files = $content->data($path);

    $data = $content->FileRead(base_path()."/resources/config/content.json"); 

     return view('test.index')->with(['files'=>$files, 'data'=>$data]); 
}); 





// Fallback Route 
Route::fallback(function () {
    return view('client.error.404') ; 
}); 
