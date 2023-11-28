<!doctype html>
<html>
<head>
    <title><?= $head ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Styles/reset.css">
    <link rel="stylesheet" type="text/css" href="/Public/Styles/style.css">
</head>
<body>
<div class="header">
    <div>
        <!--<img src="/Public/Images/logo.jpg" class="logo">-->
    </div>
    <div class="name">
        <p>Тестовый сайт</p>
    </div>
</div>
<div class="content">
    <?php echo $content; ?>
</div>
<div class="footer">
    <p>&copy; 2023 &mdash; 2023 &laquo;Футер&raquo;</p>
</div>
<script src="/Public/Scripts/jquery.js"></script>
<script src="/Public/Scripts/ajax.js"></script>
<script src="/Public/Scripts/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>
