/** Сущность HighCharts */
const HighChartsJs = {

    /** Селекторы сущности */
    selector: {

        /** Селектор до блока с таблицей графиков */
        chart_block: '.graphs__of__items > div',

        /** Селектор до блока с id предмета */
        item_id_block: '.api-item-detail'
    },

    /** Атрибуты сущности */
    props: {

        /** URL адрес до графиков */
        url: '/get-graphs',

        /** Атрибут с id предмета, для которого надо получить актуальные HighCharts */
        item_id: 'data-item-id'
    },

    /** Метод по ID предмета достает актуальные данные по его продажам из API */
    getGraphs: function()
    {
        /** ID предмета из API */
        let item_id = $(HighChartsJs.selector.item_id_block).attr(HighChartsJs.props.item_id);

        /** Отправляем AJAX запрос на сервак, чтобы получить графики стоимости текущего лута */
        $.ajax({
            url: HighChartsJs.props.url,
            data: {param: param, token : token, id: item_id},
            dataType: 'json',
            success: function(response) {

                /** Определяем переменную для API данных */
                let api_data = response.data.historicalItemPrices;

                /** Массив с ценами */
                prices = [];

                /** Массив с датами */
                categories = [];

                /** В цикле проходим JSON */
                for (let i=0;  i < api_data.length; i++) {

                    /** Пушим в итоговый массив цену */
                    prices.push(api_data[i].price);

                    /** Форматирует дата из миллисекунд */
                    let date = new Date(Number(api_data[i].timestamp));

                    /** Приводим дату к нормальному виду */
                    categories.push(date.toLocaleString())
                }

                /** Обновляем таблицу новыми данными из актуального JSON - цены */
                $(HighChartsJs.selector.chart_block).highcharts().update({
                    series: [{
                        data: prices
                    }]
                });

                /** Обновляем таблицу новыми данными из актуального JSON - даты обновления цен */
                $(HighChartsJs.selector.chart_block).highcharts().update({
                    xAxis: [{
                        categories: categories
                    }]
                });
            },
            error: function(error) {}
        });
    },

    /** События сущности */
    events: function()
    {},

    /** Инициализация сущности */
    init: function()
    {
        /** По загрузке документа, дергаем метод, который через AJAX получит нужные данные */
        this.getGraphs()
    }
};

/** По окончанию загрузки документа */
$(document).ready(function() {

    /** Инициализируем сущность */
    HighChartsJs.init();
});