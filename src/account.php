<?php require_once "account.logic.php" ?>
<?php require_once "utils.php" ?>
<?php include "./inc/head.php" ?>


<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>


<div class="dashboard">
    <main class="account">

        <section>

            <form action="account.logic.php" method="POST">
                <h1>account details</h1>
                <div>
                    <input type="text" value="<?= ucfirst($_SESSION['user_name']) ?>" disabled>
                    <input type="text" name="name" placeholder="New Name" onfocus="this.placeholder=''" onblur="this.placeholder='New Name'" autocomplete="off">
                </div>
                <div>
                    <input type="text" value="<?= ucfirst($_SESSION['user_lastName']) ?>" disabled>
                    <input type="text" name="lastName" placeholder="New Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='New Last Name'" autocomplete="off">
                </div>
                <div>
                    <input type="email" value="<?= $_SESSION['user_email'] ?>" disabled>
                    <input type="email" name="email" placeholder="New Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='New Email Address'" autocomplete="off">
                </div>
                <div>
                    <input type="password" value="supersecret" disabled>
                    <input type="password" name="password" placeholder="New Password" onfocus="this.placeholder=''" onblur="this.placeholder='New Password'" autocomplete="off">
                </div>
                <button type="submit">Save</button>
            </form>
            <form>
                <h2>Danger zone</h2>
                <p>Once you delete the account, there is no going back. Please be certain.</p>
                <button type="submit">delete account</button>
            </form>


        </section>

    </main>
    <nav>
        <ul>
            <li><a href='#' class="active">account</a></li>
            <li><a href='user-tutors.php'>my tutors</a></li>
            <li><a href='home-page.php'>all tutors</a></li>
            <li><a href='subscription.php'>subscription</a></li>
            <li><a href='sign-out.logic.php'>sign out</a></li>
        </ul>
    </nav>
</div>

<?php include "./inc/footer.php" ?>

<script src="./js/menu.js"></script>