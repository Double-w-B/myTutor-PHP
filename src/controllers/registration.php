<?php

use Classes\Database;
use Classes\Validator;

if (isset($_SESSION['signInSuccess'])) {
    header("location: /tutorials");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //! check name
    $name = $_POST['name'];
    Validator::string('name', $name);
    Validator::string_len('name', $name, 3, 20);
    Validator::string_latin('name', $name);

    //! check last name
    $lastName = $_POST['lastName'];
    Validator::string('lastName', $lastName);
    Validator::string_len('lastName', $lastName, 3, 20);
    Validator::string_latin('lastName', $lastName);

    //! check email
    $email = $_POST['email'];
    Validator::string('email', $email);
    Validator::email('email', $email);

    //! check password
    $password = $_POST['password'];
    Validator::string('password', $password);
    Validator::string_len('password', $password, 6, 20);

    //! password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    if (empty($_SESSION['errors'])) {

        $config = require base_path("config/database.php");
        $db = new Database($config["database"]);

        try {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $user = $db->query($sql, [$email])->findOne();

            if ($user) {
                validationFail("email", "E-mail already exists");
            } else {
                $sql = "INSERT INTO users (name, lastName, email, password, trial) VALUES (?, ?, ?, ?, now() + INTERVAL 7 DAY)";
                $db->query($sql, [$name, $lastName, $email, $password_hash]);

                header("location: /login");
            }
        } catch (Exception $e) {
            echo "Server error. Please, try again later.";
        }
    }
}



require view("registration.view.php");
