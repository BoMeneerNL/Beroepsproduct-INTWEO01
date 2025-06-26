<?php

session_start();

/**
 * Prevents direct access to the file. if the file is accessed directly, it will run die().
 * @param mixed $file always pass \_\_FILE\_\_ to this function.
 * @return void
 */
function disallowDirectAccess($file): void
{
    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == pathinfo($file, PATHINFO_FILENAME))
        die('Error: NO_DIRECT_ACCESS_ALLOWED');

}


disallowDirectAccess(__FILE__);

function groupByArrayKey(string $arrayKey, array $array): array
{
    $groups = [];
    foreach ($array as $item) {
        if (!isset($item[$arrayKey])) {
            continue;
        }

        $key = $item[$arrayKey];
        $groups[$key][] = $item;
    }

    return $groups;
}

function mustAllExist(...$args): bool {
    foreach ($args as $arg) {
        if (!isset($arg)) {
            return false;
        }
    }
    return true;
}