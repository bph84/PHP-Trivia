<?php

// These seem like a good choice. 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

expectObContent(function() {
    echo "testing here";
}, "testing here");

expectObContent(function() {
    print(1 + "1"); //FML moment there;
}, "2");

expectObContent(function() {
    print(1 . "1"); //FML moment there;
}, "11");

expectObContent(function() {
    print($notARealVariable); //FML moment there;
}, "Undefined variable: notARealVariable in");

// Test that deprecated warnings are shown. 
expectObContent(function() {
    $disregard = password_hash("password", PASSWORD_DEFAULT, ['salt' => 'bad salt']);
}, "Use of the 'salt' option to password_hash is deprecated");

function expectObContent($outputtingFunc, $expectedText) { 
    // expected text within the output text since PHP appents formatting stuff <br /> <b> etc. 

    ob_start();
    $outputtingFunc();
    $result = ob_get_contents();
    ob_end_clean();

    assert(strpos($result, $expectedText) !== false);
    if (strpos($result, $expectedText) === false) {
        var_dump($result);
        var_dump($expectedText);
    }
}




