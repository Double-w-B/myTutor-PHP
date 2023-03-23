<?php include "partials/head.php" ?>

<header>
    <div class="logo no-select">mytutor</div>
    <a href='/login'><span class='sign-in'>Login</span></a>
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
        <form action="" method="POST">
            <div>
                <input type="text" name="name" placeholder="Name" onfocus="this.placeholder=''" onblur="this.placeholder='Name'" autocomplete="off" value="<?= $_POST["name"] ?? "" ?>">
                <?php showInputError("name") ?>
            </div>
            <div>
                <input type="text" name="lastName" placeholder="Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='Last Name'" autocomplete="off" value="<?= $_POST["lastName"] ?? "" ?>">
                <?php showInputError("lastName") ?>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" autocomplete="off" value="<?= $_POST["email"] ?? "" ?>">
                <?php showInputError("email") ?>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off" value="<?= $_POST["password"] ?? "" ?>">
                <?php showInputError("password") ?>
            </div>
            <button type="submit">Claim your free trial</button>
            <p>By clicking the button, you are agreeing to our <a href="#">Terms and Services</a></p>
        </form>
    </div>

</main>
<?php include "partials/footer.php" ?>