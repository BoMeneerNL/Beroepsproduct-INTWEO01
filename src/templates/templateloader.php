<?php

function getTemplate(string $templateName, array|null $templateData = null)
{
    $files = glob(__DIR__ . "/{$templateName}.html");

    if (empty($files)) {
        throw new Exception("Template '{$templateName}' not found.");
    }
    $file = $files[0];
    $text = fread(fopen($file, 'r'), filesize($file));
    if(isset($templateData)){
        $splittedText = explode(" ", $text);
        foreach($splittedText as $value){
            //@TODO make this better with adding {{ and }} to make use of regex instead of using the space shenanigan
            if(str_starts_with($value,"$")){
                foreach($templateData as $key => $data){
                    if($value == "$$key"){
                        $text = str_replace($value, htmlspecialchars($data), $text);
                    }
                }
            }
        }
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