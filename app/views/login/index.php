<h1 class="page-title"><?= $vm->page_title ?></h1>
<form method="POST" action="/login/dologin" id="login-form">
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
