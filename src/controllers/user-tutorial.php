<?php

use Classes\Database;

$config = require base_path("config/database.php");
$db = new Database($config["database"]);


$id = $_GET["id"];
$userId = $_SESSION['user']['id'];

$sql = "SELECT * FROM tutorials_sections WHERE tutorial_id = ? ORDER BY position";
$sections = $db->query($sql, [$id])->getAll();

$sql = "SELECT section_id FROM tutorials_sections_users WHERE user_id = ?  AND tutorial_id = ?";
$completedSectionsResult = $db->query($sql, [$userId, $id])->getAll();
$completedSections = array_map(fn ($section) => $section["section_id"], $completedSectionsResult);

$_SESSION['tutorial']['sections'] = $completedSections;

$sql = "SELECT id, title, tutorial_desc, poster FROM tutorials WHERE id = ?";
$tutorial = $db->query($sql, [$id])->findOne();

$maxChars = 250;


require view("user-tutorial.view.php");
