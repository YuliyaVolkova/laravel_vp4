<div class="random-product-container">
    <div class="random-product-container__head">Случайный товар</div>
    <div class="random-product-container__content">
        <div class="item-product">
            <div class="item-product__title-product">
                <a href="{{route('product.show', $productRandom->id)}}" class="item-product__title-product__link">
                    {{ $productRandom->name }}
                </a>
            </div>
            <div class="item-product__thumbnail">
                <a href="{{route('product.show', $productRandom->id)}}" class="item-product__thumbnail__link">
                    <img src="{{asset($productRandom->image_url)}}" alt="Preview-image" class="item-product__thumbnail__link__img">
                </a>
            </div>
            <div class="item-product__description">
                <div class="item-product__description__products-price">
                    <span class="products-price">{{$productRandom->price_rub}} руб</span>
                </div>
                <div class="item-product__description__btn-block">
                    <a href="{{route('order.create', $productRandom->id)}}" class="btn-1 btn-blue order-create" data-toggle="modal" data-target="#myModal">Купить</a>
                </div>
            </div>
        </div>
    </div>
</div>
