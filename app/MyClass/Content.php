<?php

namespace App\MyClass;
use mikehaertl\shellcommand\Command;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\directoryExists;


class Content
{

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




    function __construct(String $filePath = null, String $modelName = null, array  $modelContent = null)
    {

        $this->filePath = $filePath;
        $this->modelName = $modelName;
        $this->modelContent = $modelContent;
        $this->file = $this->filePath . "/" . $this->modelName . ".json";
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
    public function make()
    {
        // if path available
        if (file_exists($this->filePath)) {

            // if file exitsts
            if (file_exists($this->file)) {
                return response()->json(["error" => "Target file already exists. Try updating instead"]);
            }
            $newfile = fopen($this->filePath . "/" . $this->modelName . ".json", "w+");
            fwrite($newfile, json_encode($this->modelContent));
            fclose($newfile);
            // $this->file = $this->filePath."/".$this->modelName.".json";
            return response()->json(["success" => "File created"]);
        }
        mkdir($this->filePath);
        $newfile = fopen($this->filePath . "/" . $this->modelName . ".json", "w+");
        fwrite($newfile, json_encode($this->modelContent));
        fclose($newfile);
        // $this->file = $this->filePath."/".$this->modelName.".json";
        return response()->json(["success" => "File created"]);
    }





    /**
     * Get All Contents by this method.
     * Get all contents back as JSON response
     * '$key' is the handler name of the model file you want to get from the file
     * To fetch all models and data just leave the parameter blank of the method
     */

    public function get(string $key = null)
    {
        // If key is not provided then return all data
        if ($key == null) {
            if (!file_exists($this->file)) {
                return response()->json(["error" => "Target file was not found"]);
            }
            $readFile = file_get_contents($this->file);
            // Decode 
            $de = json_decode($readFile, true);
            return (object)$de;
        }
        // If key is provided return the specific value

        if (!file_exists($this->file)) {
            return response()->json(["error" => "Target file was not found"]);
        }
        $data = file_get_contents($this->file);
        $decodedData = json_decode($data, true);

        $decodedData[$key]["key"] = $key;


        return  response()->json(["status" => 200, "data" => $decodedData[$key]]);
    }


    /**
     * Update the content of the file with new data
     * Updating ONly existing Data
     */
    public function update(string $keyToUpdate, $updatData)
    {
        if (!file_exists($this->file)) {
            return response()->json(["error" => "Target file was not found"]);
        }

        // Read file to update the key

        $data = file_get_contents($this->file);
        $decodedData = json_decode($data, true);
        $decodedData[$keyToUpdate] = $updatData;


        $file = fopen($this->file, "w+");
        fwrite($file, json_encode($decodedData));
        fclose($file);
        return response()->json(["success" => "File updated successfully"]);
    }

    /**
     * '$name' is the handler name
     * '$value' is the model object that you want to store
     * Add Item to the Model
     * Increate the data entity in your model
     * Maybe add some more fields with Key=>value pair PHP array 
     */

    public function add(string $name, array $value = null)
    {
        if (!file_exists($this->file)) {
            return response()->json(["error" => "Target file was not found"]);
        }

        $fileData = $this->get();
        $fileData->$name = $value;
        $updatedFile = json_encode($fileData);

        $file = fopen($this->file, "w+");
        fwrite($file, $updatedFile);
        fclose($file);
        return response()->json(["success" => "Item added successfully"]);
    }

    /**
     * Remove method removes entry of the model 
     * or The data model file itself 
     * '$data' is the name of the handler
     * '$deleteFile' is the boolean value to delete the model file itself
     * '$fileLocation' is the file location to delete
     */

    public function remove(string $data, Bool $deleteFile = false ?? null)
    {

        if ($deleteFile == true) {

            unlink($this->file);
            return response()->json(["success" => "Model file deleted successfully"]);
        }

        if (!file_exists($this->file)) {
            return response()->json(["error" => "Target file was not found"]);
        }

        $fileData = $this->get();
        unset($fileData->$data);
        // $fileData->$name = $value; 
        $updatedFile = json_encode($fileData);

        $file = fopen($this->file, "w+");
        fwrite($file, $updatedFile);
        fclose($file);
        return response()->json(["success" => "Data removed successfully"]);
    }

    /**
     * Read any file format and get it's contents
     * as is in the file.
     * Just pass the file location that you want to read
     */
    public function FileRead(string $path)
    {
        // Locate the file and open for editing with size
        $file = fopen($path, "r");
        $size = filesize($path);
        // And empty array to store each line of file as array 
        $content = [];

        // Continously reading each fiel and putting it into an array 
        for ($i = 1; $i <= $size; $i++) {
            $con = fgetc($file);
            array_push($content, $con);
        }
        fclose($file);

        // Taking all the value from the contest as input and concatinating as a 

        // Sentence in this new string variable called $value 
        $value = "";

        //Putting contents in value as a single string
        foreach ($content as $k => $v) {
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
    public function configFiles($folderLocation = null)
    {
        if (is_dir($folderLocation)) {
            $scanDir = scandir($folderLocation);

            $ls = [];

            foreach ($scanDir as $key => $value) {
                if ($value != "." && $value != "..") {
                    $ls[] = $value;
                }
            }

            return $ls;
        } else {
            return response()->json(['status' => '400', 'error' => 'no available directory']);
        }
    }


    /**
     * 'rewrite()' method will update
     * the whole file with new data 
     * given in the method parameter
     */
    public function rewrite($filePath = null, $data = null)
    {
        if (!file_exists($filePath)) {
            return response()->json(["status" => 400, "error" => "Target file was not found"]);
        }
        $file = fopen($filePath, "w+");
        fwrite($file, $data);
        fclose($file);
        return response()->json(["status" => 200, "success" => "File updated successfully"]);
    }

    /**
     * variables($folderlocation)
     * 'variables' method takes the config. folder
     * location as argument and returns all the contents 
     * of the corresponding files as a PHP object. 
     */
    public function models($configFolder)
    {
        if (is_dir($configFolder)) {
            $scanDir = scandir($configFolder);

            $ls = [];
            $data = [];

            // Listing all the filenames in $ls array
            foreach ($scanDir as $key => $value) {
                if ($value != "." && $value != "..") {
                    $ls[] = $value;
                }
            }

            // pushing all contents of corresponding file to new object
            foreach ($ls as $value) {
                $file = $configFolder . $value;

                // return $file; 
                if (!file_exists($file)) {
                    return response()->json(["error" => "Target file was not found"]);
                }
                $readFile = file_get_contents($file);
                // Decode 
                $de = json_decode($readFile, true);

                // make object 
                $data[] = [
                    'model' => str_replace('.json', '', $value),
                    'data' => (object)$de
                ];
            }

            return $data;
        } else {
            return response()->json(['status' => '400', 'error' => 'The directory is no more available']);
        }
    }


    /**
     * Makes model file with any raw data
     */
    public function makeModel($configFolder = null, $name = null, $rawData = null)
    {

        $filePath = $configFolder . $name . ".json";
        $file = fopen($filePath, "c+");
        fwrite($file, $rawData);
        fclose($file);
        return response()->json(['status' => 200, 'message' => 'Model file was created successfully']);
    }


    /**
     * scanDir($path), $path is the folder path that you want to scan and generate folder tree
     * It'll return a PHP object with folder, subfolders and files with their path and extensions
     */
    public function scanDir($path)
    {
        $fileAndFolder = [];

        if (is_dir($path)) {
            $items = array_diff(scandir($path), ['.', '..']);
            foreach ($items as $i) {
                $fileAndFolder[] = $i;
            }

            return $fileAndFolder;
        } else {
            return "Not a dirrectory";
        }
    }


    /**
     * lookFor($path) , $path is the location  where the method will look for the
     * containing folder or file and return userful object
     */
    public function lookFor($name)
    {

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
        $outputLinuxPath =  exec("find . -name " . $name);

        // return "<pre>".$this->FileRead($outputLinuxPath)."</pre>"; 
        return $outputLinuxPath;
    }

    /**
     * nameResolver($fileName, true or false )
     * Default method will take a input string and return the 
     * real filename without the encoded part which is used to 
     * replace the dot extensions. 
     * 
     */

    public function nameResolver(string $fileName = null, $encoding = null)
    {

        $encodedStringSecret = "ZG90";

        // If the filename was given or not. returns if not. 
        if ($fileName == null) {
            return "file name was empty";
        }


        switch ($encoding) {
            case true:
                $encodedName = str_replace(".", $encodedStringSecret, $fileName);
                return $encodedName;
            case false:
                $decodedString = str_replace($encodedStringSecret, ".", $fileName);
                return $decodedString;
            case null && $fileName != null:
                return $fileName;
        }
    }
    /**
     * This method can create custom routes 
     * Any get is default and CRUD is possible with additional parameters 
     * myRoute($routeName,$viewName,  boolean) true or false for CRUD 
     */

    private $routeName, $viewName, $crud, $routeFunction;
    public function myRoute($routeName, $viewName, $crud = false, $routeFunction = null)
    {
        $this->routeName = $routeName;
        $this->viewName = $viewName;
        $this->crud = $crud;
        $this->routeFunction = $routeFunction;

        if ($this->crud == true && $this->routeFunction != null) {
            Route::get($routeName, $this->routeFunction);
            Route::post($routeName, $this->routeFunction);
        } else {
            Route::get($this->routeName, function () {
                return view($this->viewName);
            });
        }
    }



    /**
     * Start Session data to authenticate
     * Set or retrieve data from the session value and send to server
     * Authenicate user by setting session and updating users.json file
     * 
     */

    /**
     * Login the current user with current session
     */
    public function login($name, $email)
    {
        $id = rand() - time(); 
        session_start();
        // Setting session variables
        $_SESSION['id'] = $id ;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        $user = [
            "id"=> $id, 
            "name"=>$name,
            "email"=>$email 
        ]; 

        $path = base_path()."/resources/config/"; 
        
        $this->makeModel($path,"users", json_encode($user)); 

    }

    /**
     * Authenticate the user with existing credentials in the users.json file
     */
    public function authenticate($uID, $uName, $uEmail)
    {
        session_start();
        if ($_SESSION) {
            if ($_SESSION['name'] == $uName && $_SESSION['email'] == $uEmail) {
                print_r($_SESSION);
                session_regenerate_id();
                print_r(session_id());
            } else {
                print_r("User Not found");
            }
        } else {
            print("Sorry no user found");
        }
    }

    /**
     * To logout the user with the current session
     */
    public function logout()
    {
        session_start();
        session_unset();
        // remove all session variables
        session_destroy();
    }


    /**
     * Pagination Method to paginate over array of data
    */

    public function data_pagination($data, int $start =0, int $range = null){
        $raw = json_decode(json_encode($data), true); 
        $keys = array_keys($raw);
        $paginated = []; 
        
        if($range == null){
            $range = count($raw); 
        }
        elseif($range >= count($raw)){
            $range = count($raw)-1;
        }

        for($start; $start<=$range; $start++){
            $paginated[$keys[$start]] = $raw[$keys[$start]]; 
        }
        return $paginated; 
    }

    private function link(string $className, string $link, string $buttonName){
        return "<li class='".$className."'><a href='".$link."'>". $buttonName."</a></li>"; 
    }







    /**
     * Paginate pages with 
     * pagination links, datasets
     */

    public function paginate_page($data,int $range = 5,int $current_page = 0, int $start = 0){
        $config = []; 
        $rawData = json_decode(json_encode($data), true);
        $total_page = floor(count($rawData)/$range); 

        $data_segments = array_chunk($rawData, $range, true);

        if($current_page == $total_page){
            $data_chunk = $data_segments[$current_page-1]; 
        }
        else{
            $data_chunk = $data_segments[$current_page]; 
        }
        
        // Check if the data is paginatable or not 
        if(!count($rawData)>$range){
            return $data; 
        }

        // Else start to paginate

        // generate links for pages
        $links = []; 
        $config["current_page"]=$current_page;  
        
        for($i = 0; $i<=$total_page; $i++){
            if($i == 0){
                if($i == $current_page){
                    $links[] = $this->link('pagination_btn current_page',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
                else{
                    $links[] = $this->link('pagination_btn',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
            }
            elseif($i == $total_page){
                if($i == $current_page){
                    $links[] = $this->link('pagination_btn current_page',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
                else{
                    $links[] = $this->link('pagination_btn',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
            }
            else{
                if($i == $current_page){
                    $links[] = $this->link('pagination_btn current_page',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
                else{
                    $links[] = $this->link('pagination_btn',$_SERVER["PATH_INFO"]."?page=".$i, $i);
                }
            }
             
        }   

        if($current_page != 0){
            $links["previous_btn"] = $this->link("previous_btn",$_SERVER["PATH_INFO"]."?page=".($current_page-1), "Previous"); 
            $config["previous_page"]=$current_page-1; 
        }
        if($current_page != $total_page){
            $links["next_btn"] = $this->link("next_btn",$_SERVER["PATH_INFO"]."?page=".($current_page+1), "Next"); 
            $config["next_page"]=$current_page+1;
        }

        $config["html_links"] = $links; 
        $config["data"] = $data_chunk; 
        
        return $config;  

    }


    // End of class 
}
