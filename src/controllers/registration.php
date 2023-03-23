<?php

session_start();

if (isset($_SESSION['signInSuccess'])) {
    header("location: /tutorials");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function validationFail($errorName, $errorTxt)
    {
        $_SESSION['errors'][$errorName] = $errorTxt;
    }


    //! check name
    $name = $_POST['name'];

    if (!$name) {
        validationFail("name", "Please provide value");
    }

    if ($name && ((strlen($name) < 3) || (strlen($name) > 20))) {
        validationFail("name", "Must have from 3 to 20 characters");
    }

    if ($name && ctype_alnum($name) == false) {
        validationFail("name", "Only latin letters allowed");
    }

    //! check last name
    $lastName = $_POST['lastName'];

    if (!$lastName) {
        validationFail("lastName", "Please provide value");
    }

    if ($lastName && ((strlen($lastName) < 3) || (strlen($lastName) > 20))) {
        validationFail("lastName", "Must have from 3 to 20 characters");
    }

    if ($lastName && ctype_alnum($lastName) == false) {
        validationFail("lastName", "Only latin letters allowed");
    }

    //! check email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!$email) {
        validationFail("email", "Please provide value");
    }

    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) == false || $emailB !== $email) {
        validationFail("email", "Check your email value");
    }

    //! check password
    $password = $_POST['password'];

    if (!$password) {
        validationFail("password", "Please provide value");
    }

    if ($password && (strlen($password) < 6 || strlen($password) > 20)) {
        validationFail("password", "Must have from 6 to 20 characters");
    }

    //! password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($_SESSION['errors'])) {

        require "./config/database.php";

        try {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $users = $stmt->fetch();

            if ($users) {
                validationFail("email", "E-mail already exists");
            } else {
                $sql = "INSERT INTO users (name, lastName, email, password, trial) VALUES (:name, :lastName, :email, :password, now() + INTERVAL 7 DAY)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute(["name" => $name, "lastName" => $lastName, "email" => $email, "password" => $password_hash]);
                header("location: /login");
            }
        } catch (Exception $e) {
            echo "Server error. Please, try again later.";
        }
    }
}



require "views/registration.view.php";
