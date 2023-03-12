<?php

session_start();

if (!isset($_SESSION["signInSuccess"])) {
    header("Location: sign-in.php");
    exit();
}
if ($_SESSION['user_trialEnd'] && !$_SESSION['user_subscription']) {
    header("Location: subscription.php");
    exit();
}

if (isset($_POST['trial-close-btn'])) {
    unset($_SESSION['trialReminder']);
}

require_once "./config/database.php";

$sql = 'SELECT * FROM tutorials';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tutorials = $stmt->fetchAll();

$userTutorials = array_filter($tutorials, fn ($tutorial) => in_array($tutorial->id, $_SESSION['user_tutorials_id']));

if (isset($_POST['removeTutorialIdFromDB'])) {
    $tutorialId = array_search($_POST['removeTutorialIdFromDB'], $_SESSION["user_tutorials_id"]);
    unset($_SESSION["user_tutorials_id"][$tutorialId]);
    $savedTutorials = implode(",", $_SESSION['user_tutorials_id']);


    $sql = "UPDATE users SET tutorials_id = :tutorials_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $_SESSION['user_id'], "tutorials_id" => $savedTutorials]);
}
