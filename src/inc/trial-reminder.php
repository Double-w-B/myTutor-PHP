<?php if (isset($_SESSION['trialReminder'])) : ?>
    <article>
        <p>Hey,
            <span><?= ucfirst($_SESSION['user_name']) ?></span>! Free trial ends in <span><?= $trialEndTime ?>
                days</span>, upgrade your subscription <a href="subscription.php">now</a>.
        </p>
        <form>
            <input type="hidden" name="trial-close-btn" value="">
            <button type="submit"><img src="./assets/icon-close.svg" alt="" /></button>
        </form>
    </article>
<?php endif; ?>