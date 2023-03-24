<?php
session_start();

if (!isset($_SESSION["signInSuccess"])) {
    header("location: /login");
    exit();
}

if ($_SESSION['user']['trialEnd'] && !$_SESSION['user']['subscription_id']) {
    header("location: /subscription");
    exit();
}

function checkIcon($arrKey, $forI)
{
    if ($arrKey == 0) {
        if ($forI === 3 || $forI === 4 || $forI === 5 || $forI === 6 || $forI === 7) {
            return "cross";
        } else {
            return "check";
        }
    }
    if ($arrKey == 1) {
        if ($forI === 5 || $forI === 6 || $forI === 7) {
            return "cross";
        } else {
            return "check";
        }
    }
    if ($arrKey == 2) {
        return "check";
    }
}

require_once "./config/database.php";

$sql = 'SELECT * FROM subscriptions';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$subscriptions = $stmt->fetchAll();

if (isset($_POST["subscriptionPlan"])) {
    $sql = "UPDATE users SET subscription_id = :subscription_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $_SESSION['user']['id'], "subscription_id" => $_POST["subscriptionPlan"]]);
    $_SESSION['user']['subscription_id'] = $_POST["subscriptionPlan"];
    $_SESSION['user']['trialEnd'] = false;
}


require "views/subscription.view.php";
