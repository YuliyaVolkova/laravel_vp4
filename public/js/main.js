'use strict';
function init(){
    $('a.order-create').click(function () {

        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
        }).done(function (data) {
            if (!data) {
                console.log('не получено данных');
                return window.location = '/';
            }
            const form = $('form#storeOrder');
            $('form#storeOrder input[name="email"]').val(data.email);
            $(form).attr('action', `/order/store/${data.product}`);

            $(form).submit(function (e) {
                e.preventDefault();
                const data = $(this).serialize(),
                    method = $(this).attr('method'),
                    action = $(this).attr('action');

                $.ajax({
                    type: method,
                    url: action,
                    data: data
                }).done(function(data) {
                    if (!data) {
                        return window.location = '/login';
                    }
                   return window.location = '/orders/show';
                }).fail(function() {
                    console.log('Error network, повторите запрос');
                });
            });
        }).fail(function() {
            return window.location = '/login';
        });
    });
}
window.onload = init;
