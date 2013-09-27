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
            //$mysqli = mysqli_connect("localhost", "localdev", "XnWcgBXbWMfc", "salem");
        }
        echo("<form id=\"horseSubmit\"><table><tbody>");

        // Print table rows
        /* <form>
          Horse name: <input type="text">
          Horse born on: --todo: calender--
          Height (cm): <input type="text">
          Branded
          </form>
         * 
         */
        $this->printTableRow("Horse name", "<input type=\"text\" name=\"name\">");
        $this->printTableRow("Horse formal name", "<input type=\"text\" name=\"fname\">");
        $dob = "";
        $col = new Colors();
        for ($i = 0; $i < $col->getSize(); $i++) {
            $dob = "$dob<option value=\"$i\">" . $col->get($i) . "</option>";
        }
        $this->printTableRow("Horse Color", "<select name=\"DOB\" class=\"uneditable-input\">$dob</select>");
        $this->printTableRow("Height (cm)", "<input type=\"text\" name=\"height\">");
        $this->printTableRow("Branded", "<select name=\"branded\" class=\"uneditable-input\">
                <option value=\"0\">No</option><option value=\"1\">Yes</option></select>");
        $this->printTableRow("Mother", "<input type=\"text\" name=\"mother\" id=\"motherForm\">");
        $this->printTableRow("Father", "<input type=\"text\" name=\"father\" id=\"fatherForm\">");
        $this->printTableRow("Description", "<textarea name=\"description\" class=\"span6 form\"></textarea>");

        echo("</tbody></table></form>");
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

    private function printTableRow($name, $html) {
        echo("<tr><td class=\"field_name span4\"><strong>$name</strong></td><td class=\"field_option\">$html</td></tr>");
    }

}
?>