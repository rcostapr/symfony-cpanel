<?php


function solution($S)
{

    $val = bindec($S);
    $count = 0;
    while ($val !== 0) {
        $val = getRed($val);
        echo $val . PHP_EOL;
        $count++;
    }
    return $count;
}

function getRed($val)
{
    if ($val % 2 != 0) {
        $new = $val - 1;
    } else {
        $new = $val / 2;
    }
    return $new;
}

echo "Hello - " . solution($argv[1]) . PHP_EOL;
