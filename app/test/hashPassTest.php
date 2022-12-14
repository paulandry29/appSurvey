<?php

$rand = [
    'value' => 10,
];

$text = "kunto";
echo password_hash($text, PASSWORD_DEFAULT, $rand);