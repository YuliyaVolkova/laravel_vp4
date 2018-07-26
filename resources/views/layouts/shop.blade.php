<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>main - ГеймсМаркет</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js", type="text/javascript"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>
<body>
<div class="main-wrapper">
    <header class="main-header">
        <div class="logotype-container">
            <a href="#" class="logotype-link">
                <img src="{{asset('img/logo.png')}}" alt="Логотип"></a></div>
        <nav class="main-navigation">
            <ul class="nav-list">
                <li class="nav-list__item"><a href="/" class="nav-list__item__link">Главная</a></li>
                <li class="nav-list__item"><a href="{{route('orders.show')}}" class="nav-list__item__link">Мои заказы</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">Новости</a></li>
                <li class="nav-list__item"><a href="#" class="nav-list__item__link">О компании</a></li>
            </ul>
        </nav>
        <div class="header-contact">
            <div class="header-contact__phone">
                <a href="#" class="header-contact__phone-link">Телефон: 33-333-33</a>
            </div>
        </div>
        <div class="header-container">
            <div class="payment-container">
                <div class="payment-basket__status">
                    <div class="payment-basket__status__icon-block">
                        <a class="payment-basket__status__icon-block__link">
                            <i class="fa fa-shopping-basket"></i>
                        </a>
                    </div>
                    <div class="payment-basket__status__basket">
                        <span class="payment-basket__status__basket-value">0</span>
                        <span class="payment-basket__status__basket-value-descr">товаров</span>
                    </div>
                </div>
            </div>
            <div class="authorization-block">
                <!-- Authentication Links -->
                @guest
                    <a href="{{ route('register') }}" class="authorization-block__link">Регистрация</a>
                    <a href="{{ route('login') }}" class="authorization-block__link">Войти</a>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="authorization-block__link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </header>
    <div class="middle">
        <div class="sidebar">
            <div class="sidebar-item">
                <div class="sidebar-item__title">Категории</div>
                <div class="sidebar-item__content">
                    <ul class="sidebar-category">
                        @if($cats->isNotEmpty())
                            @foreach ($cats as $cat)
                                <li class="sidebar-category__item">
                                    <a href="{{route('cat.show', $cat->id)}}" class="sidebar-category__item__link">
                                        {{$cat->title}}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="sidebar-category__item">
                                <a href="/" class="sidebar-category__item__link">Все</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="sidebar-item">
                <div class="sidebar-item__title">Последние новости</div>
                <div class="sidebar-item__content">
                    <div class="sidebar-news">
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="{{asset('img/cover/game-2.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a>
                            </div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="{{asset('img/cover/game-1.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a>
                            </div>
                        </div>
                        <div class="sidebar-news__item">
                            <div class="sidebar-news__item__preview-news">
                                <img src="{{asset('img/cover/game-4.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image">
                            </div>
                            <div class="sidebar-news__item__title-news">
                                <a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="content-top">
                <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты
                </div>
                <div class="slider">
                    <img src="{{asset('img/slider.png')}}" alt="Image" class="image-main"></div>
            </div>
            <div class="content-middle">
                <div class="content-head__container">
                    <div class="content-head__title-wrap">
                        <div class="content-head__title-wrap__title bcg-title">@yield('title')</div>
                    </div>
                    <div class="content-head__search-block">
                        <div class="search-container">
                            <form method="POST" action="{{route('products.search')}}" class="search-container__form">
                                @csrf

                                <input type="search" name="q" class="search-container__form__input">
                                <button type="submit" class="search-container__form__btn">search</button>
                            </form>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
            <div class="content-bottom">@yield('content_bottom')</div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer__footer-content">
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
            <div class="footer__footer-content__main-content">
                <p>
                    Интернет-магазин компьютерных игр ГЕЙМСМАРКЕТ - это
                    онлайн-магазин игр для геймеров, существующий на рынке уже 5 лет.
                    У нас широкий спектр лицензионных игр на компьютер, ключей для игр - для активации
                    и авторизации, а также карты оплаты (game-card, time-card, игровые валюты и т.д.),
                    коды продления и многое друго. Также здесь всегда можно узнать последние новости
                    из области онлайн-игр для PC. На сайте предоставлены самые востребованные и
                    актуальные товары MMORPG, приобретение которых здесь максимально удобно и,
                    что немаловажно, выгодно!
                </p>
            </div>
        </div>
        <div class="footer__social-block">
            <ul class="social-block__list bcg-social">
                <li class="social-block__list__item">
                    <a href="#" class="social-block__list__item__link">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li class="social-block__list__item">
                    <a href="#" class="social-block__list__item__link">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li class="social-block__list__item">
                    <a href="#" class="social-block__list__item__link">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Заказ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="POST" id="storeOrder" action="" aria-label="{{ __('Order') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" name="name" value="" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" name="email" value="" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-4 col-form-label text-md-right">{{ __('Можете оставить сообщение') }}</label>

                        <div class="col-md-6">
                            <textarea id="message"  name="message">
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">Оставьте свои данные, наш менеджер свяжется с вами в течение часа</div>
                    </div>
                </div>

            <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" >Заказать</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>