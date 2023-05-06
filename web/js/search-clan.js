/**
 * Created by DIR300NRU-ADMIN on 18.10.2018.
 */

/*** Объявляем проверочные токены для Ajax ***/
var param = $('meta[name=csrf-param]').attr("content");
var token = $('meta[name=csrf-token]').attr("content");

/*** Получаем данные о найденных записях и обрабатываем их с помощью событий ***/
$('#clans-searchclan').on('keyup paste',function() {

    var str = $(this).val();
    
    $.ajax({
        url: '/clan/clansearch?q='+str+'',
        method: 'post',
        data: {param: param, token : token, str:str},
        success: function(resp) {
            var data = JSON.parse(resp);
            
            $('.clan-block').remove();
            $('.alert.alert-danger.size-16.margin-top-20').remove();

            if(data.length > 0) {
                $.each(data, function(i) {
                
                    var strdata = '<div class="clan-block">' +
                                        '<h3 class="clan-title">'
                                            +data[i].title+
                                            '<i class="fa fa-check-circle checked-by-admins" title="Клан проверен администрацией сайта"></i>' +
                                        '</h3>'
    
                                        if (data[i].preview == null || data[i].preview=='') {
                                            strdata += '<img class="clan-img" src="/img/qsch.png" alt="Логотип клана отсутствует">'
                                        } else {
                                            strdata += '<img class="clan-img" src="'+data[i].preview+'" alt="'+data[i].title+'">'
                                        }

                                        strdata +='<p class="size-16">'+data[i].description+'</p>'

                                        if (data[i].link == null || data[i].link=='') {
                                            strdata += '<label class="label label-danger">Клан не опубликовал ссылку на сообщество</label><br><br>'
                                        } else {
                                            strdata += '<p class="clan-community-link">Ссылка на сообщество клана: <a class="clan-community-link" href="'+data[i].link+'" rel="nofollow" target="_blank">Перейти в сообщество</a></p>'
                                        }
                    
                                        strdata += '<label class="label label-info date-clan-label">Клан зарегистрирован: '+data[i].date_create+'</label>'+
                                    '</div>';
                    
                    $('.col-lg-12.col-md-12.col-sm-12.col-xs-12.clans-content').append(strdata);
                });
            } else {
                $('.col-lg-12.col-md-12.col-sm-12.col-xs-12.clans-content').append('<p class="alert alert-danger size-16 margin-top-20 clans-not-found"><b>Кланы соотвествующие запросу не были найдены.</b></p>');
            }
        }
    });
});