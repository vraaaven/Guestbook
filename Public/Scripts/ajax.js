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
                    $('.reviews-list').prepend('<div class="review-item">'+
                            '<table>'+
                                '<tr>' +
                                    '<td><div class="author-name">'+result.message.name+'</div></td>' +
                                    '<td><div class="date">'+formattedDate+'</div></td>' +
                                '</tr>'+
                                '<tr>'+
                                    '<td><div class="message">'+result.message.text+'</div></td>'+
                                '</tr>' +
                            '</table>' +
                        '</div>'
                    );
                }
                if(result.status=='error'){
                    $('#form .info-box').html('<div class="error">'+result.message+'</div>');
                }
            }
        });
        e.preventDefault();
    });
});