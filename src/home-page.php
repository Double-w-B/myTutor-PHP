<?php require_once "home-page.logic.php" ?>
<?php include "./inc/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) ? "height:calc(100% - 50px);" : "" ?>'>
        <?php if (isset($_SESSION['trialReminder'])) : ?>
            <article>
                <p>Hey,
                    <span><?= ucfirst($_SESSION['user_name']) ?></span>! Free trial ends in <span><?= $trialEndTime ?>
                        days</span>, upgrade your subscription <a href="subscription.php">now</a>.
                </p>
                <form method="POST" action="home-page.php">
                    <input type="hidden" name="trial-close-btn" value="">
                    <button type="submit"><img src="./assets/icon-close.svg" alt="" /></button>
                </form>
            </article>
        <?php endif; ?>

        <section>

            <?php foreach ($tutorials as $tutorial) : ?>
                <div class="tutorial">
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

                    <form method="POST" action="home-page.php">
                        <input type="hidden" name="<?= !in_array($tutorial->id, $_SESSION["user_tutorials_id"]) ? 'addTutorialIdToDB' : 'removeTutorialIdFromDB' ?>" value="<?= $tutorial->id ?>">
                        <button type="submit">
                            <?= !in_array($tutorial->id, $_SESSION["user_tutorials_id"]) ? 'add to' : 'remove from' ?>
                            my tutors
                        </button>
                    </form>


                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <nav>
        <ul>
            <li><a href=' user-tutors.php'>my tutors</a></li>
            <li><a href='sign-out.logic.php'>sign out</a></li>
        </ul>

    </nav>
</div>
<script src="./js/home-page.js"></script>

<?php include "./inc/footer.php" ?>