<?php require_once "sign-up.logic.php" ?>
<?php require_once "utils.php" ?>
<?php include "./inc/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <a href='sign-in.php'><span class='sign-in'>sign in</span></a>
</header>

<main class="sign-up">

    <div class="cta">
        <h1>Learn to code by <br>
            watching others</h1>
        <p>See how experienced developers solve problems in real-time. Watching scripted tutorials is great,
            but understanding how developers think is invaluable.</p>
    </div>

    <div class="form-data">
        <div class="form-data-trial">
            <p>Try it free 7 days <span>then $20/mo. thereafter</span></p>
        </div>
        <form action="sign-up.php" method="POST">
            <div>
                <input type="text" name="name" placeholder="Name" onfocus="this.placeholder=''" onblur="this.placeholder='Name'" autocomplete="off" value="<?php rememberInputValue('input_name') ?>">
                <?php showInputError("e_name") ?>
            </div>
            <div>
                <input type="text" name="lastName" placeholder="Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='Last Name'" autocomplete="off" value="<?php rememberInputValue('input_lastName') ?>">
                <?php showInputError("e_lastName") ?>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" autocomplete="off" value="<?php rememberInputValue('input_email') ?>">
                <?php showInputError("e_email") ?>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off" value="<?php rememberInputValue('input_password') ?>">
                <?php showInputError("e_password") ?>

            </div>
            <button type="submit">Claim your free trial</button>
            <p>By clicking the button, you are agreeing to our <a href="#">Terms and Services</a></p>
        </form>
    </div>

</main>
<?php include "./inc/footer.php" ?>