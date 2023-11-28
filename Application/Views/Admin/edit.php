<div class="container-edit">
    <div class="header-edit">Редактировать запись</div>
    <div class="edit-form">
        <form action="/admin/edit/<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="field-name">Имя</div>
                <input class="form-control-text" type="text" value="<?php echo htmlspecialchars($data['name'], ENT_QUOTES); ?>" name="name">
            </div>
            <div class="form-group">
                <div class="field-name">Текст</div>
                <textarea class="form-control-area" name="text"><?php echo htmlspecialchars($data['message'], ENT_QUOTES); ?></textarea>
            </div>
            <div class="form-group-img">
                <div class="field-name">Изображение</div>
                <img src="/Public/Images/<?=$data["id"]?>.jpg" alt="" class="img">
                <div><input class="form-control-img" type="file" name="img"></div>
            </div>
            <button type="submit" class="btn-save">Сохранить</button>
        </form>
    </div>
</div>