<?php include "partials/head.php" ?>



<header>
    <div class="logo no-select">mytutor</div>
    <a href='/'><span class='sign-in'>sign up</span></a>
</header>

<main class="sign-in">

    <div class="form-data">

        <form action="sign-in.php" method="POST">
            <h2>Sign in to your account</h2>

            <div>
                <input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" autocomplete="off" value="<?php rememberInputValue('input_email') ?>">
                <?php showInputError("e_email") ?>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off" value="<?php rememberInputValue('input_password') ?>">
                <?php showInputError("e_password") ?>

            </div>
            <button type="submit">Sign In</button>
            <p>By clicking the button, you are agreeing to our <a href="#">Terms and Services</a></p>
        </form>
    </div>

    <div class="cta">
        <h1>Learn at your own pace <br>
            with hands-on creative classes.</h1>
        <p>With real world projects to create and online classes that fit a busy routine, <strong>MYTUTOR</strong> makes real learning and growth possible.</p>
        <p>Start, switch or advance your career and degrees from world-class universities and companies.</p>
    </div>
</main>


<?php include "partials/footer.php" ?>