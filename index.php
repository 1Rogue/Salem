<?php
error_reporting(-1);
ini_set("display_errors", 1);

/* function __autoload($class_name) {
  include $class_name . '.php';
  } */

include 'modules/ModuleManager.php';
?>
<html>
    <head lang="en-US">
        <title>Salem Farm</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <!--[if !IE 7]>
            <style type="text/css">
                #wrap {display:table;height:100%}
            </style>
        <!--[endif]-->
        <!-- Quantcast Tag -->
        <script type="text/javascript">
            var _qevents = _qevents || [];

            (function() {
                var elem = document.createElement('script');
                elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
                elem.async = true;
                elem.type = "text/javascript";
                var scpt = document.getElementsByTagName('script')[0];
                scpt.parentNode.insertBefore(elem, scpt);
            })();

            _qevents.push({
                qacct: "p-DhRAEpwtU4HjW"
            });
        </script>


        <!-- End Quantcast tag -->
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="assets/js/jquery-1.10.2.js"></script>
        <script src="assets/js/main.js"></script>
    </head>
    <?
    $modules = new ModuleManager();
    $module = null;
    if (isset($_GET['module'])) {
        $module = $modules->getModule($_GET['module']);
    } else {
        $module = $modules->getModule('global');
    }
    ?>
    <body>
        <noscript>
        <div style="display:none;">
            <img src="//pixel.quantserve.com/pixel/p-DhRAEpwtU4HjW.gif" border="0" height="1" width="1" alt="Quantcast"></img>
        </div>
        </noscript>
        <div id="wrap" class="container span12">
            <div id="header">
                <?
                $module->getHeader();
                ?>
            </div>
            <div id="content">
                <?
                $module->getContent();
                ?>
            </div>
        </div>
        <div id="footer" class="span12">
            <?
            echo ("Current module: " . $module->getName());
            $module->getFooter();
            ?>
            <span class="footnote pull-right">
                &copy; Salem Farm 2013. Developed by
                <a href="https://github.com/1Rogue">Spencer Alderman</a>
            </span>
        </div>
    </body>
</html>