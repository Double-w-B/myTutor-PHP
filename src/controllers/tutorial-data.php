<?php

use Classes\Database;


$config = require base_path("config/database.php");
$db = new Database($config["database"]);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];

    $sql = "SELECT * FROM tutorials_sections WHERE tutorial_id = ? ORDER BY position";
    $sections = $db->query($sql, [$id])->getAll();

    $sql = "SELECT id, title, tutorial_desc, poster FROM tutorials WHERE id = ?";
    $tutorial = $db->query($sql, [$id])->findOne();


    $data = array(
        'tutorial_desc' => $tutorial['tutorial_desc'],
        'sections' => $sections
    );

    header('Content-Type: application/json');
    echo json_encode($data);
}


if (isset($_POST["tutorialId"])) {

    $tutorialId = $_POST["tutorialId"];

    array_push($_SESSION['user']['tutorials_id'], $tutorialId);
    $userId = $_SESSION['user']['id'];

    $sql = "INSERT INTO tutorials_users (tutorial_id, user_id, start_date) VALUES (?, ?, now())";
    $db->query($sql, [$tutorialId, $userId]);
}
