<?php
error_reporting(-1);
ini_set("display_errors", 1);

include_once 'modules/ModuleManager.php';
?>
<html>
    <head lang="en-US">
        <title>Salem Farm</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets2/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="assets2/css/main.css" rel="stylesheet" media="screen">
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
                elem.src = (document.location.protocol === "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
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
        <script src="assets2/js/bootstrap.min.js"></script>
        <script src="assets2/js/jquery-1.10.2.js"></script>
        <script src="assets2/js/main.js"></script>
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
        <div class="container">
            <div id="wrap" class="col-md-12">
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
            <div id="footer" class="col-md-12">
                <?
                echo ("Current module: " . $module->getName());
                $module->getFooter();
                ?>
                <span class="footnote pull-right">
                    &copy; Salem Farm 2013. Developed by
                    <a href="https://github.com/1Rogue">Spencer Alderman</a>
                </span>
            </div>
        </div>
    </body>
</html>