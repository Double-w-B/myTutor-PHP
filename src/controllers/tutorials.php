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

if (isset($_POST['trial-close-btn'])) {
    unset($_SESSION['trialReminder']);
}

$config = require base_path("config/database.php");
$db = new Database($config["database"]);

$sql = 'SELECT * FROM tutorials';
$tutorials = $db->query($sql)->getAll();

function setPath($tutorialId)
{
    if (in_array($tutorialId, $_SESSION['user']["tutorials_id"])) {
        return "/tutorials-user/tutorial-user?id=" . $tutorialId;
    }
    return "/tutorials/tutorial?id=" . $tutorialId;
}


require view("tutorials.view.php");
