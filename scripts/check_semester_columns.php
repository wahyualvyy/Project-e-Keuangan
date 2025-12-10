<?php
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap CodeIgniter environment
// Load Config Database
use Config\Database;

$config = new Database();
$db = \Config\Database::connect();
$results = $db->query("SHOW COLUMNS FROM semester")->getResultArray();
foreach ($results as $row) {
    echo $row['Field'] . "\t" . $row['Type'] . "\n";
}
