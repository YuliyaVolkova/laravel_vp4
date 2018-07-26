@extends('layouts.shop')
@section('title')
    Мои заказы
@endsection
@section('content')
    <div class="content-main__container">
        <div class="cart-product-list">
            @if($orders->isNotEmpty())
                @foreach ($orders as $order)
                    <div class="cart-product-list__item">
                        <div class="cart-product__item__product-photo">
                            <img src="{{ asset($order->product->image_url) }}" class="cart-product__item__product-photo__image">
                        </div>
                        <div class="cart-product__item__product-name">
                            <div class="cart-product__item__product-name__content">
                                <a href="#">{{$order->product->name}}</a>
                            </div>
                        </div>
                        <div class="cart-product__item__cart-date">
                            <div class="cart-product__item__cart-date__content">
                                {{$order->created_at}}
                            </div>
                        </div>
                        <div class="cart-product__item__product-price">
                            <span class="product-price__value">
                                {{$order->product->price_rub}} рублей
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                Сделайте ваш первый заказ.
            @endif
        </div>
    </div>
    {{ $orders->links('pagination.main-pages') }}
@endsection
