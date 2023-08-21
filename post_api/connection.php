<?php
$conn = new mysqli('localhost', 'root', '', 'db_uas_mobprog');
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
