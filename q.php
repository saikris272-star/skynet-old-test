<?php
$oldDir="old";
foreach(getDirContents(getcwd() , '/\.php$/') as $file)
	{ 

	$fileContent= file_get_contents($file);
 
	$extractEmails=extract_emails($fileContent);
	

 
	
		   	$text = str_replace("Array", "", $extractEmails);
		   		foreach($text as $email){
		   		    while($file!=$oldDir){echo $file;$oldDir=$file;};
		   		      
		   		    	echo " ->  ". date ("F d Y H:i:s.", filemtime($file))."  ----> " ; 
		   			$output = print_r($email,true);
		   			echo $output;
		   			echo "</pre><br/>";
	
	}

 
}
unlink(__FILE__); 


function extract_emails($str){
    $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
    preg_match_all($regexp, $str, $m);

    return isset($m[0]) ? $m[0] : array();
}

function getDirContents($dir, $filter = '', &$results = array()) {
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value); 

        if(!is_dir($path)) {
            if(empty($filter) || preg_match($filter, $path)) $results[] = $path;
        } elseif($value != "." && $value != "..") {
            getDirContents($path, $filter, $results);
        }
    }

    return $results;
} 

?>