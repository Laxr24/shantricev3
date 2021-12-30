<?php 
namespace App\MyClass;

use function PHPUnit\Framework\directoryExists;
use mikehaertl\shellcommand\Command;

class Content{
    
    /**
     * Make CRUD operations with any existing or non 
     * existing json file to manipulate the config,contents 
     * of the website. 
     * 
     * #Create if there's no file
     * #Get Contents and display data
     * #Update contents on the file 
     * #You can even Delete the config file itself!
     * #2021
     * --Author: K.M. Shantonu BSc. EEE(Ongoing), UITS
     */




    function __construct(String $filePath = null, String $modelName = null, array  $modelContent = null){
       
        $this->filePath = $filePath; 
        $this->modelName = $modelName; 
        $this->modelContent = $modelContent; 
        $this->file = $this->filePath."/".$this->modelName.".json"; 


    }


    /**
     * Model folder location on server
     */
    public $filePath;

    /**
     * File is the actual file locaiton on the server
     */
    public $file; 

    /**
     * The name of the model file
     * Use this model filename to refer to the model data
     * Read, Update , Add or Remove any data from the model file
     */
    public $modelName; 

    /**
     * User defined PHP object to update the model data
     */
    public $modelContent; 


    /**
     * Make A new Model File 
     * Insert Data or Leave blank
     * Make sure to use constructor parameter 
     */
    public function make(){
        // if path available
        if(file_exists($this->filePath)){

            // if file exitsts
            if(file_exists($this->file)){
                return response()->json(["error"=>"Target file already exists. Try updating instead"]);
            }
            $newfile = fopen($this->filePath."/".$this->modelName.".json", "w+"); 
            fwrite($newfile, json_encode($this->modelContent)); 
            fclose($newfile); 
            // $this->file = $this->filePath."/".$this->modelName.".json";
            return response()->json(["success"=>"File created"]);
        }
        mkdir($this->filePath); 
        $newfile = fopen($this->filePath."/".$this->modelName.".json", "w+"); 
            fwrite($newfile, json_encode($this->modelContent)); 
            fclose($newfile); 
            // $this->file = $this->filePath."/".$this->modelName.".json";
            return response()->json(["success"=>"File created"]);
            
            
        }
        
        
        
        
        
        /**
         * Get All Contents by this method.
         * Get all contents back as JSON response
         * '$key' is the handler name of the model file you want to get from the file
         * To fetch all models and data just leave the parameter blank of the method
         */
        
        public function get(string $key = null  ){
            // If key is not provided then return all data
         if($key == null){
            if(!file_exists($this->file)){
                return response()->json(["error"=>"Target file was not found"]);
            }
            $readFile = file_get_contents($this->file); 
            // Decode 
            $de = json_decode($readFile, true); 
            return (object)$de; 
         }
            // If key is provided return the specific value

            if(!file_exists($this->file)){
                return response()->json(["error"=>"Target file was not found"]);
            }
            $data = file_get_contents($this->file); 
            $decodedData = json_decode($data, true); 

            $decodedData[$key]["key"] = $key; 

        
            return  response()->json(["status"=>200, "data"=>$decodedData[$key]]) ; 
           




    }
    
    
    /**
     * Update the content of the file with new data
     * Updating ONly existing Data
     */
    public function update(string $keyToUpdate, $updatData){
        if(!file_exists($this->file)){
            return response()->json(["error"=>"Target file was not found"]);
        }
        
        // Read file to update the key

        $data = file_get_contents($this->file); 
        $decodedData = json_decode($data, true); 
        $decodedData[$keyToUpdate] = $updatData; 


        $file = fopen($this->file, "w+"); 
        fwrite($file, json_encode($decodedData)); 
        fclose($file); 
        return response()->json(["success"=>"File updated successfully"]);
    }

    /**
     * '$name' is the handler name
     * '$value' is the model object that you want to store
     * Add Item to the Model
     * Increate the data entity in your model
     * Maybe add some more fields with Key=>value pair PHP array 
     */

