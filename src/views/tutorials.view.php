<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="home-page" style='<?= isset($_SESSION["trialReminder"]) ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

        <?php include "partials/trial-reminder.php" ?>

        <section>
            <?php foreach ($tutorials as $tutorial) : ?>
                <div class="tutorial">
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

                    <form action="<?= setPath($tutorial['id']) ?>">
                        <input type="hidden" name="id" value="<?= $tutorial['id'] ?>">
                        <button type="submit" style='<?= in_array($tutorial['id'], $_SESSION['user']["tutorials_id"]) ? "background-color: #6055A5;" : "" ?>'>
                            <?= !in_array($tutorial['id'], $_SESSION['user']["tutorials_id"]) ? "explore" : "in progress" ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>

    </main>
    <?php include "partials/nav.php" ?>
</div>

<?php include "partials/footer.php" ?>

<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script>