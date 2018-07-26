@extends('layouts.admin')
@section('content')
    <div class="tab-content ml-3">
        <div id="home" class="tab-pane fade">
            <h3>Admin-панель</h3>
        </div>
        <div id="menu1" class="tab-pane fade active show">

            <h1 class="mb-3">Категории товаров</h1>
            <a href="{{route('cat.create')}}" class="btn btn-success mb-3">Добавить категорию</a>

            <table class="table table-bordered">
                <tr>
                    <td>Название категории</td>
                    <td>Описание</td>
                    <td>Управление</td>
                </tr>
                @if($cats->isNotEmpty())
                    @foreach ($cats as $cat)
                     <tr>
                        <td>{{$cat->title}}</td>
                        <td>{{$cat->description}}</td>
                        <td>
                            <a href="{{route('cat.edit', ['cat_id' => $cat->id])}}" class="btn btn-default">Редактировать</a>
                            <span>/</span>
                            <a href="{{route('cat.delete', ['cat_id' => $cat->id])}}" class="btn btn-danger">Удалить</a>
                        </td>
                        </tr>
                    @endforeach
                @else
                    В БД нет записей.
                @endif
            </table>

        </div>
        <div id="menu2" class="tab-pane fade">

            <h1 class="mb-3">Товары</h1>
            <a href="{{route('product.create')}}" class="btn btn-success mb-3">Новый товар</a>

            <table class="table table-bordered">
                <tr>
                    <td>Название товара</td>
                    <td>Категория</td>
                    <td>Изображение</td>
                    <td>Описание</td>
                    <td>Цена</td>
                    <td>Количество</td>
                    <td>Управление</td>
                </tr>
                @if($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->cat->title}}</td>
                            <td>
                                @if(!empty($product->image_url))
                                    <img src="{{$product->image_url}}">
                                @else
                                    Изображение не загружено
                                @endif
                            </td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price_rub}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>
                                <a href="{{route('product.edit', ['product_id' => $product->id])}}" class="btn btn-default">Редактировать</a>
                                <span>/</span>
                                <a href="{{route('product.delete', ['product_id' => $product->id])}}" class="btn btn-danger">Удалить</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    В БД нет записей.
                @endif
            </table>

        </div>
        <div id="menu3" class="tab-pane fade">
            <h1 class="mb-3">Заказы</h1>

            <table class="table table-bordered">
                <tr>
                    <td>Id заказа</td>
                    <td>Имя покупателя</td>
                    <td>Email покупателя</td>
                    <td>Id товара</td>
                    <td>Название товара</td>
                    <td>Цена</td>
                    <td>Дата заказа</td>
                </tr>
                @if($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->user->email}}</td>
                            <td>{{$order->product_id}}</td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->product->price_rub}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                    @endforeach
                @else
                    В БД нет записей.
                @endif
            </table>

        </div>
    </div>
@endsection
