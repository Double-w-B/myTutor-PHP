<?php
session_start();

if (isset($_POST['email'])) {

    //! validation success
    $passedAll = true;

    function validationFail($errorName, $errorTxt)
    {
        global $passedAll;
        $passedAll = false;
        $_SESSION[$errorName] =  $errorTxt;
    }

    //! check name
    $name = $_POST['name'];

    if (!$name) {
        validationFail("e_name", "Please provide value");
    }

    if ($name && ((strlen($name) < 3) || (strlen($name) > 20))) {
        validationFail("e_name", "Must have from 3 to 20 characters");
    }

    if ($name && ctype_alnum($name) == false) {
        validationFail("e_name", "Only latin letters allowed");
    }

    //! check last name
    $lastName = $_POST['lastName'];

    if (!$lastName) {
        validationFail("e_lastName", "Please provide value");
    }

    if ($lastName && ((strlen($lastName) < 3) || (strlen($lastName) > 20))) {
        validationFail("e_lastName", "Must have from 3 to 20 characters");
    }

    if ($lastName && ctype_alnum($lastName) == false) {
        validationFail("e_lastName", "Only latin letters allowed");
    }

    //! check email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!$email) {
        validationFail("e_email", "Please provide value");
    }

    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) == false || $emailB !== $email) {
        validationFail("e_email", "Check your email value");
    }

    //! check password
    $password = $_POST['password'];

    if (!$password) {
        validationFail("e_password", "Please provide value");
    }

    if ($password && (strlen($password) < 6 || strlen($password) > 20)) {
        validationFail("e_password", "Must have from 3 to 20 characters");
    }

    //! password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    //! Remember input values
    $_SESSION['input_name'] = $name;
    $_SESSION['input_lastName'] = $lastName;
    $_SESSION['input_email'] = $email;
    $_SESSION['input_password'] = $password;


    //! check if in DB no duplicate data 
    require_once "./config/database.php";
    try {
        //! check email in DB
        $sql = 'SELECT * FROM users WHERE email=?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $users = $stmt->fetchAll();

        if (count($users) > 0) {
            validationFail("e_email", "E-mail already exists");
        }

        //! Registration success
        if ($passedAll === true) {
            //! insert a new user to DB
            $sql = "INSERT INTO users( id, name, lastName, email, password, trial) VALUES ( NULL, :name, :lastName, :email, :password, now() + INTERVAL 7 DAY)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["name" => $name, "lastName" => $lastName, "email" => $email, "password" => $password_hash]);
            $_SESSION['registrationSuccess'] = true;
            header("Location: sign-in.php");
        }
    } catch (Exception $e) {
        echo "<p class='error'>Server error. Please, try again later</p>";
    }
}
