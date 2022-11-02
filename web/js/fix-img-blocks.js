/*** Фиксим проблемы изображений превью в справочнике лута при рендеринге ***/
function Fiximg() {

    $( ".loot-image" ).each(function( index ) {
        if($(this).height() > 129 && $(this).closest('.item-loot').find('.loot-description').height() <= $(this).height()) {
            var calc = $(this).height() - 129;

           var heightParent = $(this).closest('.item-loot').height();
            $(this).closest('.item-loot').css({'height': heightParent+calc+80})
        }
    })
}

/** Таймаут, для прогрузки всех изображений **/
setTimeout(Fiximg, 650);