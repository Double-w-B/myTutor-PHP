<?php include "./config/database.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="stylesheet" href="style.css">
    <title>MYTUTOR</title>
</head>

<body>
    <header>
        <div class="logo no-select">mytutor</div>
        <?php
        if (isset($_SESSION['signUpSuccess'])) {
            echo "<a href='sign-in.php'><span class='sign-in'>sign in</span></a>";
        }
        if (isset($_SESSION['signInSuccess'])) {
            echo "<a href='sign-out.logic.php'><span class='sign-in'>sign out</span></a>";
        }
        if (!isset($_SESSION['signUpSuccess']) && !isset($_SESSION['signInSuccess'])) {
            echo "<a href='sign-up.php'><span class='sign-in'>sign up</span></a>";
        }
        ?>
    </header>