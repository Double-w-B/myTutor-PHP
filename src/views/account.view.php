<?php include "partials/head.php" ?>


<header>
    <div class="logo no-select">mytutor</div>
    <button><img src="./assets/icon-bars-menu.svg" alt=""></button>
</header>


<div class="dashboard">
    <main class="account">

        <section>

            <form class="data-update">
                <h1>account details</h1>
                <div>
                    <input type="text" value="<?= ucfirst($_SESSION['user']['name']) ?>" disabled>
                    <input type="text" name="name" placeholder="New Name" onfocus="this.placeholder=''" onblur="this.placeholder='New Name'" autocomplete="off" value="<?php $_POST["name"] ?? "" ?>">
                    <p></p>
                    <img src="./assets/icon-error.svg" alt="">
                </div>
                <div>
                    <input type="text" value="<?= ucfirst($_SESSION['user']['lastName']) ?>" disabled>
                    <input type="text" name="lastName" placeholder="New Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='New Last Name'" autocomplete="off" value="<?php $_POST["lastName"] ?? "" ?>">
                    <p></p>
                    <img src="./assets/icon-error.svg" alt="">
                </div>
                <div>
                    <input type="email" value="<?= $_SESSION['user']['email'] ?>" disabled>
                    <input type="email" name="email" placeholder="New Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='New Email Address'" autocomplete="off" value="<?php $_POST["email"] ?? "" ?>">
                    <p></p>
                    <img src="./assets/icon-error.svg" alt="">
                </div>
                <div>
                    <input type="password" value="supersecret" disabled>
                    <input type="password" name="password" placeholder="New Password" onfocus="this.placeholder=''" onblur="this.placeholder='New Password'" autocomplete="off" value="<?php $_POST["password"] ?? "" ?>">
                    <p></p>
                    <img src="./assets/icon-error.svg" alt="">
                </div>
                <button type="submit">Save</button>
            </form>

            <div class="account-delete">
                <h2>Danger zone</h2>
                <p>Once you delete the account, there is no going back. Please be certain.</p>
                <input type="hidden" name="accountDelete">
                <button>delete account</button>
            </div>


        </section>

    </main>

    <?php include "partials/nav.php" ?>
</div>

<?php include "partials/footer.php" ?>
<?php include "partials/modal.php" ?>

<script type="module" src="./js/account-delete.js"></script>
<script type="module" src="./js/account-update.js"></script>
<script src="./js/menu.js"></script>