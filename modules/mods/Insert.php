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

        if (isset($_POST['submit'])) {
            $arr = array(
                "name" => $_POST['name'],
                "fname" => $_POST['fname'],
                "DOB" => $_POST['dobMonth'] . "--" . $_POST['dobDay'] . "--" . $_POST['dobYear'],
                "color" => $_POST['color'],
                "height" => $_POST['height'],
                "branded" => $_POST['branded'],
                "mother" => $_POST['mother'],
                "father" => $_POST['father'],
                "description" => $_POST['description'],
                "price" => $_POST['price'],
                "pictures" => $_POST['pictures']
            );

            echo("<pre>POST:");
            var_dump($arr);
            echo("FILES:<br>");
            foreach ($_FILES as $name => $key) {
                echo("Name: $name  Key: $key");
            }
            echo("</pre>");
            //$mysqli = mysqli_connect("localhost", "localdev", "XnWcgBXbWMfc", "salem");
        }
        echo("<form id=\"horseSubmit\" method=\"post\"><table><tbody>");

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
        $this->printTableRow("Price ($ USD) (0 for no sale)", "<input type=\"text\" name\"price\">");
        $this->printTableRow("Pictures", "<input type=\"file\" name=\"pictures\" class=\"file0\">");
        echo ("<tr><td class=\"field_name span4\"><strong></strong></td><td class=\"field_option down\">
            <input type=\"submit\" name=\"submit\" class=\"btn btn-primary\"></td></tr>");

        echo("</tbody></table></form>");
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

    private function printTableRow($name, $html) {
        echo("<tr><td class=\"field_name span4\"><strong>$name</strong></td><td class=\"field_option\">$html</td></tr>");
    }

    private function days_in_month($month) {
        return $month == 2 ? (28) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

}

?>