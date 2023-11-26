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
        <div class="review-item">
                <table>
                    <tr>
                        <td><div class="author-name"><?= $val['name']; ?></div></td>
                        <td><div class="date"><?= date('d.m.Y', strtotime($val['date'])); ?></div></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="message"><?= $val['message']; ?></div>
                        </td>
                    </tr>
                </table>
        </div>
    <? endforeach; ?>


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



