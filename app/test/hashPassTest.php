<?php

$rand = [
    'value' => 10,
];

$text = "Karlos Saha";
echo password_hash($text, PASSWORD_DEFAULT, $rand);