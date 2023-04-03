<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="../assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="tutorial">

        <?php include "partials/trial-reminder.php" ?>

        <section>

            <picture>
                <img src="<?= $tutorial['poster'] ?>" alt="">
            </picture>

            <h1><?= $tutorial['title'] ?></h1>
            <p>created by <?= $tutorial['created_by'] ?></p>
            <p>
                <?php if (strlen($tutorial['tutorial_desc']) > $maxChars) : ?>
                    <span id="desc">
                        <?= substr($tutorial['tutorial_desc'], 0, $maxChars) . '...'; ?>
                    </span>
                    <button id="show-more">Show More</button>
                <?php else : ?>
                    <?= $tutorial['tutorial_desc']; ?>
                <?php endif; ?>
            </p>

            <hr>

            <?php foreach ($sections as $key => $section) : ?>
                <article id="<?= $section['id'] ?>">
                    <h3><?= $key + 1 . ". " . $section['title'] ?></h3>
                    <p><?= $section['section_desc'] ?></p>
                </article>
            <?php endforeach; ?>

            <form>
                <input type="hidden" name="tutorialId" value="<?= $id ?>">
                <button type="submit">Enroll now</button>
            </form>

        </section>

    </main>
    <?php include "partials/nav.php" ?>
</div>

<?php include "partials/footer.php" ?>

<script type="module" src="../js/tutorial.js"></script>
<script src="../js/menu.js"></script>
<script src="../js/trial-reminder.js"></script>