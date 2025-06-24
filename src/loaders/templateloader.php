<?php

function getTemplate(string $templateName, array|null $templateData = null)
{
    $files = glob(__DIR__ . "/../templates/{$templateName}.html");

    if (empty($files)) {
        throw new Exception("Template '{$templateName}' not found.");
    }
    $file = $files[0];
    $text = fread(fopen($file, 'r'), filesize($file));
    if (isset($templateData)) {
        $text = preg_replace_callback('/{{\s*(\w+)\s*}}/', function ($matches) use ($templateData) {
            $key = $matches[1];
            return isset($templateData[$key]) ? htmlspecialchars($templateData[$key]) : $matches[0];
        }, $text);
    }
    return $text;

}

function printTemplate(string $templateName, array|null $templateData = null): void
{
    try {
        echo getTemplate($templateName, $templateData);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}