<h1 class="page-title"><?= $vm->page_title ?></h1>
<form method="POST" action="/" id="login-form">
    <div class="form-group">
        <span class="form-label">Username</span>
        <input type="text" class="form-control" />
    </div>
    <div class="form-group">
        <span class="form-label">Password</span>
        <input type="password" class="form-control" />
    </div>
    <div class="form-action">
        <button class="form-button primary" type="submit">Login</button>
        <a class="form-button" href="/">Cancel</a>
    </div>
</form>
