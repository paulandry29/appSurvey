<?php

$rand = [
    'value' => 10,
];

$text = "";
echo password_hash($text, PASSWORD_DEFAULT, $rand);