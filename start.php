<?php

// These seem like a good choice. 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


expectObContentAssertions();
nestedFunctions();



// Function definitions only below here. 

function expectObContentAssertions() {
    expectObContent(function() {
        echo "testing here";
    }, "testing here");
    
    expectObContent(function() {
        print(1 + "1"); //PHP forces strings into ints
    }, "2");
    
    expectObContent(function() {
        print(1 . "1"); //PHP concatination
    }, "11");
    
    expectObContent(function() {
        print($notARealVariable); //FML moment there;
    }, "Undefined variable: notARealVariable in");
    
    // Test that deprecated warnings are shown. 
    expectObContent(function() {
        $disregard = password_hash("password", PASSWORD_DEFAULT, ['salt' => 'bad salt']);
    }, "Use of the 'salt' option to password_hash is deprecated");
}

function nestedFunctions() {

    //Nested function do not have access to function variables! 
    $executionCount = 999;

    function go($executionCount) {

        if ($executionCount == 0) {
            assert(! function_exists("testFunc"));
            
            function testFunc() {
                // do nothing;
            }

        } else {
            assert(function_exists("testFunc"));
        }


        $executionCount++;


        return $executionCount;
    }


    assert(go(0) == 1);
    assert(go(1) == 2); //N.B. testFunc has now been defined!
    assert(go(1) == 2); //Execution count is still 2, the outer value is ignored. 

    assert($executionCount == 999); //Value unchanged!
}



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




