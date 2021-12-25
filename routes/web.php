<?php

use App\MyClass\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Default route 
Route::get('/', function(){
    $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 
            return view('client.views.pages.home')->with(['data'=>$content->get()]); 
})->name('home'); 


include "customRoutes.php"; 



// Fallback Route 
Route::fallback(function () {
    return view('client.error.404') ; 
}); 
