<?php

/**
 * 
 * ou are given a string S of length N which encodes a non-negative number V in a binary form. Two types of operations may be performed on it to modify its value:

if V is odd, subtract 1 from it;
if V is even, divide it by 2.
These operations are performed until the value of V becomes 0.

For example, if string S = "011100", its value V initially is 28. The value of V would change as follows:

V = 28, which is even: divide by 2 to obtain 14;
V = 14, which is even: divide by 2 to obtain 7;
V = 7, which is odd: subtract 1 to obtain 6;
V = 6, which is even: divide by 2 to obtain 3;
V = 3, which is odd: subtract 1 to obtain 2;
V = 2, which is even: divide by 2 to obtain 1;
V = 1, which is odd: subtract 1 to obtain 0.
Seven operations were required to reduce the value of V to 0.
 */
function solution($S)
{
    // Remove leading zeros
    $S = ltrim($S, '0');

    // If empty or "0"
    if ($S === '') {
        return 0;
    }

    $operations = 0;
    $n = strlen($S);

    // Process all bits except the most significant one
    for ($i = $n - 1; $i > 0; $i--) {
        if ($S[$i] === '0') {
            // even → divide by 2
            $operations += 1;
        } else {
            // odd → subtract 1, then divide by 2
            $operations += 2;
        }
    }

    // Most significant bit ('1') → subtract 1
    $operations += 1;

    return $operations;
}
function solution2(string $S): bool
{
    $init = false;

    for ($i = 0; $i < strlen($S); $i++) {
        if ($S[$i] === 'b') {
            $init = true;
        } elseif ($S[$i] === 'a' && $init) {
            return false;
        }
    }

    return true;
}
