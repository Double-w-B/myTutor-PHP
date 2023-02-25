<?php include "./inc/head.php" ?>
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
        <form action="home-page.php" method="POST">
            <input type="text" name="name" placeholder="Name" onfocus="this.placeholder=''" onblur="this.placeholder='Name'" autocomplete="off">
            <input type="text" name="last-name" placeholder="Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='Last Name'" autocomplete="off">
            <input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'" autocomplete="off">
            <input type="password" name="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off">
            <button type="submit">Claim your free trial</button>
            <p>By clicking the button, you are agreeing to our <a href="#">Terms and Services</a></p>
        </form>
    </div>

</main>
<?php include "./inc/footer.php" ?>