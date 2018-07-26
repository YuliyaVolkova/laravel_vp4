'use strict';
function init(){
    $('a.order-create').click(function () {

        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
        }).done(function (data) {

            $('form#storeOrder input[name="email"]').val(data.email);

            const form = $('form#storeOrder');
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
                }).done(function() {
                   return window.location.pathname = '/orders/show';
                }).fail(function() {
                    return window.location.pathname = '/login';
                });
            });
        }).fail(function() {
            return window.location.pathname = '/login';
        });
    });
}
window.onload = init;
