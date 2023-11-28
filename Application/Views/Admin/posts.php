<div class="posts-list">
    <div class="posts-header">Список отзывов</div>
    <?php if (empty($list)): ?>
        <p>Список постов пуст</p>
    <?php else: ?>
        <table class="table">
            <?php foreach ($list as $val): ?>
                <tr>
                    <td class="item-text"><p class="name-item"><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></p></td>
                    <td class="btn"><a href="/admin/edit/<?php echo $val['id']; ?>" class="edit-link">Редактировать</a></td>
                    <td class="btn"><a href="/admin/delete/<?php echo $val['id']; ?>" class="edit-link">Удалить</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
