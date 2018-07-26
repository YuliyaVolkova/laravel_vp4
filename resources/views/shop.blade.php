@extends('layouts.shop')
@section('title')
    Последние товары
@endsection
@section('content')
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
    {{ $products->links('pagination.main-pages') }}
@endsection
