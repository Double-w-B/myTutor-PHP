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

$sql = 'SELECT * FROM tutorials';
$tutorials = $db->query($sql)->getAll();

$userTutorials = array_filter($tutorials, fn ($tutorial) => in_array($tutorial['id'], $_SESSION['user']['tutorials_id']));

if (isset($_POST['removeTutorialIdFromDB'])) {
    $tutorialId = array_search($_POST['removeTutorialIdFromDB'], $_SESSION['user']["tutorials_id"]);
    unset($_SESSION['user']["tutorials_id"][$tutorialId]);
    $savedTutorials = implode(",", $_SESSION['user']['tutorials_id']);

    $sql = "UPDATE users SET tutorials_id = :tutorials_id WHERE id = :id";
    $db->query($sql, ["id" => $_SESSION['user']['id'], "tutorials_id" => $savedTutorials]);
}

require view("my-tutorials.view.php");
