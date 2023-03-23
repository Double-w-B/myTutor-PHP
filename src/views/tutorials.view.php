<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) && !$_SESSION['user_trialEnd'] ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

        <?php include "partials/trial-reminder.php" ?>

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

                    <form>
                        <input type="hidden" name="addTutorialIdToDB" value="<?= $tutorial->id ?>">
                        <button type="submit" style='<?= in_array($tutorial->id, $_SESSION["user_tutorials_id"]) ? "pointer-events: none; box-shadow: none; background-color: #342A7A;" : "" ?>'>
                            <?= !in_array($tutorial->id, $_SESSION["user_tutorials_id"]) ? 'add to my tutors' : 'in progress' ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>

    </main>

    <nav>
        <ul>
            <li><a href='account.php'>account</a></li>
            <li><a href='user-tutors.php'>my tutors</a></li>
            <li><a href='#' class="active">all tutors</a></li>
            <li><a href='subscription.php'>subscription</a></li>
            <li><a href='sign-out.logic.php'>sign out</a></li>
        </ul>
    </nav>
</div>

<?php include "partials/footer.php" ?>

<!-- <script type="module" src="./js/home-page.js"></script>
<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script> -->