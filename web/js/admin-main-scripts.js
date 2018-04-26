$(document).ready(function() {

    /*** Скрываем в админку спустя время - учтеные данные авторизованного пользователя ***/
    setTimeout(function () {
        $('.col-lg-12.auth-info.relative').fadeOut();
    }, 15000);

    /*** Обработка клика по крестику закрывающему информацию об авторизованном пользователе ***/
    $('.exit').click(function() {
        $('.col-lg-12.auth-info.relative').fadeOut();
    });

});

