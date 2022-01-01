<?php 

use App\MyClass\Content;
use Illuminate\Support\Facades\Route;

Route::get('/add-content', function(){
    $path = base_path()."/resources/config/"; 
    $content = new Content($path, "content"); 
    $files = $content->configFiles($path);
    return view('admin.home')->with(['data'=>$content->get() ?? "", 'files'=>$files, 'models'=>$content->models($path)]); 
}); 



// Test CRUD route 
Route::get('test/', function(){
    $path = base_path()."/resources/config/";  
    $content = new Content(); 
    $files = $content->configFiles($path);
    return view('test.content')->with(['files'=>$files]); 
}); 


// Test Content Editor editorjs 
Route::get("/edit-content", function(){
    return view("test.contentEditor"); 
} ); 

// Test all variables 

Route::get('/models', function(){
    $content = new Content(); 
    $path = base_path()."/resources/config/"; 
    return response()
    ->json(['data'=>$content->models($path)])
    ->header('Access-Control-Allow-Origin', '*'); 
}); 



// Files and folder directory listing
Route::get("/dir", function(){  
   $content = new Content(); 
   $files = $content->scanDir(base_path());  
//    return $files; 
   return view("test.folder")->with("files", $files); 
}); 

// File search from global directory
Route::get('/file/{fileName}', function ($fileName = '' ){
    $content = new Content();  
    $path = base_path()."resources/config/"; 
    return $content->lookFor('webpack.mix.js'); 
});


// Name resolver test
Route::get("/filename", function(){
    $content = new Content();  

    return response()->json([
        "encoded"=>$content->nameResolver("content.json.nestor.living", true), 
        "decoded"=>$content->nameResolver("content.json.nestor.living"),
        "No Dotted File"=>$content->nameResolver("EXAMPLE")
    ]); 
}); 