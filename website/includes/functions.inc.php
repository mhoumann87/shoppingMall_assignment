<?php

//hash password
function hashPassword($password) {
$hashFormat = '$2y$10$';
$saltLength = 22;

$salt = generateSalt($saltLength);
$formatAndSalt = $hashFormat . $salt;
$hash = crypt($password, $formatAndSalt);
return $hash;
}

//generer salt
function generateSalt($length) {
$uniqueRandomString = md5(uniqid(mt_rand(), true));
$base64String = base64_encode($uniqueRandomString);
$modifiedBase64String = str_replace('+', '.', $base64String);
$salt = substr($modifiedBase64String, 0, $length);
return $salt;
}

//check password
function checkPassword($password, $existingHash) {
$hash = crypt($password, $existingHash);
if ($hash === $existingHash) {
return true;
} else {
return false;
}
}