<?php

include_once __DIR__ . '/loaders/templateloader.php';
include_once __DIR__ . '/sqlhandler.php';

$db = new SQLConnection();

if (!isset($_GET["bestelling_id"])) {
    printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
    printTemplate('load_css', ["css_location" => "/styles/global.css"]);
    ?>
    <div class="center-content-middle">
        <h1>Bestelling niet gevonden</h1>
        <p>De bestelling die u probeert te bekijken bestaat niet of is verwijderd.</p>
        <a href="/">Terug naar de hoofdpagina</a>
    </div>
    <?php
} else {
    printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
    printTemplate('load_css', ["css_location" => "/styles/tables.css"]);
    printTemplate('load_css', ["css_location" => "/styles/global.css"]);
    $bestelling = $db->getWithSql('SELECT pop.quantity, p.name AS product_name, po.status, po.address, p.price FROM Pizza_Order_Product pop JOIN Pizza_Order po ON pop.order_id = po.order_id JOIN Product p ON pop.product_name = p.name WHERE po.order_id = :order_id', ['order_id' => $_GET["bestelling_id"]]);
    $totalPrice = 0;
    foreach ($bestelling as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }
    if (count($bestelling) > 0) {
        ?>
        <div id="bestellings-summary">
            <h1>Bestelling Details</h1>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($bestelling[0]['status']); ?></p>
            <p><strong>Adres:</strong> <?php echo htmlspecialchars($bestelling[0]['address']); ?></p>
            <p><strong>Totaalprijs:</strong> €<?php echo number_format($totalPrice, 2) ?></p>
        </div>
        <div id="bestelling-container">
            <?php
            foreach ($bestelling as $bestelling_item) {
                ?>
                <div>
                    <p><?php echo htmlspecialchars($bestelling_item['product_name']) ?></p>
                    <p>Prijs: <?php echo number_format($bestelling_item['price'] * $bestelling_item['quantity']) ?></p>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
        ?>
        <div class="center-content-middle">
            <h1>Bestelling niet gevonden</h1>
            <p>De bestelling die u probeert te bekijken bestaat niet of is verwijderd.</p>
            <a href="/">Terug naar de hoofdpagina</a>
        </div>
        <?php
    }
}




printTemplate('post_content');