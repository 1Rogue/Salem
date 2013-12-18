<?php

function __autoload($class_name) {
    include 'mods/' . $class_name . '.php';
}

/**
 * Manages modules in use
 *
 * @author 1Rogue
 */
final class ModuleManager {
    
    protected $arr = array();
    private $mod;
    
    function __construct($name) {
        $this->arr = array(
            "global" => new Globals(),
            "latin" => new Latin(),
            "insert" => new Insert(),
            "view" => new View(),
            "pass" => new Password()
        );
        
        $back = @$this->arr[$name];
        if ($back === null) {
            $this->mod = new Globals();
        } else {
            $this->mod = $back;
        }
        
    }
    
    public function getCurrentModule() {
        return $this->mod;
    }
    
    public function getModules() {
        return $this->arr;
    }
}

?>
