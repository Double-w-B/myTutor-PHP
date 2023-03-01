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

    //! Remember input values
    $_SESSION['input_email'] = $email;
    $_SESSION['input_password'] = $password;

    if ($passedAll) {

        require_once "./config/database.php";

        try {
            //! check email in DB
            $sql = 'SELECT * FROM users WHERE email=?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetchAll();


            if (count($result) === 0) {
                validationFail("e_email", "Invalid credentials");
                validationFail("e_password", "Invalid credentials");
            } else {
                $user = $result[0];

                if (password_verify($password, $user->password)) {
                    $_SESSION['signInSuccess'] = true;
                    $_SESSION['trialReminder'] = true;
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_name'] = $user->name;
                    $_SESSION['user_lastName'] = $user->lastName;
                    $_SESSION['user_email'] = $user->email;
                    $_SESSION['user_trial'] = $user->trial;
                    $_SESSION['user_tutorials_id'] = json_decode($user->tutorials_id);
    
                    header("Location: home-page.php");
                } else {
                    validationFail("e_email", "Invalid credentials");
                    validationFail("e_password", "Invalid credentials");
                }
            }
        } catch (Exception $e) {
            echo "<p class='error'>Server error. Please, try again later</p>";
        }
    }
}
