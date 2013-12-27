<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author 1Rogue
 */
class View implements Module {
    
    function getName() {
        return "insert";
    }

    public function getContent() {

    }

    public function getFooter() {
        
    }

    public function getHeader() {
        echo ("<ul class=\"nav nav-pills pull-right title\"><li class=\"active\"><a href=\"#\">Home</a></li>");
        echo ("<li><a href=\"#\">Sample</a></li><li><a href=\"#\">Again!</a></li></ul>");
        echo ("<h1 class=\"title\"><span>Hello, ");
        echo ("--");
        echo ("!</span></h1>");
    }
    
}

?>
