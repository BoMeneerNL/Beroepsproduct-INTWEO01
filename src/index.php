<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'sqlhandler.php';
require_once 'loaders/templateloader.php';
printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
?>


<?php
printTemplate('post_content');