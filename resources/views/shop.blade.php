@extends('layouts.shop')
@section('title')
    Последние товары
@endsection
@section('content')
    <div class="content-main__container">
        <div class="products-columns">
            @if($products->isNotEmpty())
                @include('partials.productsLoop')
            @else
                В БД нет товаров.
            @endif
        </div>
    </div>
    {{ $products->links('pagination.main-pages') }}
@endsection
