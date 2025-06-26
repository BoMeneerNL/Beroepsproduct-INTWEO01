<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = urlencode('Wrong Request Method On Request');
    header("Location: /register?error={$error}", true, 307);
    exit;
}
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: /register?error=" . urlencode('Field Validation Failed'), true, 307);
    exit;
}




require_once __DIR__ . '/../sqlhandler.php';

$db = new SQLConnection();

$countForUsername = $db->getWithSql("SELECT COUNT(*) AS count FROM User WHERE username = :username", ['username' => $_POST['username']]);
$usernameExists = $countForUsername[0]['count'] > 0;
if ($usernameExists) {
    header("Location: /register?error=" . urlencode('Username Already Exists'), true, 307);
}
$db->destroy();

