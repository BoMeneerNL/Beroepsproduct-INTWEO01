<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = urlencode('Wrong Request Method On Request');
    header("Location: /register?error={$error}", true, 307);
    exit;
}

require_once __DIR__ . '/../utils.php';

if (!mustAllExist($_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name'])) {

    header("Location: /register?error=" . urlencode('Field Validation Failed'), true, 307);
    exit;

}


require_once __DIR__ . '/../sqlhandler.php';

$db = new SQLConnection();

$countForUsername = $db->getWithSql(
    "SELECT COUNT(*) AS count FROM User WHERE username = :username",
    ['username' => $_POST['username']]
);

$usernameExists = $countForUsername[0]['count'] > 0;
if ($usernameExists) {
    header("Location: /register?error=" . urlencode('Username Already Exists'), true, response_code: 307);
    exit;
}
$creationParams = [
    'username' => $_POST['username'],
    'password' => password_hash($_POST['password'], PASSWORD_ARGON2ID),
    'first_name' => $_POST['first_name'] ?? '',
    'last_name' => $_POST['last_name'] ?? ''
];
$db->executeWithSql(
    "INSERT INTO User (username, password,first_name,last_name, role) VALUES (:username, :password,:first_name,:last_name,'Client')",
    $creationParams
);

$db->destroy();
header("Location: /login?success=" . urlencode('Account Created Successfully, you can now login here'), true, response_code: 307);

