<?php

if (
    isset($_SESSION["signInSuccess"]) &&
    $_SESSION['user']['trialEnd'] &&
    !$_SESSION['user']['subscription_id']
) {
    header("location: /subscription");
    exit();
}
?>

<?php include base_path("views/partials/head.php") ?>

<header>
    <div class="logo no-select">mytutor</div>

    <?php if (isset($_SESSION["signInSuccess"])) : ?>
        <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
    <?php endif; ?>

    <?php if (!isset($_SESSION["signInSuccess"])) : ?>
        <a href='/login'><span class='sign-in'>login</span></a>
    <?php endif; ?>
</header>

<div class="dashboard">

    <?php if (isset($_SESSION["signInSuccess"])) : ?>
        <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) && !$_SESSION['user']['trialEnd'] ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

            <?php include base_path("views/partials/trial-reminder.php") ?>

            <div class="cta">
                <h1>Uh oh! Page not found.</h1>
                <p>Sorry, the page you were looking for <br>
                    doesn't exist or has been moved.</p>
                <p>Go back to <a href="/tutorials">tutorials</a></p>
            </div>

        </main>
        <?php include base_path("views/partials/nav.php") ?>
    <?php endif; ?>


    <?php if (!isset($_SESSION["signInSuccess"])) : ?>
        <main class="home-page">
            <div class="cta">
                <h1>Uh oh! Slow down.</h1>
                <p>The page you are looking for may exist,<br>
                    but is accessible only for logged users.</p>
                <p><a href="/login">Log in</a> in to your account first.</p>
            </div>
        </main>
    <?php endif; ?>
</div>

<?php include base_path("views/partials/footer.php") ?>

<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script>