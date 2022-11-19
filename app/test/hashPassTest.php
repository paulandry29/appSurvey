<?php

$rand = [
    'value' => 10,
];

$text = "admin";
echo password_hash($text, PASSWORD_DEFAULT, $rand);