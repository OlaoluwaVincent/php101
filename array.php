<?php
$scores = [1, 2, 3];

var_dump($scores);
echo ("<br/>");
echo ("<pre/>");
print_r($scores);
echo ("<pre/>");
// Accessing bt index

$scores[1] = 4;
unset($scores[0]);

echo ("index 2 => " . $scores[2]);
echo ("<br/>");
print_r($scores);
echo ("count =>" . count($scores));
