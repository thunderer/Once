<?php
require_once(__DIR__.'/../src/functions.php');

$range = range('A', 'Z');
$callable = function() use($range) {
    return $range[array_rand($range)];
};
$result = once($callable);

echo json_encode([
    once($callable),
    once($callable),
    once($callable),
]);
