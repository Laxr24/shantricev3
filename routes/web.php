<?php

use App\MyClass\Content;
use Illuminate\Support\Facades\Route;


// Default route 
Route::get('/', function(){
    $path = base_path()."/resources/config"; 
            $content = new Content($path, "content"); 
            return view('client.views.pages.home')->with(['data'=>$content->get()]); 
})->name('home'); 



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

    $scandir = scandir(base_path()) ; 
     
    $files = []; 
        foreach ($scandir as $folder) {
            if(is_dir($folder)){
                $files[] = [
                    "type"=>"folder", 
                    "name"=>str_replace(".", "&dd", $folder), 
                    "extension"=>pathinfo(base_path()."/".$folder,PATHINFO_EXTENSION) 
                ]; 
            }
            elseif(is_file($folder)){ 
                $files[] = [
                    "type"=>"file", 
                    "name"=>str_replace(".", "&dd", $folder), 
                    "extension"=>pathinfo(base_path()."/".$folder,PATHINFO_EXTENSION) 
                ];
            }
        }


    // dd($files); 
    return view("test.folder")->with("files", $files); 
}); 


// Content of file
Route::get("/dir/{name}/{type}", function($name = null, $type=null){

    if($type == "folder"){
        $path = base_path()."/".$name; 
        $scandir = scandir($path) ; 
         
        $files = []; 
        
        foreach($scandir as $item){
           if(is_dir(base_path()."/".$name."/".$item)){
            $files[] = [
                "name"=>$item, 
                "type"=>"folder", 
                "extension"=>pathinfo(base_path()."/".$name."/".$item,PATHINFO_EXTENSION) 
            ]; 
           } 
           if(is_file(base_path()."/".$name."/".$item)){
            $files[] = [
                "name"=>$item, 
                "type"=>"file", 
                "extension"=>pathinfo(base_path()."/".$name."/".$item,PATHINFO_EXTENSION)
            ]; 
           } 
        }  
        
         return view("test.folder")->with("files", $files);
    } 

    else{
        $content = new Content(); 
        $path = base_path()."/".str_replace("&dd", ".", $name); 
        return view("test.fileEdit")->with(['content'=>$content->FileRead($path)]); 
    }
})->name("content.view"); 

// Fallback Route 
Route::fallback(function () {
    return view('client.error.404') ; 
}); 
