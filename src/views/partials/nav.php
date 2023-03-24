<?php
$navLinks = ['account', 'tutorials', 'my-tutorials',  'subscription', 'logout'];
?>

<nav>
    <ul>
        <?php foreach ($navLinks as $link) : ?>
            <?php if ($url === "/" . $link) : ?>
                <li><a href='#' class="active"><?= str_replace("-", " ", $link) ?></a></li>
            <?php else : ?>
                <li><a href='<?= "/" . $link ?>'><?= str_replace("-", " ", $link) ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>