<?php

// TESTS PASS WHEN NO RESULT IS SHOWN. 

$test1 = "
This gets discarded

---- This is first
This is the content of the first
---- Second

The second's
content. 

---- Unspecified Behaviour.
---- The last. 
up to the EOF";

define("EOL", "
"); // On Windows, obviously /r/n, Unix simply /n. But this file may not have been converted. 

$result = splitDashedString($test1);

assert($result['This is first'] == 'This is the content of the first');
assert($result['Second'] == sprintf("The second's%scontent.", EOL));
assert($result['The last.'] == 'up to the EOF');

function splitDashedString($input) {
    $exploded = explode(EOL . '----', $input);
    $result = [];

    foreach ($exploded as $piece) {
        $eolPos = strpos($piece, EOL);
        $k = trim(substr($piece, 0, $eolPos));
        $result[$k] = trim(substr($piece, $eolPos));
    }

    return $result;
}