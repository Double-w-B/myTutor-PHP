<?php include "./inc/head.php" ?>
<?php
$sql = 'SELECT * FROM tutorials';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll();

?>

<main class="home-page">

    <?php foreach ($posts as $post) : ?>
        <div class="tutorial">
            <picture>
                <img src="<?php echo $post->img ?>" alt="">
            </picture>
            <div class="tutorial-details__content">
                <h4><?php echo $post->title ?></h4>
                <p>Created by <?php echo $post->created_by ?></p>
                <div class="tutorial-details__content__info">
                    <p><i class="fa-solid fa-bars"></i>Modules: <?php echo $post->modules ?></p>
                    <p><i class="fa-regular fa-clock"></i>Hours: <?php echo $post->hours ?></p>
                </div>
            </div>
            <div class="tutorial-add-icon">
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>
    <?php endforeach; ?>

</main>

<?php include "./inc/footer.php" ?>