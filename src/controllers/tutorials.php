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

if (isset($_POST['addTutorialIdToDB']) && !in_array($_POST['addTutorialIdToDB'], $_SESSION['user']["tutorials_id"])) {
    array_push($_SESSION['user']['tutorials_id'], $_POST['addTutorialIdToDB']);
    $savedTutorials = implode(",", $_SESSION['user']['tutorials_id']);

    $sql = "UPDATE users SET tutorials_id = :tutorials_id WHERE id = :id";
    $db->query($sql, ["id" => $_SESSION['user']['id'], "tutorials_id" => $savedTutorials]);
}

$sql = 'SELECT * FROM tutorials';
$tutorials = $db->query($sql)->getAll();






require view("tutorials.view.php");