    public function add(string $name, array $value = null ){


        if(!file_exists($this->file)){
            return response()->json(["error"=>"Target file was not found"]);
        }

        $fileData = $this->get(); 
        $fileData->$name = $value; 
        $updatedFile = json_encode($fileData); 

        $file = fopen($this->file, "w+"); 
        fwrite($file, $updatedFile); 
        fclose($file); 
        return response()->json(["success"=>"Item added successfully"]);

    }

    /**
     * Remove method removes entry of the model 
     * or The data model file itself 
     * '$data' is the name of the handler
     * '$deleteFile' is the boolean value to delete the model file itself
     * '$fileLocation' is the file location to delete
     */

    public function remove(string $data, Bool $deleteFile = false ?? null){

        if($deleteFile == true){
            
            unlink($this->file); 
            return response()->json(["success"=>"Model file deleted successfully"]);
        }

        if(!file_exists($this->file)){
            return response()->json(["error"=>"Target file was not found"]);
        }

        $fileData = $this->get(); 
        unset($fileData->$data); 
        // $fileData->$name = $value; 
        $updatedFile = json_encode($fileData); 

        $file = fopen($this->file, "w+"); 
        fwrite($file, $updatedFile); 
        fclose($file); 
        return response()->json(["success"=>"Data removed successfully"]);
     }

     /**
      * Read any file format and get it's contents
      * as is in the file.
      * Just pass the file location that you want to read
      */
    public function FileRead(string $path){   
        // Locate the file and open for editing with size
        $file = fopen($path, "r"); 
        $size = filesize($path);
        // And empty array to store each line of file as array 
        $content =[] ; 

        // Continously reading each fiel and putting it into an array 
        for($i=1; $i <= $size; $i++){
            $con = fgetc($file); 
            array_push($content ,$con); 
        }
        fclose($file); 

        // Taking all the value from the contest as input and concatinating as a 

        // Sentence in this new string variable called $value 
        $value ="";

        //Putting contents in value as a single string
        foreach($content as $k=>$v){
            // echo $v; 
            $value .= $v; 
        }

        return $value; 
    }

    /*
    *Folder location of the configuration and 
    *model files. 
    *It'll spit up all the model name 
    */
    public function configFiles( $folderLocation = null ){
        if(is_dir($folderLocation)){
            $scanDir = scandir($folderLocation); 

            $ls = []; 

            foreach($scanDir as $key=>$value){
                if($value != "." && $value != ".."){
                    $ls[]=$value;  
                }
                
            }

            return $ls;   

            
        } 
        else{
            return response()->json(['status'=>'400','error'=>'no available directory']); 
        }
    }


    /**
     * 'rewrite()' method will update
     * the whole file with new data 
     * given in the method parameter
     */
    public function rewrite($filePath = null , $data = null){
        if(!file_exists($filePath)){
            return response()->json(["status"=>400,"error"=>"Target file was not found"]);
        }
        $file = fopen($filePath, "w+"); 
        fwrite($file, $data); 
        fclose($file); 
        return response()->json(["status"=>200,"success"=>"File updated successfully"]);
    }

    /**
     * variables($folderlocation)
     * 'variables' method takes the config. folder
     * location as argument and returns all the contents 
     * of the corresponding files as a PHP object. 
     */
    public function models($configFolder){
        if(is_dir($configFolder)){
            $scanDir = scandir($configFolder); 

            $ls = []; 
            $data = []; 

            // Listing all the filenames in $ls array
            foreach($scanDir as $key=>$value){
                if($value != "." && $value != ".."){
                    $ls[]=$value;  
                }
                
            }

            // pushing all contents of corresponding file to new object
            foreach($ls as $value){  
                $file = $configFolder.$value;  

                // return $file; 
                if(!file_exists($file)){
                    return response()->json(["error"=>"Target file was not found"]);
                }
                $readFile = file_get_contents($file); 
                // Decode 
                $de = json_decode($readFile, true); 
                 
                // make object 
                $data[] = [
                    'model' => str_replace('.json', '', $value), 
                    'data' =>(object)$de
                ]; 
            }

            return $data;   

            
        } 
        else{
            return response()->json(['status'=>'400','error'=>'The directory is no more available']); 
        }
    }


