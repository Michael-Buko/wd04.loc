(function() {
    "use strict";

    // custom scrollbar

    $("html").niceScroll({styler:"fb",cursorcolor:"#1ABC9C", cursorwidth: '6', cursorborderradius: '10px', background: '#424f63', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".scrollbar1").niceScroll({styler:"fb",cursorcolor:"rgba(97, 100, 193, 0.78)", cursorwidth: '6', cursorborderradius: '0',autohidemode: 'false', background: '#F1F1F1', spacebarenabled:false, cursorborder: '0'});



    $(".scrollbar1").getNiceScroll();
    if ($('body').hasClass('scrollbar1-collapsed')) {
        $(".scrollbar1").getNiceScroll().hide();
    }

    $('.fromCurr').on('change', function (){
        $('.flagFrom').attr('src', 'https://htmlweb.ru/geo/flags/' + this.value.toLowerCase().substring(0, 2) + '.png');
    })

    $('.toCurr').on('change', function (){
        $('.flagTo').attr('src', 'https://htmlweb.ru/geo/flags/' + this.value.toLowerCase().substring(0, 2) + '.png');
    })

    $('.calculate').on('click', function (event){
        event.preventDefault();

        let fromCurr = 1, toCurr = 1;

        if ($('.fromCurr').val() !== 'BYN') {
            $.ajax({
                url: 'https://www.nbrb.by/api/exrates/rates/' + $('.fromCurr').val(),
                method: 'GET',
                data: {
                    parammode: 2,
                    ondate: $('.dateExchange').val(),
                },
                success: function (response) {
                    $.each(response, function (index, element) {
                        // $('.exchange-rate').text(element);
                        if (index === 'Cur_Scale') {
                            fromCurr /= element;
                        }
                        if (index === 'Cur_OfficialRate') {
                            fromCurr *= element;
                        }
                        console.info(index, element);
                    });
                },
                error: function () {
                    console.log('error')
                }
            });
        };

        if ($('.toCurr').val() !== 'BYN') {
            $.ajax({
                url: 'https://www.nbrb.by/api/exrates/rates/' + $('.toCurr').val(),
                method: 'GET',
                data: {
                    parammode: 2,
                    ondate: $('.dateExchange').val(),
                },
                success: function (response) {
                    $.each(response, function (index, element) {
                        if (index === 'Cur_Scale') {
                            toCurr /= element;
                        }
                        if (index === 'Cur_OfficialRate') {
                            toCurr *= element;
                        }
                        console.info(index, element);
                    });
                    $('.exchange-rate').text(($('.exchangeSum').val() * fromCurr / toCurr).toFixed(2));
                },
                error: function () {
            $('.exchange-rate').text(($('.exchangeSum').val() * fromCurr / toCurr).toFixed(2));
                    console.log('error')
                }
            });
        };

    })

})(jQuery);
