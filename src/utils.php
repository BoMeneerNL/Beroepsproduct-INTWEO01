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


/**
 * Groups an array by a specific key.
 * This function takes an array and groups its elements by the value of a specified key.
 * !Note: only the first level of the array is considered for grouping.
 *
 * @param string $arrayKey The key to group by.
 * @param array $array The array to group.
 * @return array An associative array where the keys are the values of the specified key in the original array.
 */
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
