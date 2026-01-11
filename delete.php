<?php
require_once 'classes/StudentManager.php';

$manager = new StudentManager();

$id = $_GET['id'] ?? null;

if (!empty($id)) {
    $manager->delete($id);
}

header('Location: index.php');
exit;
