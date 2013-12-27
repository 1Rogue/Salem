<?php

include ('enums/Colors.php');

/**
 * Main module to view
 *
 * @author 1Rogue
 */
class Insert implements Module {

    function getName() {
        return "insert";
    }

    public function getContent() {

        date_default_timezone_set('America/New_York');

        if (isset($_POST['submit'])) {
            $arr = $this->verifyPost($_POST);
            $names = $this->moveUploads();
            $this->submitFiles($arr, $names);
        }
        $this->printInsertTable();
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

    /**
     * Prints a table row for the insertion module
     * 
     * @param string $name The table label
     * @param string $html The table html
     */
    private function printTableRow($name, $html) {
        echo("<tr><td class=\"field_name span4\"><strong>$name</strong></td><td class=\"field_option\">$html</td></tr>");
    }

    /**
     * Determines the number of days in a month provided
     * 
     * @param type $month
     * @return type
     */
    private function days_in_month($month) {
        return $month == 2 ? (28) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    /**
     * Generates a new number suffix for files by adding preceeding zeros
     * 
     * @param int $amount The amount of files currently in directory
     * @return string The new numberized suffix for the file name
     */
    private function getNewImageName($amount) {
        $str = $amount + "";
        for ($i = strlen($amount); $i < 5; $i++) {
            $str = "0$str";
        }
        return $str;
    }

    private function verifyPost($post) {
        echo "<pre>";
        $bool = $this->fieldVerif($post['name']) &&
                $this->fieldVerif($post['fname']) &&
                $this->fieldVerif($post['dobYear']) &&
                $this->fieldVerif($post['dobMonth']) &&
                $this->fieldVerif($post['dobDay']) &&
                $this->fieldVerif($post['height']) &&
                $this->fieldVerif($post['branded']) &&
                $this->fieldVerif($post['color']) &&
                $this->fieldVerif($post['mother']) &&
                $this->fieldVerif($post['father']) &&
                $this->fieldVerif($post['description']) &&
                $this->fieldVerif($post['price']);
        if ($bool) {
            return array(
                1 => array("type" => "s", "value" => $post['name']),
                2 => array("type" => "s", "value" => $post['fname']),
                3 => array("type" => "s", "value" => $post['dobYear'] . "-" . $post['dobMonth'] . "-" . $post['dobDay']),
                4 => array("type" => "d", "value" => $post['height']),
                5 => array("type" => "i", "value" => $post['branded']),
                6 => array("type" => "i", "value" => $post['color']),
                7 => array("type" => "s", "value" => $post['mother']),
                8 => array("type" => "s", "value" => $post['father']),
                9 => array("type" => "s", "value" => $post['description']),
                10 => array("type" => "d", "value" => $post['price'])
            );
        } else {
            echo "Error in post values:\n";
            var_dump($_POST);
            var_dump($post);
        }
        echo "</pre>";
    }

    private function fieldVerif($field) {
        if ($field) {
            echo "Field okay\n";
        }
        if ($field !== "") {
            echo "check okay\n";
        }
        echo "field === $field\n";
        return $field === "0" || ($field && $field !== "");
    }

    /**
     * Moves uploaded files to the images directory. Returns an array of new names.
     */
    private function moveUploads() {
        $fi = new FilesystemIterator('images/', FilesystemIterator::SKIP_DOTS);
        $amount = iterator_count($fi);
        $names = array();
        foreach ($_FILES["pictures"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                $name = $_FILES["pictures"]["name"][$key];
                $file = "image-" . $this->getNewImageName($amount) . "." . pathinfo($name, PATHINFO_EXTENSION);
                move_uploaded_file($tmp_name, "images/$file");
                array_push($names, $file);
                $amount++;
            }
        }
    }

    private function submitFiles($arr, $names) {
        $mysqli = new mysqli("localhost", "localdev", "XnWcgBXbWMfc", "salem");
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        }
        $query2 = "INSERT INTO `images` VALUES (";
        //if ($mysqli->query($query)) {
        if (!($stmt = $mysqli->prepare("INSERT INTO `horses` "
                . "(`name`, `propername`, `age`, `height`, `branded`, `color`, `mother`, `father`, `desc`, `price`) "
                . "VALUES ((1), (2), (3), (4), (5), (6), (7), (8), (9), (10));"))) {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
        } else {

            $this->bindparams($stmt, $arr);

            //echo "stmt = " . $stmt->;
        }
        //$id = $mysqli->query("SELECT `id` WHERE `propername`='" . $_POST['fname'] . "'");
        foreach ($names as $file) {
            $query2 = "$query2$file, ";
        }
        $query2 = substr($query2, 0, -2) . ");";

        //$mysqli->query($query2);
        //} else {
        // query failed
        //}
    }

    private function printInsertTable() {
        echo("<form enctype=\"multipart/form-data\" id=\"horseSubmit\" method=\"post\"><table><tbody>");

        // Print table rows
        $this->printTableRow("Horse name", "<input type=\"text\" name=\"name\">");
        $this->printTableRow("Horse formal name", "<input type=\"text\" name=\"fname\">");
        $colors = "";
        $col = new Colors();
        for ($i = 0; $i < $col->getSize(); $i++) {
            $colors = "$colors<option value=\"$i\">" . $col->get($i) . "</option>";
        }
        $this->printTableRow("Horse Color", "<select name=\"color\" class=\"uneditable-input\">$colors</select>");
        $days = "<select name=\"dobDay\" class=\"uneditable-input span1\">";
        $months = "<select name=\"dobMonth\" class=\"uneditable-input span1\">";
        $year = "<select name=\"dobYear\" class=\"uneditable-input span1\">";
        for ($i = 1; $i < 13; $i++) {
            ($i < 10) ? $months = "$months<option value=\"$i\">0$i</option>" : $months = "$months<option value=\"$i\">$i</option>";
        }
        for ($i = 1; $i < 32; $i++) {
            ($i < 10) ? $days = "$days<option value=\"$i\">0$i</option>" : $days = "$days<option value=\"$i\">$i</option>";
        }
        for ($i = 1975; $i <= date('Y'); $i++) {
            $year = "$year<option value=\"$i\">$i</option>";
        }
        $this->printTableRow("Date of Birth (MM-DD-YYYY)", "$months</select>$days</select>$year</select>");
        $this->printTableRow("Height (cm)", "<input type=\"text\" name=\"height\">");
        $this->printTableRow("Branded", "<select name=\"branded\" class=\"uneditable-input\">
                <option value=\"0\">No</option><option value=\"1\">Yes</option></select>");
        $this->printTableRow("Mother (Proper)", "<input type=\"text\" name=\"mother\" id=\"motherForm\">");
        $this->printTableRow("Father (Proper)", "<input type=\"text\" name=\"father\" id=\"fatherForm\">");
        $this->printTableRow("Description", "<textarea name=\"description\" class=\"span6 form\"></textarea>");
        $this->printTableRow("Price ($ USD) (0 for no sale)", "<input type=\"text\" name=\"price\">");
        $this->printTableRow("Pictures", "<input type=\"file\" name=\"pictures[]\" class=\"file0\">");
        echo ("<tr><td class=\"field_name span4\"><strong></strong></td><td class=\"field_option down\">
            <input type=\"submit\" name=\"submit\" class=\"btn btn-primary\"></td></tr>");

        echo("</tbody></table></form>");
    }

    private function bindparams(mysqli_stmt &$stmt, $array) {
        for ($i = 1; $i < 11; $i++) {
            if (!$stmt->bind_param($array[$i]["type"], $array[$i]["value"])) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
        }
    }

}

?>