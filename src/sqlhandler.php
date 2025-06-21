<?php

require_once 'utils.php';
require_once 'env.php';

disallowDirectAccess(__FILE__);

/**
 * Executes a SQL query and returns the result as an array.
 *
 * @param string $query The SQL query to execute.
 * @param array $params The parameters to bind to the query.
 * @return array The result set as an associative array.
 */
function getWithSql(string $query = "", array|null $params = null): array
{
    $pointer = execute($query, $params);
    if ($pointer === false) {
        return [];
    }
    return $pointer->fetchAll();
}

/**
 * Executes a SQL query without returning any result.
 *
 * @param string $query The SQL query to execute.
 * @param array $params The parameters to bind to the query.
 * @return void
 */
function executeWithSql(string $query = "", array|null $params = null): void
{
    execute($query, $params);
}

/**
 * !USE ONE OF THE HELPER FUNCTIONS (executeWithSql() or getWithSql()), NOT THIS FUNCTION DIRECTLY!
 * 
 * Executes a SQL query and returns the PDOStatement object. 
 *
 * @param string $query The SQL query to execute.
 * @param array $params The parameters to bind to the query.
 * @return bool|PDOStatement Returns false on failure, or the PDOStatement object on success.
 */

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