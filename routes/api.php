<?php

use App\MyClass\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/content', function(Request $request){

    $path = base_path()."/resources/config"; 
    $data =[];  
    $content = new Content($path, "content"); 

    foreach($request->request as $key=>$value){
        if($key !="_token"){
            $data[$key]=$value; 
        }
    }
    $content->update($data["handler"], $data); 
    return response()->json(['status'=>200]); 

})->name("api.content"); 


// To manage Blogs
Route::post('/blog', function(Request $request){

    $path = base_path()."/resources/config"; 
    $data =[];  
    $content = new Content($path, "blog"); 

    foreach($request->request as $key=>$value){
        if($key !="_token"){
            $data[$key]=$value; 
        }
    }
    $content->update($data["handler"], $data); 
    return response()->json(['status'=>200]); 

})->name("api.blog"); 






//  To create model files with or without content
Route::post('/model', function(Request $request){

    if($request->modelName != null){
        $path = base_path()."/resources/config/";
        $data = $request->modelContent;  
        $content = new Content();
        if($request->modelName != null ){
            $content->makeModel($path, $request->modelName, $data); 
        }
        return redirect()->back();
    }
    else{
        return redirect()->back(); 
    }
    
})->name("api.add.model"); 


Route::post('/model/delete/', function(Request $request){
 
    $path = base_path()."/resources/config/";
    unlink($path.'/'.$request->file.'.json'); 
    return response()->json(['status'=>200, 'message'=>"successfully deleted"]);

}); 




// To fetch the .json file contents
Route::get('/content/{fileName}', function($fileName){
    $content = new Content(); 
    $data = $content->FileRead(base_path()."/resources/config/".$fileName.".json"); 
    return response()->json(['status'=>200, 'data'=>$data]);
}); 







// To update the .json file contents
Route::post('/content/{fileName}', function(Request $request, $fileName){
    
    // return response()->json(['status'=>200, 'data'=>$request]);
    $content = new Content(); 
    $data = $content->rewrite(base_path()."/resources/config/".$fileName.".json", $request->data); 
    return response()->json(['status'=>200, 'content'=>$request->data]);
}); 
