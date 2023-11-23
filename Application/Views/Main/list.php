<div class="header"><h1>Гостевая книга</h1></div>
<form action="">
    <input type="text">
    <input type="text">
</form>
<div class="reviews-list">
    <?foreach ($arResult as $val):?>
        <div class="review-item">
            <div class="headline">
                <div class="border_date"><p><?=date('d.m.Y', strtotime($val['date']));?></p></div>
                <div class="author-name"><p><?=$val['name'];?></p></div>
            </div>
            <div class="message"><?= $val['message']; ?></div>
        </div>
    <?endforeach;?>



    <!--<div class="pagination-block">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item" id="arrow">
                    <a href="/news/list/page=<?= ($page - 1); ?>">←</a>
                </li>
            <?php endif; ?>
            <?php for ($i = $page; $i <= $totalPages && $i <= $page + 2; $i++): ?>
                <?php if ($i == $page): ?>
                    <li class="page_active">
                        <span><?= $i; ?></span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a href="/news/list/page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item" id="arrow">
                    <a href="/news/list/page=<?= ($page + 1); ?>">→</a>
                </li>
            <?php endif; ?>
        </ul>
    </div> -->
</div>




