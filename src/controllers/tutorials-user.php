<?php

use Classes\Database;

if (!isset($_SESSION["signInSuccess"])) {
    header("location: /login");
    exit();
}
if ($_SESSION['user']['trialEnd'] && !$_SESSION['user']['subscription_id']) {
    header("location: /subscription");
    exit();
}

$config = require base_path("config/database.php");
$db = new Database($config["database"]);

if (isset($_POST['trial-close-btn'])) {
    unset($_SESSION['trialReminder']);
}

if (isset($_POST['removeTutorialIdFromDB'])) {
    $tutorialIdKey = array_search($_POST['removeTutorialIdFromDB'], $_SESSION['user']["tutorials_id"]);
    $userId = $_SESSION['user']['id'];
    $tutorialId = intval($_SESSION['user']["tutorials_id"][$tutorialIdKey]);

    $sql = "DELETE FROM tutorials_users WHERE tutorial_id = :tutorial_id AND user_id = :user_id";
    $db->query($sql, [":tutorial_id" => $tutorialId, "user_id" => $userId]);

    $sql = "DELETE FROM tutorials_sections_users WHERE tutorial_id = :tutorial_id AND user_id = :user_id";
    $db->query($sql, [":tutorial_id" => $tutorialId, "user_id" => $userId]);

    unset($_SESSION['user']["tutorials_id"][$tutorialIdKey]);
}

$sql = 'SELECT * FROM tutorials';
$tutorials = $db->query($sql)->getAll();

$userTutorials = array_filter($tutorials, fn ($tutorial) => in_array($tutorial['id'], $_SESSION['user']['tutorials_id']));


require view("tutorials-user.view.php");
