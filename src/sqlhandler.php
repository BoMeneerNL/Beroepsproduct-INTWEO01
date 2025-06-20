<?php

if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == pathinfo(__FILE__, PATHINFO_FILENAME)) {
    die('Direct access not permitted');
}

require_once 'env.php';

function getSql(string $query = "", array $params = []): array
{
    $pointer = execute($query, $params);
    if ($pointer === false) {
        return [];
    }
    return $pointer->fetchAll();
}

function executeSql(string $query = "", array $params = []): void
{
    execute($query, $params);
}


function execute(string $query = "", array $params = []): bool|PDOStatement
{
    if (empty($query)) {
        return false;
    }

    global $db_host, $db_port, $db_user, $db_pass, $db_database;

    $con = new PDO(
        "mysql:host=$db_host;port=$db_port;dbname=$db_database;charset=utf8",$db_user,$db_pass
    );
    $stmt = $con->prepare($query);
    $stmt->execute($params);
    return $stmt;
}