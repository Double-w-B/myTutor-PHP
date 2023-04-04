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
        'tutorial' => array(
            'tutorial_desc' => $tutorial['tutorial_desc'],
        ),
        'sections' => $sections
    );

    header('Content-Type: application/json');
    echo json_encode($data);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['sectionId'])) {

        $sectionId = $_POST['sectionId'];
        $tutorialId = explode("=", $_SERVER['REQUEST_URI'])[1];
        $userId = $_SESSION['user']['id'];
        $tutorialSections = $_SESSION['tutorial']['sections'];


        if (in_array($sectionId, $tutorialSections)) {
            $tutorialSectionsUpdate = array_values(array_filter($tutorialSections, fn ($num) => $num !== $sectionId));
            $_SESSION['tutorial']['sections'] = $tutorialSectionsUpdate;

            $sql = "DELETE FROM tutorials_sections_users WHERE section_id = ? AND tutorial_id = ? AND user_id = ?";
            $db->query($sql, [$sectionId, $tutorialId, $userId]);
        } else {
            array_push($_SESSION['tutorial']['sections'], $sectionId);

            $sql = "INSERT INTO tutorials_sections_users (section_id, tutorial_id, user_id) VALUES (?, ?, ?)";
            $db->query($sql, [$sectionId, $tutorialId, $userId]);
        }
    }

    if (isset($_POST['removeTutorialFromDB'])) {

        $tutorialIdKey = array_search($_POST['removeTutorialFromDB'], $_SESSION['user']["tutorials_id"]);
        $userId = $_SESSION['user']['id'];
        $tutorialId = intval($_SESSION['user']["tutorials_id"][$tutorialIdKey]);

        $sql = "DELETE FROM tutorials_users WHERE tutorial_id = ? AND user_id = ?";
        $db->query($sql, [$tutorialId, $userId]);

        $sql = "DELETE FROM tutorials_sections_users WHERE tutorial_id = ? AND user_id = ?";
        $db->query($sql, [$tutorialId, $userId]);

        unset($_SESSION['user']["tutorials_id"][$tutorialIdKey]);
    }
}
