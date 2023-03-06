<?php
require_once "./config/database.php";

session_start();

if (!isset($_SESSION["signInSuccess"])) {
    header("Location: sign-in.php");
    exit();
}
if($_SESSION['user_trialEnd'] && !$_SESSION['user_subscription']){
    header("Location: subscription.php");
    exit();
}

if (isset($_POST['trial-close-btn'])) {
    unset($_SESSION['trialReminder']);
}

if (isset($_POST['addTutorialIdToDB']) && !in_array($_POST['addTutorialIdToDB'], $_SESSION["user_tutorials_id"])) {
    array_push($_SESSION['user_tutorials_id'], $_POST['addTutorialIdToDB']);
    $savedTutorials = implode(",", $_SESSION['user_tutorials_id']);

    $sql = "UPDATE users SET tutorials_id = :tutorials_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $_SESSION['user_id'], "tutorials_id" => $savedTutorials]);
}



$sql = 'SELECT * FROM tutorials';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tutorials = $stmt->fetchAll();
