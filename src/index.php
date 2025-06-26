<?php

session_start();

require_once 'loaders/templateloader.php';
printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
?>


<?php
printTemplate('post_content');