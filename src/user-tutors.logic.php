<?php
require_once "./config/database.php";

session_start();

if (!isset($_SESSION["signInSuccess"])) {
    header("Location: sign-in.php");
    exit();
}

if (isset($_POST['trial-close-btn'])) {
    unset($_SESSION['trialReminder']);
}


if (isset($_POST['removeTutorialIdFromDB'])) {
    $tutorialId = array_search($_POST['removeTutorialIdFromDB'], $_SESSION["user_tutorials_id"]);
    unset($_SESSION["user_tutorials_id"][$tutorialId]);
    $savedTutorials = implode(",", $_SESSION['user_tutorials_id']);


    $sql = "UPDATE users SET tutorials_id = :tutorials_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $_SESSION['user_id'], "tutorials_id" => $savedTutorials]);
}

$dateTime = new DateTime();
$currentDate = $dateTime->format("Y-m-d H:i:s");
$userTrialDate = DateTime::createFromFormat("Y-m-d H:i:s", $_SESSION['user_trial']);
$trialEndTime = $dateTime->diff($userTrialDate)->format("%d");

$sql = 'SELECT * FROM tutorials';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tutorials = $stmt->fetchAll();

$userTutorials = array_filter($tutorials, fn ($tutorial) => in_array($tutorial->id, $_SESSION['user_tutorials_id']));
