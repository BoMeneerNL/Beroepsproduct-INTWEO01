<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = urlencode('Wrong Request Method On Request');
    header("Location: /login?error={$error}", true, 307);
    exit;
}

require_once __DIR__ . '/../utils.php';

if (!mustAllExist($_POST['username'], $_POST['password'])) {

    header("Location: /login?error=" . urlencode('Field Validation Failed'), true, 307);
    exit;

}


require_once __DIR__ . '/../sqlhandler.php';

$db = new SQLConnection();
$countForUsername = $db->getWithSql(
    "SELECT COUNT(*) AS count FROM User WHERE username = :username",
    ['username' => $_POST['username']]
);
$usernameExists = $countForUsername[0]['count'] > 0;
if(!$usernameExists){
    header("Location: /login?error=" . urlencode('Login details not correct'), true, response_code: 307);
    exit;
}
$loginDetails = $db->getWithSql(
    "SELECT * FROM User WHERE username = :username",
    ['username' => $_POST['username']]
);
if(!isset($loginDetails[0]['password'])){
    header("Location: /login?error=" . urlencode('Login details not correct'), true, response_code: 307);
    exit;
}
if(!password_verify($_POST['password'], $loginDetails[0]['password'])){
    header("Location: /login?error=" . urlencode('Login details not correct'), true, response_code: 307);
    exit;
}
