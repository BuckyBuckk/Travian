<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/connect.php');

class field {
    public $name = "";
    public $id = 1;
    public $level = 1;
    public $upgrading = false;
    public $upgradeTime = 0;

    // Constructor
    public function __consturct(){
        echo 'The class "' . __CLASS__ . '" was created!'; 
    }
    // Destructor 
    public function __destruct(){  
        echo 'The class "' . __CLASS__ . '" was destroyed!'; 
    } 

    public function upgrade(){
        
    }
}


function formatTime($seconds) {
    $t = round($seconds);
    return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
  }

?>
