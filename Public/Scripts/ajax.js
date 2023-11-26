$(document).ready(function (){
    $('#form').on('submit',function (e){
        $.ajax({
            method: "POST",
            url:$(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (result){
                let date = new Date(result.message.date);
                let formattedDate = date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear();
                if(result.status=='success'){
                    $('.reviews-list').prepend('<div class="review-item-container">' +
                        '<button class="dlt-btn">Удалить</button><button class="edit-btn">Изменить</button>'+
                            '<div class="review-item">'+
                                    '<div class="date">'+formattedDate+'</div>' +
                                    '<div class="message-container">' +
                                        '<div class="author-name">'+result.message.name+'</div>' +
                                        '<div class="message">'+result.message.text+'</div>' +
                                    '</div>'+
                            '       </div><button class="save-btn">Сохранить</button></div>'
                    );
                }
                if(result.status=='error'){
                    $('#form .info-box').html('<div class="error">'+result.message+'</div>');
                }
            }
        });
        e.preventDefault();
    });
    $(document).on('click', '.dlt-btn', function (e) {
        let itemContainer = $(this).parent('.review-item-container')
        itemContainer.remove();
        $.ajax({
            method: "POST",
            url: 'main/delete',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (result) {
                console.log(1)
            }
        });
        e.preventDefault();
    });
    $(document).on('click', '.edit-btn', function (e) {
        let itemContainer = $(this).siblings('.review-item').children('.message-container');
        let authorName = itemContainer.children('.author-name').text();
        let message = itemContainer.children('.message').text();
        var form = '<form id="edit-form"><input type="text" name="name" value="' + authorName + '"><br><textarea name="message">' + message + '</textarea><br><input type="submit" value="Сохранить"></form>';
        itemContainer.replaceWith(form);
    });
});
