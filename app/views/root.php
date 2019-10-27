<!DOCTYPE html>
<html>
<head>
    <title><?= $vm->page_title ?></title>
    <?php $vm->stylesheets() ?>
</head>
<body>
    <?php $scope(); ?>
    <?php $vm->scripts() ?>
</body>
</html>

