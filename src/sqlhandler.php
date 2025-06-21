<?php

require_once 'utils.php';
require_once 'env.php';

disallowDirectAccess(__FILE__);
function getWithSql(string $query = "", array|null $params = null): array
{
    $pointer = execute($query, $params);
    if ($pointer === false) {
        return [];
    }
    return $pointer->fetchAll();
}

function executeWithSql(string $query = "", array|null $params = null): void
{
    execute($query, $params);
}

function execute(string $query = "", array|null $params = null): bool|PDOStatement
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