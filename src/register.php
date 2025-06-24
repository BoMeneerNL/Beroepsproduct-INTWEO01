<?php
require_once "loaders/templateloader.php";
printTemplate("pre_content", templateData: ["siteTitle" => "Register"]);
printTemplate("load_css", templateData: ["css_location" => "/styles/forms.css"]);
?>
<form method="post" action="register.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Register">
</form>

<?php
printTemplate("post_content");