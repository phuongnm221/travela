<?php

$mysqli = new mysqli('localhost', 'root', '', 'travela');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

$sql = "ALTER TABLE tbl_admin ADD COLUMN phoneNumber VARCHAR(20) NULL AFTER address";
if ($mysqli->query($sql) === TRUE) {
    echo 'Column phoneNumber added successfully';
} else if (strpos($mysqli->error, 'Duplicate column') !== false) {
    echo 'Column phoneNumber already exists';
} else {
    echo 'Error: ' . $mysqli->error;
}
$mysqli->close();
