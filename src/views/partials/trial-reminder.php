<?php

$dateTime = new DateTime();
$currentDate = $dateTime->format("Y-m-d H:i:s");
$userTrialDate = DateTime::createFromFormat("Y-m-d H:i:s", $_SESSION['user']['trial']);
$trialEndTime = $dateTime->diff($userTrialDate)->format("%d");

?>

<article class="trial">

    <?php if ($_SESSION['user']['subscription_id'] && isset($_SESSION['trialReminder'])) : ?>
        <p>Hey,
            <span><?= ucfirst($_SESSION['user']['name']) ?></span>! Be patient. Study hard and be smart.
        </p>
        <form>
            <input type="hidden" name="trial-close-btn" value="">
            <button type="submit"><img src="../assets/icon-close.svg" alt="" /></button>
        </form>
    <?php endif; ?>

    <?php if (!$_SESSION['user']['subscription_id'] && isset($_SESSION['trialReminder']) && !$_SESSION['user']['trialEnd']) : ?>
        <p>Hey,
            <span><?= ucfirst($_SESSION['user']['name']) ?></span>! Free trial ends in
            <span><?= $trialEndTime > 1 ? "$trialEndTime days" : " $trialEndTime day" ?></span>, upgrade your subscription
            <a href="/subscription">now</a>.
        </p>
        <form>
            <input type="hidden" name="trial-close-btn" value="">
            <button type="submit"><img src="../assets/icon-close.svg" alt="" /></button>
        </form>
    <?php endif; ?>

    <?php if (!$_SESSION['user']['subscription_id'] && isset($_SESSION['trialReminder']) && $_SESSION['user']['trialEnd']) : ?>
        <p>Hey,
            <span><?= ucfirst($_SESSION['user']['name']) ?></span>! Your free trial has ended
            <span><?= $trialEndTime == 0 ? "today" : ($trialEndTime > 1 ? "$trialEndTime days ago" : " $trialEndTime day ago") ?></span>, upgrade your subscription.
        </p>
    <?php endif; ?>

</article>