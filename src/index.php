<?php
require_once 'sqlhandler.php';
require_once 'loaders/templateloader.php';
printTemplate('pre_content', ["siteTitle" => "Main page"]);
?>


<?php
printTemplate('post_content');