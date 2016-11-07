<?php
require_once(__DIR__.'/../src/functions.php');


$callable = new class($range) {
    public function getCharacter() {
        $range = range('A', 'Z');

        return $range[array_rand($range)];
    }
};

echo json_encode([
    once([$callable, 'getCharacter']),
    once([$callable, 'getCharacter']),
    once([$callable, 'getCharacter']),
]);
