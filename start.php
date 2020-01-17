<?php

// These seem like a good choice. 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

expectObContent(function() {
    echo "testing here";
}, "testing here");


function expectObContent($outputtingFunc, $expectedText) {
    ob_start();
    $outputtingFunc();
    $result = ob_get_contents();
    ob_end_clean();

    assert($result == $expectedText);
}



