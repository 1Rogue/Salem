<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Colors
 *
 * @author 1Rogue
 */
final class Colors {
    
    const Bay = 0;
    const Chestnut = 1;
    const Gray = 2;
    const Black = 3;
    const Brindle = 4;
    const Cream = 5;
    const Pinto = 6;
    private $arr = array("Bay","Chestnut","Gray","Black","Brindle","Cream","Pinto");
    
    public function getSize() {
        return 7;
    }
    
    public function get($index) {
        if ($index < 0 || $index > $this->getSize() - 1) {
            return null;
        }
        
        return $this->arr[$index];
    }
    
    public function getAll() {
        return $this->arr;
    }
}

?>
