<?php

/**
 * Main module to view
 *
 * @author 1Rogue
 */
class Globals implements Module {

    function getName() {
        return "global";
    }

    public function getContent() {
        // Temporary setting variable
        $_SESSION['userid'] = '1';
        if (isset($_SESSION['userid'])) {
            $uid = $_SESSION['userid'];
            $mysqli = mysqli_connect("localhost", "localdev", "XnWcgBXbWMfc", "salem");

            //  Working SQL queries for writeups
            #SELECT * FROM `writeups` t1 INNER JOIN `users` t2 ON t1.userid = t2.id;
            #SELECT * FROM `writeups` t1, `users` t2 WHERE t2.user = 'Spencer.Alderman' AND t2.id = t1.userid
            #SELECT * FROM `writeups` WHERE `userid`=''
            $result = mysqli_query($mysqli, "SELECT * FROM `writeups` WHERE `userid`='" . $uid . "'");
            
        }
    }

    public function getFooter() {
        echo ("This is global's footer");
    }

    public function getHeader() {
        echo ("<ul class=\"nav nav-pills pull-right title\"><li class=\"active\"><a href=\"#\">Home</a></li>");
        echo ("<li><a href=\"#\">Sample</a></li><li><a href=\"#\">Again!</a></li></ul>");
        echo ("<h1 class=\"title\"><span>Hello, ");
        echo ("Spencer");
        echo ("!</span></h1>");
    }

}

?>
