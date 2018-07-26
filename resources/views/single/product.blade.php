@extends('layouts.shop')
@section('title')
    {{$product->name}} в разделе {{$product->cat->title}}
@endsection
@section('content')
    <div class="content-main__container">
        <div class="product-container">
            <div class="product-container__image-wrap">
                <img src="{{ asset($product->image_url) }}" class="image-wrap__image-product">
            </div>
            <div class="product-container__content-text">
                <div class="product-container__content-text__title">
                    {{$product->name}}
                </div>
                <div class="product-container__content-text__price">
                    <div class="product-container__content-text__price__value">
                        Цена: <b>{{$product->price_rub}}</b>
                        руб
                    </div><a href="{{route('order.create', $product->id)}}" class="btn-1 btn-blue order-create" data-toggle="modal" data-target="#myModal">Купить</a>
                </div>
                <div class="product-container__content-text__description">
                    {{$product->description}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_bottom')
    <div class="line"></div>
    <div class="content-head__container">
        <div class="content-head__title-wrap">
            <div class="content-head__title-wrap__title bcg-title">
                Посмотрите наши товары
            </div>
        </div>
    </div>
    <div class="content-main__container">
        <div class="products-columns">
            @if($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="products-columns__item">
                        <div class="products-columns__item__title-product">
                            <a href="{{route('product.show', $product->id)}}" class="products-columns__item__title-product__link">
                                {{$product->name}}
                            </a>
                        </div>
                        <div class="products-columns__item__thumbnail">
                            <a href="{{route('product.show', $product->id)}}" class="products-columns__item__thumbnail__link">
                                <img src="{{$product->image_url}}" alt="Preview-image" class="products-columns__item__thumbnail__img">
                            </a>
                        </div>
                        <div class="products-columns__item__description">
                            <span class="products-price">
                                {{$product->price_rub}} руб
                            </span>
                            <a href="{{route('order.create', $product->id)}}" class="btn-1 btn-blue order-create" data-toggle="modal" data-target="#myModal">Купить</a>
                        </div>
                    </div>
                @endforeach
            @else
                В БД нет товаров.
            @endif
        </div>
    </div>
    </div>
@endsection
