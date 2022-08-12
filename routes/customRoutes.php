<?php 

use App\MyClass\Content;
use Illuminate\Http\Request;
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
    return $content->models($path); 
}); 



// Files and folder directory listing
Route::get("/dir", function(){  
   $content = new Content(); 
   $files = $content->scanDir(base_path());  
//    return $files; 
   return view("test.folder")->with("files", $files); 
}); 

// File search from global directory
Route::get('/file/{fileName}', function ($fileName = null ){
    $content = new Content();  
    $filePath =  $content->lookFor($fileName);
    $files = $content->scanDir($filePath);  

    return view("test.folder")->with("files", $files); 
});


// Name resolver test
Route::get("/filename", function(){
    $content = new Content();  
    return response()->json([
        "encoded"=>$content->nameResolver("content.json.nestor.living", true), 
        "decoded"=>$content->nameResolver("contentZG90jsonZG90nestorZG90living", false),
        "No Dotted File decode"=>$content->nameResolver("dummZG90jd", true), 
        "No dot file straight"=>$content->nameResolver("Name"), 
    ]); 
}); 



// Setting short view routes
$content = new Content();
$content->myRoute("shortroute", "default"); 



// Testing sessions
Route::get('/login', function(){
    return view("test.login"); 
}); 

Route::post("/login", function(Request $request){

    $con = new Content();
    $con->login($request->name, $request->email);
    return redirect("/user"); 
}); 

Route::get("/user", function(){
    $con = new Content();
    return $con->authenticate(1, "laxr", "uits.shaan@gmail.com");
    return view("test.session1"); 
}); 
Route::get("/logout", function(){
    $con = new Content(); 
    $con->logout(); 
    return view("test.session2"); 
}); 


Route::get("test", function(){
    $con = new Content(base_path()."/resources/config/", "content");
    $data = $con->get(); 

    return $con->paginate($data, 5); 
    // return $con->get(); 


}); 

