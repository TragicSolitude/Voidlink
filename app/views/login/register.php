<h1 class="page-title"><?= $vm->page_title ?></h1>
<form method="POST" action="/login/doregister" id="login-form">
    <div class="form-group">
        <span class="form-label">Email</span>
        <input
                name="email"
                type="text"
                class="form-control"
                value="<?= $vm->form["email"] ?>" />
        <p>This is only used for correspondance and is not shared</p>
    </div>
    <div class="form-group">
        <span class="form-label">Username</span>
        <input
                name="username"
                type="text"
                class="form-control"
                value="<?= $vm->form["username"] ?>" />
    </div>
    <div class="form-group">
        <span class="form-label">Password</span>
        <input
                name="password"
                type="password"
                class="form-control"
                value="<?= $vm->form["password"] ?>" />
    </div>
    <div class="form-group">
        <span class="form-label">Confirm Password</span>
        <input
                name="confirmpassword"
                type="password"
                class="form-control"
                value="<?= $vm->form["confirmpassword"] ?>" />
    </div>
    <div class="errors">
    <?php foreach ($vm->errors as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach; ?>
    </div>
    <div class="form-action">
        <button class="form-button primary" type="submit">Login</button>
        <a class="form-button" href="/">Cancel</a>
    </div>
</form>

