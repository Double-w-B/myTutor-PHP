<?php
$navLinks = ['account', 'tutorials', 'tutorials-user',  'subscription', 'logout'];
$url = parse_url($_SERVER['REQUEST_URI'])['path'];

function checkLinkName($name)
{
    if ($name === "tutorials-user") return "my tutorials";

    return $name;
}

?>

<nav>
    <ul>
        <?php foreach ($navLinks as $link) : ?>
            <?php if ($url === "/" . $link) : ?>
                <li><a href='#' class="active"><?= checkLinkName($link) ?></a></li>
            <?php else : ?>
                <li><a href='<?= "/" . $link ?>'><?= checkLinkName($link) ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>