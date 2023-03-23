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

if (isset($_POST["name"])) {
    require_once "./config/database.php";

    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST['passwordCheck'])) {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!password_verify($passwordCheck, $user->password)) {
            http_response_code(401);
            exit();
        }
        unset($_POST['passwordCheck']);
    }

    try {

        $dataKeys = array_keys($_POST);

        $params['id'] = $_SESSION['user_id'];
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

        $sql = "UPDATE users SET " . $dataCond . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        for ($i = 0; $i < count($dataKeys); $i++) {
            if ($_POST[$dataKeys[$i]] && $_POST[$dataKeys[$i]] !== "password") {
                $_SESSION["user_" . $dataKeys[$i]] = $_POST[$dataKeys[$i]];
            }
        }
    } catch (Exception $e) {
        echo "Server error. Please, try again later.";
    }
}


if (isset($_POST['accountDelete'])) {
    require_once "./config/database.php";

    $sql = 'SELECT * FROM users WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    $password = $_POST['accountDelete'];

    if (password_verify($password, $user->password)) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["id" => $_SESSION['user_id']]);

        unset($_SESSION["signInSuccess"]);
    } else {
        http_response_code(401);
    }
}

require "views/account.view.php";
