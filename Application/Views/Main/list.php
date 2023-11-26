<div class="header"><h1>Гостевая книга</h1></div>
<div class="form-container">
    <form id="form" action="main/add" method="post">
        <div class="name-input-container"><input type="text" class="name-input" name="message-author"></div>
        <div class="text-area-container"><textarea name="message-text" class="text-area"></textarea></div>
        <div><input type="submit" value="Отправить"></div>
    </form>
</div>
<div class="reviews-list">
    <? foreach ($arResult as $val): ?>
        <div class="review-item-container">
            <div class="review-item">
                <div class="date"><?= date('d.m.Y', strtotime($val['date'])); ?></div>
                <div class="message-container">
                    <div class="author-name"><?= $val['name']; ?></div>
                    <div class="message"><?= $val['message']; ?></div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>



