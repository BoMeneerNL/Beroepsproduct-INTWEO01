<?php
require_once __DIR__ . '/../utils.php';
disallowDirectAccess(__FILE__);

printTemplate("load_css", ["css_location" => "/styles/menus.css"]);
?>
<nav id="site-nav">
    <ul>
        <?php
        if (isset($templateData['productTypes']) && is_array($templateData['productTypes'])) {
            foreach ($templateData['productTypes'] as $productType) {
                $productType = htmlspecialchars($productType);
                echo "<li><a href=\"/#{$productType}\">{$productType}</a></li>";
            }
        }

        ?>
    </ul>
    <ul>
        <li><a href="/cart">Winkelwagen</a></li>
        <?php 
       if(isLoggedIn()){/* 
            if($_SESSION['user_data']['role'] == "Personnel"){
                ?>
                <li><a href="/bestellingen">Bestellingen</a></li>
                <?php
            }
            else{
                ?>
                <li><a href="/mijn-bestellingen">Mijn bestellingen</a></li>
                <?php
            }*/
        }
            
        else{
            ?>
            <a href="/login">Inloggen</a>
            <a href="/register">Registreren</a>
            <?php
        }
        
        ?>

    </ul>
</nav>