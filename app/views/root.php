<?php
    $pages = [
        "New Post" => "/post/new",
        "Posts" => "/",
        "Site Map" => "/index/sitemap",
        "About" => "/index/about"
    ];

    if ($vm->cur_user)
    {
        $pages = array_merge(["Logout" => "/login/dologout"], $pages);
    }
    else
    {
        $pages = array_merge(["Login" => "/login"], $pages);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $vm->page_title ?></title>
    <?php $vm->stylesheets(); ?>
</head>
<body class="theme-default">
    <div id="navigation-menu">
        <h1 id="main-title">
            <a href="/">
                <img src="/public/img/logo.png" alt="Logo" />
                Voidlink
            </a>
        </h1>
        <?php if (!empty($vm->cur_user)): ?>
        <div id="logged-in-user">
            <?php if (!empty($vm->cur_user->profile_picture)): ?>
            <img src="<?= $vm->imgurl . $vm->cur_user->profile_picture ?>" />
            <?php endif; ?>
            <span>Welcome <?= $vm->cur_user->username ?></span>
        </div>
        <?php endif; ?>
        <nav>
            <?php foreach ($pages as $name => $route):
                $aclass = "";
                if ($vm->page_title === $name)
                {
                    $aclass = "active-page";
                } ?>
            <a class="nav-link <?= $aclass ?>" href="<?= $route ?>">
                <?= $name ?>
            </a>
            <?php endforeach; ?>
        </nav>
        <div id="footer">
            &copy; 2019 Noah Shuart
        </div>
    </div>
    <div id="content">
        <?php $scope(); ?>
    </div>
    <?php $vm->scripts(); ?>
</body>
</html>

