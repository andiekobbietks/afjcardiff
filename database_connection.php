<?php
// database_connection.php

try {
    $connect = new PDO("mysql:host=localhost;dbname=afjcardiff", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
