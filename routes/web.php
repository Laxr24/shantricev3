<?php

use Illuminate\Support\Facades\Route;


// Default route 
Route::get('/', function(){
    return view('client.views.pages.home')->with(['title'=>"Shantrice|Expressing own universe"]); 
})->name('home'); 


Route::get('/{page}', function($page){
    switch($page){
        case "home":
            return view('client.views.pages.home')->with(['title'=>"Shantrice|Expressing own universe"]); 

            break; 
        default: 
            return redirect()->route('home'); 
            break; 
    }
}); 




// Fallback Route 
Route::fallback(function () {
    return view('client.error.404') ; 
}); 
