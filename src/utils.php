<?php
/**
 * Prevents direct access to the file. if the file is accessed directly, it will run die().
 * @param mixed $file always pass \_\_FILE\_\_ to this function
 * @return void
 */
function disallowDirectAccess($file): void
{
    if (pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) == pathinfo($file, PATHINFO_FILENAME))
        die('Error: NO_DIRECT_ACCESS_ALLOWED');

}