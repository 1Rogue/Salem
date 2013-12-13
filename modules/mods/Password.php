<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Password
 *
 * @author Spencer
 */
class Password implements Module {

    public function getName() {
        return "password";
    }

    public function getContent() {
        $pass = "rightpassword";
        echo "Testing with: '$pass' <br /><br />";

        $hash1 = password_hash($pass, PASSWORD_DEFAULT);
        $options = array('cost' => 11);
        $hash2 = password_hash($pass, PASSWORD_BCRYPT, $options);

        echo "hash1: '$hash1' <br /><br />";
        echo "hash2: '$hash2' <br /><br />";

        $invalid = "wrongpassword";
        $this->test($pass, $hash1, 1);
        $this->test($pass, $hash2, 2);
        $this->test($invalid, $hash1, 1);
        $this->test($invalid, $hash2, 2);
    }

    private function test($password, $hash, $num) {
        echo "Testing '$password' against hash #$num<br />";
        if (password_verify($password, $hash)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }
        echo "<br /><br />";
    }

    public function getFooter() {
        
    }

    public function getHeader() {
        $echo = "<ul class=\"nav nav-pills pull-right title\">"
                . "<li class=\"active\"><a href=\"#\">Home</a></li>"
                . "<li><a href=\"#\">Sample</a></li>"
                . "<li><a href=\"#\">Again!</a></li></ul>"
                . "<h1 class=\"title\"><span>Hello, "
                . "--"
                . "!</span></h1>";
        echo $echo;
    }

}
