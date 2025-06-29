<?php
require_once __DIR__ . '/utils.php';
require_once __DIR__ . '/loaders/templateloader.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
printTemplate("pre_content", templateData: ["siteTitle" => "Bestellingen", "lang" => "nl"]);

?>
<main>
    <?php
    
    printTemplate("php%list_all_orders");
    printTemplate("post_content");
    ?>