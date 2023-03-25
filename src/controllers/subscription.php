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

$sql = 'SELECT * FROM subscriptions';
$subscriptions = $db->query($sql)->getAll();

if (isset($_POST["subscriptionPlan"])) {
    $sql = "UPDATE users SET subscription_id = :subscription_id WHERE id = :id";
    $db->query($sql,["id" => $_SESSION['user']['id'], "subscription_id" => $_POST["subscriptionPlan"]]);

    $_SESSION['user']['subscription_id'] = $_POST["subscriptionPlan"];
    $_SESSION['user']['trialEnd'] = false;
}


require view("subscription.view.php");
