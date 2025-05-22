<?php
// settings.php

// Database connection variables
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'codecrafterscollective';

// Create and return a MySQLi connection
function db_connect() {
    global $db_host, $db_user, $db_pass, $db_name;

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        // Fatal error if we can’t connect
        die('Database connection failed: ' . $conn->connect_error);
    }

    // Ensure UTF-8 encoding
    $conn->set_charset('utf8mb4');

    return $conn;
}
