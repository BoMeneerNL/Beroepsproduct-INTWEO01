<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once 'sqlhandler.php';
require_once 'loaders/templateloader.php';
require_once 'utils.php';


printTemplate('pre_content', ["siteTitle" => "Main page", "lang" => "nl"]);
printTemplate('load_css', ["css_location" => "/styles/menus.css"]);
printTemplate('load_css', ["css_location" => "/styles/global.css"]);
$db = new SQLConnection();
$producten = groupByArrayKey("type_id", $db->getWithSql("select name,price,image_link,type_id from Product"));
?>
<main>
    <?php
    foreach ($producten as $productType => $productItems) {

        $productType = htmlspecialchars($productType);
        echo "<p id=\"{$productType}\"> {$productType}</p>";
        echo "<div class='menu-wrapper'>";
        foreach ($productItems as $productItem) {
            $productName = htmlspecialchars($productItem['name']);
            $productPrice = number_format($productItem['price'], 2);
            $productImageURL = htmlspecialchars($productItem['image_link'] ?? 'https://www.lighting.philips.com.br/content/dam/b2b-philips-lighting/ecat-fallback.png');
            printTemplate('menu_item', [
                'productName' => $productName,
                'productPrice' => $productPrice,
                'productImageURL' => $productImageURL
            ]);
        }
        echo "</div>";
    }
    ?>
    </div>
</main>
<?php

printTemplate('post_content');