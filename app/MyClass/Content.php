<?php 
namespace App\MyClass;

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
     * 
     * --Author: K.M. Shantonu BSc. EEE, UITS
     */




    function __construct(String $filePath = null, String $modelName = null, array  $modelContent = null){
       
        $this->filePath = $filePath; 
        $this->modelName = $modelName; 
        $this->modelContent = $modelContent; 
        $this->file = $this->filePath."/".$this->modelName.".json"; 


    }





    /**
     * Absolute filePath on server
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
     * Make sure to use nullable property values
     */
    public function make(){
        if(file_exists($this->filePath)){
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
         */
        
        public function get(){
            if(!file_exists($this->file)){
            return response()->json(["error"=>"Target file was not found"]);
        }
        $readFile = file_get_contents($this->file); 
        // Decode 
        $de = json_decode($readFile, true); 
        return (object)$de; 
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
     * Remove class removes entry of the model 
     * or The data model file itself 
     */

     public function remove(string $data, Bool $deleteFile = false ?? null  ){

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
            // Locate the file and open for erading with size
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

    
}