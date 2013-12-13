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
    
    function __construct() {
        $this->arr = array(
            "global" => new Globals(),
            "latin" => new Latin(),
            "insert" => new Insert(),
            "view" => new View(),
            "pass" => new Password()
        );
    }
    
    public function getModule($name) {
        $back = @$this->arr[$name];
        if ($back === null) {
            return new Globals();
        }
        return $back;
    }
}

?>
