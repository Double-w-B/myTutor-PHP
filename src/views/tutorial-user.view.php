<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="../assets/icon-bars-menu.svg" alt=""></button>
</header>

<div class="dashboard">
    <main class="tutorial">

        <article class="trial">
            <p>
                <span>Good choice!</span> May the force be with you!
            </p>
            <form>
                <input type="hidden" name="trial-close-btn" value="">
                <button type="submit"><img src="../assets/icon-close.svg" alt="" /></button>
            </form>
        </article>

        <section>
            <picture>
                <div class="progress">
                    <div class="percentage">0%</div>
                </div>
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

            <?php foreach ($sections as $section) : ?>
                <article id="<?= $section['id'] ?>">
                    <form>
                        <input type="hidden" name="sectionId" value="<?= $section['id'] ?>">
                        <button type="submit" class="<?= in_array($section['id'], $completedSections) ? "checked" : "" ?>"></button>
                        <h3><?= $section['title'] ?></h3>
                    </form>
                    <p><?= $section['section_desc'] ?></p>

                </article>
            <?php endforeach; ?>

            <button class="delete">delete tutorial</button>

        </section>

    </main>
    <?php include "partials/nav.php" ?>
</div>

<?php include "partials/footer.php" ?>
<?php include "partials/modal.php" ?>

<script type="module" src="../js/tutorial-user.js"></script>
<script src="../js/menu.js"></script>
<script src="../js/trial-reminder.js"></script>