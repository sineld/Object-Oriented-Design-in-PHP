<?php

require '../TablePrinter.php';

function fetchStrategy($type) {
    $strategies = [
        'addition' => function($v1, $v2) {
            return $v1 + $v2;
        },
        'multiplication' => function($v1, $v2) {
            return $v1 * $v2;
        }
    ];

    return $strategies[$type];
}

function solveMath($type, $v1, $v2)
{
    $strategy = fetchStrategy($type);
    return $strategy($v1, $v2);
}

$tp = new TablePrinter(['Type', 'Result']);

$tp->addRow('Addition', solveMath('addition', 5, 5));
$tp->addRow('Multiplication', solveMath('multiplication', 5, 5));

echo $tp->output();
