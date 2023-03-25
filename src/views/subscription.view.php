<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="subscription" style='<?= isset($_SESSION["trialReminder"]) ? "height:calc(100% - 50px - 1rem);" : "" ?>'>

        <?php include "partials/trial-reminder.php" ?>

        <section>
            <?php foreach ($subscriptions as $key => $subscription) : ?>

                <article class="plan <?= ($key + 1) == $_SESSION['user']['subscription_id'] ? "active" : "" ?>">
                    <div class="plan__title">
                        <p><?= $subscription['name'] ?></p>
                    </div>

                    <div class="plan__benefits">
                        <?php for ($i = 0; $i < count(explode(";", $subscription['benefits'])); $i++) : ?>
                            <p>
                                <img src="./assets/icon-<?= checkIcon($key, $i) ?>.svg" alt="">
                                <span><?= explode(";", $subscription['benefits'])[$i] ?></span>
                            </p>
                        <?php endfor ?>
                    </div>

                    <div class="plan__price">
                        <p><?= $subscription['price'] ?>$</p>
                        <p>per month</p>
                    </div>
                    <form action="subscription.logic.php">
                        <input type="hidden" name="subscriptionPlan" value="<?= ($key + 1) ?>">
                        <button type="submit" class="<?= ($key + 1) == $_SESSION['user']['subscription_id'] ? "active" : "" ?>">
                            <?= ($key + 1) == $_SESSION['user']['subscription_id'] ? "my plan" : "select" ?>
                        </button>
                    </form>
                </article>

            <?php endforeach ?>
        </section>

    </main>

    <?php include "partials/nav.php" ?>

</div>

<?php include "partials/footer.php" ?>

<script type="module" src="./js/subscription.js"></script>
<script src="./js/menu.js"></script>
<script src="./js/trial-reminder.js"></script>