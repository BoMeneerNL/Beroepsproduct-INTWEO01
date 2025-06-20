<?php

if (!defined('ABSPATH')) {
    exit;
}


require_once 'env.php';

function getSql(string $query, array $params): array
{
    $pointer = execute($query, $params);
    if ($pointer === false) {
        return [];
    }
    return $pointer->fetchAll();
}

function executeSql(string $query, array $params): void
{
    execute($query, $params);
}


function execute(string $query, array $params = []): bool|PDOStatement
{
    global $db_host, $db_port, $db_user, $db_pass, $db_database;

    $con = new PDO(
        "mysql:host=$db_host;port=$db_port;dbname=$db_database;charset=utf8",$db_user,$db_pass
    );
    $stmt = $con->prepare($query);
    $stmt->execute($params);
    return $stmt;
}