@extends('layouts.shop')
@section('title')
    Игры в разделе
    @if($catTitle !== null)
        {{$catTitle}}
    @else
        'Категория не найдена'
    @endif
@endsection
@section('content')
    <div class="content-main__container">
        <div class="products-category__list">
            @if($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="products-category__list__item">
                        <div class="products-category__list__item__title-product">
                            <a href="{{route('product.show', $product->id)}}">{{ $product->name }}</a>
                        </div>
                        <div class="products-category__list__item__thumbnail">
                            <a href="{{route('product.show', $product->id)}}" class="products-category__list__item__thumbnail__link">
                                <img src="{{asset($product->image_url)}}" alt="Preview-image">
                            </a>
                        </div>
                        <div class="products-category__list__item__description">
                            <span class="products-price">{{ $product->price_rub }} руб.
                            </span>
                            <a href="{{route('order.create', $product->id)}}" class="btn-1 btn-blue order-create" data-toggle="modal" data-target="#myModal">Купить</a>
                        </div>
                    </div>
                @endforeach
            @else
                Сейчас нет товара в выбранной категории.
            @endif
        </div>
    </div>
    {{ $products->links('pagination.main-pages') }}
@endsection
