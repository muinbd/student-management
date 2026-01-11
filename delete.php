<?php

require_once ('classes/StudentManager.php');

$manager = new StudentManager();

// Get ID from URL
$id = $_GET['id'] ?? null;

if(!$id) {
    die('Invalid Student ID');
}

// Delete the student
$manager->delete($id);

// Redirect back to list
header('Location: index.php');
exit;

