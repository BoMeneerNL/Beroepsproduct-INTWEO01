<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = urlencode('Wrong Request Method On Request');
    redirect("/login?error={$error}");
    exit;
}

require_once __DIR__ . '/../utils.php';

if (!mustAllExist($_POST['username'], $_POST['password'])) {
    redirect("/login?error=" . urlencode('Field Validation Failed'));
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
     redirect("/login?error=" . urlencode('Login details not correct'));
    exit;
}
$loginDetails = $db->getWithSql(
    "SELECT * FROM User WHERE username = :username",
    ['username' => strtolower($_POST['username'])]

);
$db->destroy();
if(!isset($loginDetails[0]['password'])){
    redirect("/login?error=" . urlencode('Login details not correct'));
    exit;
}
if(!password_verify($_POST['password'], $loginDetails[0]['password'])){
     redirect("/login?error=" . urlencode('Login details not correct'));
    exit;
}

$_SESSION['user_data'] = [
    'username' => $loginDetails[0]['username'],
    'first_name' => $loginDetails[0]['first_name'],
    'last_name' => $loginDetails[0]['last_name'],
    'role' => $loginDetails[0]['role']
];
redirect("/");