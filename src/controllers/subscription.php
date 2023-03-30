<?php

use Classes\Database;

if (!isset($_SESSION["signInSuccess"])) {
    header("location: /login");
    exit();
}

$config = require base_path("config/database.php");
$db = new Database($config["database"]);

$sql = 'SELECT * FROM subscription_plans';
$subscriptions = $db->query($sql)->getAll();

if (isset($_POST["subscriptionPlan"])) {
    $userId = $_SESSION['user']['id'];
    $subscriptionId = (int) $_POST["subscriptionPlan"];

    if (!$_SESSION['user']['subscription_id']) {
        $sql = "INSERT INTO subscription_users (subscription_id, user_id) VALUES (?, ?)";
        $db->query($sql, [$subscriptionId, $userId]);
    } else {
        $sql = "UPDATE subscription_users SET subscription_id = ?, updated_at = now() WHERE user_id = ?";
        $db->query($sql, [$subscriptionId, $userId]);
    }

    $_SESSION['user']['subscription_id'] = $_POST["subscriptionPlan"];
    $_SESSION['user']['trialEnd'] = false;
}


require view("subscription.view.php");
