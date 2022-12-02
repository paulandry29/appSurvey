<?php

$rand = [
    'value' => 10,
];

$text = "fti";
echo password_hash($text, PASSWORD_DEFAULT, $rand);