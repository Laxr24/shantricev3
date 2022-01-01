<?php 

function nameResolver(string $fileName = null , $encoding = null ){

$encodedStringSecret = "ZG90"; 

// If the filename was given or not. returns if not. 
if($fileName == null){
    return "file name was empty"; 
}


switch($encoding){
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