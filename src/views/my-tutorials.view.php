<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) && !$_SESSION['user']['trialEnd'] ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

        <?php include "partials/trial-reminder.php" ?>

        <?php if (count($userTutorials) > 0) : ?>
            <section>
                <?php foreach ($userTutorials as $tutorial) : ?>
                    <div class="tutorial" id="<?= $tutorial['id'] ?>">
                        <picture>
                            <img src="<?= $tutorial['img'] ?>" alt="">
                        </picture>
                        <div class="tutorial-details__content">
                            <h4><?= $tutorial['title'] ?></h4>
                            <p>Created by <?= $tutorial['created_by'] ?></p>
                            <div class="tutorial-details__content__info">
                                <p><img src="./assets/icon-bars-tutorial.svg" alt="">Modules: <?= $tutorial['modules'] ?></p>
                                <p><img src="./assets/icon-clock.svg" alt="">Hours: <?= $tutorial['hours'] ?></p>
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
                <p>Go and find your <a href="/tutorials">tutor</a></p>
            </div>
        <?php endif; ?>

    </main>

    <?php include "partials/nav.php" ?>
</div>

<?php include "partials/footer.php" ?>
<?php include "partials/modal.php" ?>

<script type="module" src="./js/my-tutorials.js"></script>
<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script>