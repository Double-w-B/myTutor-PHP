<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) && !$_SESSION['user_trialEnd'] ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

        <?php include "partials/trial-reminder.php" ?>

        <?php if (count($userTutorials) > 0) : ?>
            <section>
                <?php foreach ($userTutorials as $tutorial) : ?>
                    <div class="tutorial" id="<?= $tutorial->id ?>">
                        <picture>
                            <img src="<?= $tutorial->img ?>" alt="">
                        </picture>
                        <div class="tutorial-details__content">
                            <h4><?= $tutorial->title ?></h4>
                            <p>Created by <?= $tutorial->created_by ?></p>
                            <div class="tutorial-details__content__info">
                                <p><img src="./assets/icon-bars-tutorial.svg" alt="">Modules: <?= $tutorial->modules ?></p>
                                <p><img src="./assets/icon-clock.svg" alt="">Hours: <?= $tutorial->hours ?></p>
                            </div>
                        </div>

                        <button type="button">remove from my tutors</button>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <?php if (count($userTutorials) === 0) : ?>
            <div class="cta">
                <h1>Hurry Up, time is ticking!</h1>
                <p>Start, switch or advance your career and degrees <br>
                    from world-class universities and companies.</p>
                <p>Go and find your <a href="home-page.php">tutor</a></p>
            </div>
        <?php endif; ?>

    </main>

    <nav>
        <ul>
            <li><a href='account.php'>account</a></li>
            <li><a href='#' class="active">my tutors</a></li>
            <li><a href='home-page.php'>all tutors</a></li>
            <li><a href='subscription.php'>subscription</a></li>
            <li><a href='sign-out.logic.php'>sign out</a></li>
        </ul>
    </nav>
</div>

<?php include "partials/footer.php" ?>
<?php include "partials/modal.php" ?>

<!-- <script type="module" src="./js/user-tutors.js"></script>
<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script> -->