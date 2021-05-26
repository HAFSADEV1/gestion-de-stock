<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_NAME', 'stock');
define('DB_PASSWORD', '');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "ERORR!!! Could Not Conect " . $ex->getMessage();
}
