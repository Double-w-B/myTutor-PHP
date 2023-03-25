<?php


$dateTime = new DateTime();
$currentDate = $dateTime->format("Y-m-d H:i:s");

if (isset($_SESSION['signInSuccess'])) {
    header("location: /tutorials");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function validationFail($errorName, $errorTxt)
    {
        $_SESSION['errors'][$errorName] = $errorTxt;
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


    if (empty($_SESSION['errors'])) {
        require base_path("config/database.php");


        try {
            //! check email in DB
            $sql = 'SELECT * FROM users WHERE email = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                validationFail("email", "Invalid credentials");
                validationFail("password", "Invalid credentials");
            } else {

                if (password_verify($password, $user['password'])) {
                    $_SESSION['signInSuccess'] = true;
                    $_SESSION['trialReminder'] = true;
                    $_SESSION['user']['trialEnd'] = $currentDate > $user['trial'];

                    foreach (array_keys($user) as $column) {
                        $_SESSION['user'][$column] = $user[$column];
                    }

                    if (strlen($user['tutorials_id']) > 0) {
                        $_SESSION['user']['tutorials_id'] = explode(",", $user['tutorials_id']);
                    } else {
                        $_SESSION['user']['tutorials_id'] = [];
                    }

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
