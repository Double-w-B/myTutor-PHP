<?php

use Classes\Database;
use Classes\Validator;

if (isset($_SESSION['signInSuccess'])) {
    header("location: /tutorials");
    exit();
}

$dateTime = new DateTime();
$currentDate = $dateTime->format("Y-m-d H:i:s");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //! check email
    $email = $_POST['email'];
    Validator::string('email', $email);
    Validator::email('email', $email);

    //! check password
    $password = $_POST['password'];
    Validator::string('password', $password);
    Validator::string_len('password', $password, 6, 20);

    if (empty($_SESSION['errors'])) {

        try {
            $config = require base_path("config/database.php");
            $db = new Database($config["database"]);

            //! check email in DB
            $sql = 'SELECT * FROM users WHERE email = ?';
            $user = $db->query($sql, [$email])->findOne();

            if (!$user) {
                validationFail("email", "Invalid credentials");
                validationFail("password", "Invalid credentials");
            } else {

                if (password_verify($password, $user['password'])) {

                    $sql = 'SELECT tutorial_id FROM tutorials_users WHERE user_id = ?';
                    $user_tutorials_ids_result = $db->query($sql, [$user['id']])->getAll();
                    $user_tutorials_ids = array_map(fn ($tutorial) => $tutorial["tutorial_id"], $user_tutorials_ids_result);

                    $sql = 'SELECT subscription_id FROM subscription_users WHERE user_id = ?';
                    $subscription_id_result = $db->query($sql, [$user['id']])->findOne();
                    $subscription_id = $subscription_id_result["subscription_id"] ?? NULL;


                    $_SESSION['signInSuccess'] = true;
                    $_SESSION['trialReminder'] = true;
                    $_SESSION['user']['trialEnd'] = $currentDate > $user['trial'];

                    foreach (array_keys($user) as $column) {
                        $_SESSION['user'][$column] = $user[$column];
                    }

                    $_SESSION['user']['tutorials_id'] = $user_tutorials_ids;
                    $_SESSION['user']['subscription_id'] = $subscription_id;


                    header("location: /tutorials");
                } else {
                    validationFail("email", "Invalid credentials");
                    validationFail("password", "Invalid credentials");
                }
            }
        } catch (Exception $e) {
            echo "Server error. Please, try again later.";
        }
    }
}

require view("login.view.php");
