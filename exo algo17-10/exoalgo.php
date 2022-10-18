<?php

$a = 3;
$b = 5;
$c = 7;

$tmp = $a;
$a = $b;
$b=$c;
$c = $tmp;

echo $a;
echo $b;
echo $c;