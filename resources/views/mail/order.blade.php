<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Cooбщение с сайта MediaShop
        </div>
        <h5>Сформирован новый заказ: №  {{ $order->id }}</h5>
        <div class="links">
            Email пользователя: {{ $order->user->email }}
        </div>
        <div class="links">
            Имя пользователя: {{ $order->user->name }}
        </div>
        <div class="links">
            Сообщение пользователя: {{$mes}}
        </div>
        <div class="links">
            Выбран товар: {{$order->product_id}}
        </div>
        <div class="links">
            Название товара: {{ $order->product->name }}
        </div>
        <div class="links">
            Цена товара (руб.): {{ $order->product->price_rub }}
        </div>
    </div>
</div>
</body>
</html>
