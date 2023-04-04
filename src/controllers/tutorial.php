<?php

use Classes\Database;

$id = $_GET["id"];
$userId = $_SESSION['user']['id'];

if (in_array($id, $_SESSION['user']['tutorials_id'])) {
    header("location: /");
    exit();
}

$config = require base_path("config/database.php");
$db = new Database($config["database"]);

$sql = "SELECT * FROM tutorials_sections WHERE tutorial_id = ? ORDER BY position";
$sections = $db->query($sql, [$id])->getAll();

$sql = "SELECT id, title, tutorial_desc, poster, created_by FROM tutorials WHERE id = ?";
$tutorial = $db->query($sql, [$id])->findOne();

$maxChars = 250;

require view("tutorial.view.php");
