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

if ($_SERVER['REQUEST_METHOD'] === "POST" && !$_POST['accountDelete']) {

    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST['passwordCheck'])) {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $user = $db->query($sql, [$_SESSION['user']['id']])->findOne();

        if (!password_verify($passwordCheck, $user['password'])) {
            http_response_code(401);
            exit();
        }
        unset($_POST['passwordCheck']);
    }

    try {

        $dataKeys = array_keys($_POST);

        $params['id'] = $_SESSION['user']['id'];
        $dataCondArray = [];

        for ($i = 0; $i < count($dataKeys); $i++) {
            if ($_POST[$dataKeys[$i]]) {
                if ($dataKeys[$i] === "password") {
                    $params[$dataKeys[$i]] = $password_hash;
                } else {
                    $params[$dataKeys[$i]] = $_POST[$dataKeys[$i]];
                }
                array_push($dataCondArray, $dataKeys[$i] . "=:" . $dataKeys[$i]);
            }
        };

        $dataCond = implode(",", $dataCondArray);

        $sql = "UPDATE users SET " . $dataCond . ", updated_at = now() WHERE id = :id";
        $db->query($sql, $params);

        for ($i = 0; $i < count($dataKeys); $i++) {
            if ($_POST[$dataKeys[$i]] && $_POST[$dataKeys[$i]] !== "password") {
                $_SESSION["user"][$dataKeys[$i]] = $_POST[$dataKeys[$i]];
            }
        }
    } catch (Exception $e) {
        echo "Server error. Please, try again later.";
    }
}

if (isset($_POST['accountDelete'])) {

    $sql = 'SELECT * FROM users WHERE id = ?';
    $user = $db->query($sql, [$_SESSION['user']['id']])->findOne();

    $password = $_POST['accountDelete'];

    if (!password_verify($password, $user['password'])) {
        http_response_code(401);
        exit();
    }

    $sql = "DELETE FROM users WHERE id = ?";
    $db->query($sql, [$user['id']]);

    logout();
}

require view("account.view.php");
