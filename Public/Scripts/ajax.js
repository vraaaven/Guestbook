$(document).ready(function () {
    $('#form').on('submit', function (e) {
        let data = new FormData(this)
        $.ajax({
            method: "POST",
            url: $(this).attr('action'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                let date = new Date(result.message.date);
                let formattedDate = date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear();
                if (result.status == 'success') {
                    $('.reviews-list').prepend('<div class="review-item-container">' +
                        '<button class="dlt-btn">Удалить</button><button class="edit-btn">Изменить</button>' +
                        '<div class="review-item" id="'+result.message.id+'">' +
                        '<img src="/Public/Images/'+result.message.id+'.jpg" alt="" class="img">'+
                        '<div class="date">' + formattedDate + '</div>' +
                        '<div class="rating-mini">'+
                            '<span class=""></span>'+
                            '<span class=""></span>'+
                            '<span class=""></span>' +
                            '<span class=""></span>' +
                            '<span class=""></span>'+
                        '</div>'+
                        '<div class="message-container">' +
                        '<div class="author-name">' + result.message.name + '</div>' +
                        '<div class="message">' + result.message.text + '</div>' +
                        '</div>' +
                        '</div></div>'
                    );
                    var rating = result.message.rating;
                    var ratingElems = $('.rating-mini span');

                    for (var i = 0; i < rating; i++) {
                        ratingElems.eq(i).addClass('active');
                    }
                }
                if (result.status == 'error') {
                    $('#form .info-box').html('<div class="error">' + result.message + '</div>');
                }
                if (result.status == 'error-captcha') {
                    alert(result.message)
                }

            }
        });
        $("#form").trigger('reset');
        e.preventDefault();
    });
    $('.form-comment').on('submit', function (e) {
        let id = $(this).attr('id');
        console.log($(this))
        let array1 = $(this).serializeArray()
        let array2 = [{name:'id',value:id}]
        let array = $.merge(array2, array1)
        console.log(array)
        $.ajax({
            method: "POST",
            url: $(this).attr('action'),
            data:array,
            dataType: 'json',
            success: function (result) {
                let date = new Date(result.message.date);
                let formattedDate = date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear();
                if (result.status == 'success') {
                    $('.comments-list').prepend('<div class="comment-item">' +
                        '<div class="comment-date">' + formattedDate + '</div>' +
                        '<div class="comment-author">' + result.message.name + '</div>' +
                        '<div class="comment-text">' + result.message.message + '</div>' +
                        '</div>'
                    );
                }
                if (result.status == 'error') {

                }

            }
        });
        e.preventDefault();
    });
    /* Не используется, но на всякий случай оставлю
    $('.form-rating').on('submit', function (e) {
        let form = $(this)
        let id = parseInt($(this).parent('.review-item').attr('id'));
        console.log(form)
        let array1 = $(this).serializeArray()
        let array2 = [{name:'id',value:id}]
        let array = $.merge(array2, array1)
        console.log(array)
        $.ajax({
            method: "POST",
            url: $(this).attr('action'),
            data:array,
            dataType: 'json',
            success: function (result) {
                if (result.status == 'success') {
                    form.html('Спасибо за отзыв')
                }
                if (result.status == 'error') {
                }

            }
        });
        clearForm();
        e.preventDefault();
    });*/
    $(document).on('click', '.dlt-btn', function (e) {
        let itemContainer = $(this).parent('.review-item-container')
        let id = itemContainer.children('.review-item').attr('id');
        itemContainer.remove();
        $.ajax({
            method: "POST",
            url: 'main/delete',
            data: {id:id},
            dataType: 'json',
            success: function (result) {
            }
        });
        e.preventDefault();
    });
    $(document).on('click', '.edit-btn', '.review-item', function () {
        let itemContainer = $(this).siblings('.review-item').children('.message-container');
        let id = $(this).siblings('.review-item').attr('id');
        let authorName = itemContainer.children('.author-name').text();
        let message = itemContainer.children('.message').text();
        let form = '<form class="form-edit" action="main/edit" method="post"><input type="text" name="name" value="' + authorName + '"><br><textarea name="message">' + message + '</textarea><input type="hidden" value="'+id+'" name="id"><br><input type="submit" value="Сохранить"></form>';
        itemContainer.replaceWith(form);
    });
    $(document).ready(function () {
        $(document).on('submit', '.form-edit',function (e) {
            let form = $(this)
            $.ajax({
                method: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (result) {
                    if (result.status == 'success') {
                        form.replaceWith(' <div class="message-container">' +
                            '<div class="author-name">' + result.message.name + '</div>' +
                            '<div class="message">' + result.message.message + '</div>' +
                            '</div>');
                    }
                    if (result.status == 'error') {
                    }
                }
            });
            e.preventDefault();
        });
    });
})