    /**
     * Makes model file with any raw data
     */
    public function makeModel($configFolder = null ,$name = null , $rawData = null ){

        $filePath = $configFolder.$name.".json"; 
        $file = fopen($filePath, "c+"); 
        fwrite($file, $rawData); 
        fclose($file);
        return response()->json(['status'=>200, 'message'=>'Model file was created successfully']);
 
    }


    /**
     * scanDir($path), $path is the folder path that you want to scan and generate folder tree
     * It'll return a PHP object with folder, subfolders and files with their path and extensions
     */
    public function scanDir($path){
        $fileOrFolder = []; 
        // Scans the base directory and puts all files,folder and subfolders in nested PHP object $fileOrFolder
        foreach(array_diff(scandir($path), ['.', '..']) as $value){
            $fileOrFolderPath = pathinfo($path."/".$value, PATHINFO_DIRNAME);
            $fileOrFolderBaseName = pathinfo($fileOrFolderPath, PATHINFO_BASENAME);

            if(directoryExists($fileOrFolderPath) && is_dir($path."/".$value)){   
                $sub= false; 
                if(count(scandir($path."/".$value))>2){
                    $sub = true ; 
                } 
                $fileOrFolder[]=[
                    "type"=>"folder", 
                    "name"=>$value, 
                    "extension"=>"folder", 
                    "baseName"=> $fileOrFolderBaseName,
                    "subfolder"=>$sub
                ]; 
            }
            elseif(file_exists($fileOrFolderPath."/".$value) || is_file($fileOrFolderPath."/".$value)){
                 
                $fileOrFolder[]=[
                    "type"=>"file", 
                    "name"=>$value, 
                    "extension"=>pathinfo($fileOrFolderPath."/".$value, PATHINFO_EXTENSION)
                ]; 
            } 

        }
        return $fileOrFolder; 
    }


    /**
     * lookFor($path) , $path is the location  where the method will look for the
     * containing folder or file and return userful object
     */
    public function lookFor($name){

        // function scanner($givenPath){
        //     $dir = array_diff(scandir($givenPath), ['.', '..']); 
        //     $files = []; 

        //     $files["location"] =$givenPath; 
        //     foreach($dir as $i){
        //         $files[] = pathinfo($i, PATHINFO_ALL); 
        //     }
        // }
 
       
        // For windows system

        // $output = null ; 
        // exec("dir ".$name." /s /p", $output); 
        // $path =  str_replace('Directory of', '', $output[3])."/".$name; 
        // $realpath = str_replace("\\" , "/", $path); 

        // For linux system
        $outputLinuxPath =  exec("find . -name ". $name); 

        return "<pre>".$this->FileRead($outputLinuxPath)."</pre>"; 
        // return $outputLinuxPath; 
    }

    /**
     * nameResolver($fileName, true or false )
     * Default method will take a input string and return the 
     * real filename without the encoded part which is used to 
     * replace the dot extensions. 
     * 
     */

     public function nameResolver(string $fileName = null , $encoding = null ){


        //Check if encoded is selected or not

        if($fileName != null && $encoding == null ){
            return $fileName; 
        }

        $encodedStringSecret = "ZG90"; 

        // If the filename was given or not. returns if not. 
        if($fileName == null){
            return "file name was empty"; 
        }

        if($encoding){
            $encodedName = str_replace(".", $encodedStringSecret, $fileName); 
            return $encodedName; 
        }

        else if(!$encoding){
            $decodedString = str_replace($encodedStringSecret, ".", $fileName); 
            return $decodedString; 
        }
        

     }

// End of class 
}