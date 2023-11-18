$(document).ready(function () {
    $('nav a').hover(function () {
        $(this).css('background-color', '#ddd');
        $(this).css('color', 'black');
    }, function () {
        $(this).css('background-color', '#333');
        $(this).css('color', 'white');
    });

    $('.login-btn a').hover(function () {
        $(this).css('background-color', '#45a049');
    }, function () {
        $(this).css('background-color', '#4CAF50');
    });
});
