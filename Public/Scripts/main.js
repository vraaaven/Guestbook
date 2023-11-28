$(document).ready(function () {
    $('.comment-header').on('click', function () {
        if ($(this).next('.comments-container').is(':visible')) {
            $(this).children('.arrow').html('►');
            $(this).removeClass('active');
            $(this).next('.comments-container').slideUp();
        } else {
            $('.comments-container').slideUp();
            $('.comment-header').removeClass('active');
            $('.arrow').html('►');
            $(this).children('.arrow').html('▼');
            $(this).addClass('active');
            $(this).next('.comments-container').slideDown();
        }
    });
});