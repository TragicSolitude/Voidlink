<h1 class="page-title"><?= $vm->page_title ?></h1>
<form
        method="POST"
        action="/login/doregister"
        enctype="multipart/form-data"
        id="login-form">
    <div class="form-group">
        <span class="form-label required">Email</span>
        <input
                name="email"
                type="text"
                class="form-control"
                value="<?= $vm->form["email"] ?>" />
        <p>This is only used for correspondance and is not shared</p>
    </div>
    <div class="form-group">
        <span class="form-label required">Username</span>
        <input
                name="username"
                type="text"
                class="form-control"
                value="<?= $vm->form["username"] ?>" />
    </div>
    <div class="form-group">
        <span class="form-label required">Password</span>
        <input
                name="password"
                type="password"
                class="form-control"
                value="<?= $vm->form["password"] ?>" />
    </div>
    <div class="form-group">
        <span class="form-label required">Confirm Password</span>
        <input
                name="confirmpassword"
                type="password"
                class="form-control"
                value="<?= $vm->form["confirmpassword"] ?>" />
    </div>
    <div class="form-group">
        <span class="form-label">Profile Picture</span>
        <div class="form-image-target"></div>
        <input
                name="profilepic"
                type="file"
                class="form-control" />
    </div>
    <div class="errors">
    <?php foreach ($vm->errors as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach; ?>
    </div>
    <div class="form-action">
        <button class="form-button primary" type="submit">Register</button>
        <a class="form-button" href="/">Cancel</a>
    </div>
</form>

