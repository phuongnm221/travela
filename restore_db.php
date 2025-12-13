<?php

$mysqli = new mysqli('localhost', 'root', '', '');
$mysqli->query('DROP DATABASE IF EXISTS travela');
$mysqli->query('CREATE DATABASE travela');
$mysqli->select_db('travela');
$sql = file_get_contents('travela.sql');
$mysqli->multi_query($sql);
while($mysqli->next_result()) {}
echo 'Database restored from travela.sql\n';

// Add role column
$sql = "ALTER TABLE tbl_admin ADD COLUMN role VARCHAR(20) DEFAULT 'admin' AFTER email";
if ($mysqli->query($sql) === TRUE) {
    echo 'Column role added successfully\n';
} else if (strpos($mysqli->error, 'Duplicate column') !== false) {
    echo 'Column role already exists\n';
} else {
    echo 'Error adding role: ' . $mysqli->error . '\n';
}

// Add phoneNumber column
$sql = "ALTER TABLE tbl_admin ADD COLUMN phoneNumber VARCHAR(20) NULL AFTER address";
if ($mysqli->query($sql) === TRUE) {
    echo 'Column phoneNumber added successfully\n';
} else if (strpos($mysqli->error, 'Duplicate column') !== false) {
    echo 'Column phoneNumber already exists\n';
} else {
    echo 'Error adding phoneNumber: ' . $mysqli->error . '\n';
}

$mysqli->close();
