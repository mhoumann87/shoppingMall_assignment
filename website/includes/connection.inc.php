<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASS', 'kode1234');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'restapi');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) OR die('Could not connect to the database '. mysqli_connect_error());

mysqli_set_charset($conn, "utf8");
