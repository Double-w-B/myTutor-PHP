<div class="modal__backdrop">

    <div class="modal__remove-tutorial">
        <div class="modal__remove-tutorial__btn-close">
            <img src="./assets/icon-close.svg" alt="">
        </div>
        <p>Are you sure you want to delete <span></span> tutorial and all the progress with it?</p>
        <form>
            <input type="hidden" name="removeTutorialIdFromDB">
            <button type="submit">delete</button>
        </form>
    </div>

    <div class="modal__delete-account">
        <div class="modal__delete-account__btn-close">
            <img src="./assets/icon-close.svg" alt="">
        </div>
        <p>Confirm password to continue</p>
        <p>Your account and all your tutorials will be permanently deleted.</p>
        <form>
            <input type="password" name="accountDelete" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off">
            <p class="infoMsg"></p>
            <img src="./assets/icon-error.svg" alt="">
            <button type="submit">delete</button>
        </form>
    </div>

    <div class="modal__update-account">
        <div class="modal__update-account__btn-close">
            <img src="./assets/icon-close.svg" alt="">
        </div>
        <p>Confirm password to continue</p>
        <p>To change the email or password confirm current password.</p>
        <form>
            <input type="password" name="passwordCheck" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'" autocomplete="off">
            <p class="infoMsg"></p>
            <img src="./assets/icon-error.svg" alt="">
            <button type="submit">save</button>
        </form>
    </div>

</div>