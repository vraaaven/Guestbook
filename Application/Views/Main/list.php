<div class="header">
    <div class="navbar-main">
        <a href="/" class="main-link"><h1>Гостевая книга</h1></a>
    </div>
    <?if(isset($_SESSION['admin'])):?>
    <div class="navbar-item">
        <a href="/admin" class="nav-link">Административная панель</a>
    </div>
    <?endif;?>
</div>
<div class="form-container">
    <form id="form" action="main/add" method="post" enctype="multipart/form-data">
        <div class="rating-area">
            <input type="radio" id="star-5" name="rating" value="5">
            <label for="star-5" title="Оценка «5»"></label>
            <input type="radio" id="star-4" name="rating" value="4">
            <label for="star-4" title="Оценка «4»"></label>
            <input type="radio" id="star-3" name="rating" value="3">
            <label for="star-3" title="Оценка «3»"></label>
            <input type="radio" id="star-2" name="rating" value="2">
            <label for="star-2" title="Оценка «2»"></label>
            <input type="radio" id="star-1" name="rating" value="1">
            <label for="star-1" title="Оценка «1»"></label>
        </div>
        <div class="name-input-container"><input type="text" class="name-input" name="message-author" placeholder="Имя"></div>
        <div class="text-area-container"><textarea name="message-text" class="text-area" placeholder="Сообщение"></textarea></div>
        <input type="file" name="img">
        <div class="g-recaptcha" data-sitekey="6Lcubx4pAAAAAHvCc3_GIhwFoHxxZyi_UAST9Fci"></div>
        <div><input type="submit" value="Отправить" class="main-btn"></div>
    </form>
</div>
<div class="reviews-list">
    <?if(isset($arResult)):?>
    <? foreach ($arResult as $val): ?>
        <div class="review-item-container">
            <div class="review-item" id="<?=$val["id"]?>">
                <form method="post" action="main/rating" class="form-rating">
                </form>
                <img src="/Public/Images/<?=$val["id"]?>.jpg" alt="" class="img">
                <div class="date">Дата: <?= date('d.m.Y', strtotime($val['date'])); ?></div>
                <div class="rating-mini">
                    <?$rating=$val['rating']?>
                    <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>
                    <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>
                    <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>
                    <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>
                    <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                </div>
                <div class="message-container">
                    <div class="author-name">Имя пользователя: <?= $val['name']; ?></div>
                    <div class="message">Сообщение: <?= $val['message']; ?></div>
                </div>
            </div>
            <div class="comment-header"><span class="arrow">►</span>Комментарии</div>
            <div class="comments-container" style="display: none">
                <div class="form-comment-container">
                    <form class="form-comment" id="<?=$val["id"]?>" action="main/comment" method="post">
                        <div class="name-comment-container"><input type="text" class="name-comment" name="name-comment"></div>
                        <div class="message-comment-container"><textarea name="message-comment" class="message-comment"></textarea></div>
                        <div><input type="submit" value="Отправить"></div>
                    </form>
                </div>
                <?if(isset($val["comments"])):?>
                <div class="comments-list">
                    <? foreach ($val["comments"] as $comment): ?>
                    <div class="comment-item">
                        <div class="comment-date">Дата: <?= date('d.m.Y', strtotime($comment['date'])); ?></div>
                        <div class="comment-author">Имя пользователя: <?=$comment["name"]?></div>
                        <div class="comment-text">Сообщение: <?=$comment["message"]?></div>
                    </div>
                    <? endforeach; ?>
                </div>
                <?endif;?>
                </div>
        </div>
    <? endforeach; ?>
    <?endif;?>
</div>



