<?php

use App\MyClass\Content;
use Illuminate\Support\Facades\Route;


// Default route 
Route::get('/', function(){
    $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 
            return view('client.views.pages.home')->with(['data'=>$content->get()]); 
})->name('home'); 


Route::get('/{page}', function($page){
    switch($page){
        case "home":
            $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 
            return view('client.views.pages.home')->with(['data'=>$content->get() ?? ""]); 
            break; 



        case "blog":
            $path = base_path()."/resources/config"; 
            $content = new Content($path, "blog"); 
            return $content->get(); 

            break; 
        // Admin Routes for frontEnd views   
        case "admin-shaan": 
            $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 

            return view('admin.home')->with(['data'=>$content->get() ?? ""]); 






        default: 
            return redirect()->route('home'); 
            break; 
    }
}); 


Route::get('/de', function(){
 return view('default'); 
}); 

// Fallback Route 
Route::fallback(function () {
    return view('client.error.404') ; 
}); 
