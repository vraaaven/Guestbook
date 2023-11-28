<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админка</title>
    <link href="/Public/Styles/admin.css" rel="stylesheet">
    <link href="/Public/Styles/reset.css" rel="stylesheet">
    <script src="/Public/Scripts/jquery.js"></script>
    <script src="/Public/Scripts/form.js"></script>
</head>
<body>
<?php if ($this->route['action'] != 'login'): ?>
    <nav class="admin-nav">
        <div class="navbar-main">
            <a class="main-link" href="/admin/posts">Панель Администратора</a>
        </div>
        <div class="navbar-item">
            <a class="nav-link" href="/">Главная</a>
        </div>
        <div class="navbar-item">
            <a class="nav-link" href="/admin/logout">Выход</a>
        </div>
    </nav>
<?php endif; ?>
<?php echo $content; ?>
<?php if ($this->route['action'] != 'login'): ?>
    <div class="footer">
        <p>&copy; 2023 &mdash; 2023 &laquo;Футер&raquo;</p>
    </div>
<?php endif; ?>
</body>
</html>