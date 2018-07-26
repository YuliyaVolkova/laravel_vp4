@extends('layouts.form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-w100">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('admin.index')}}" class="btn btn-primary">Вернуться назад</a>
                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-default">Редактировать</a>
                    </div>
                    <div class="card-header">Удаление товара  {{ $product->id }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.destroy', $product->id) }}" aria-label="{{ __('Delete') }}">
                            @csrf

                            {{ method_field('DELETE') }}

                            <div class="form-group row ml-3">
                                <p>Название:&nbsp;</p>
                                {{$product->name}}
                            </div>
                            <div class="form-group row ml-3">
                                <p>Название категории:&nbsp;</p>
                                {{$product->cat->title}}
                            </div>
                            <div class="form-group row ml-3">
                                <p>Изображение:&nbsp;</p>
                                <img src="{{asset($product->image_url)}}">
                            </div>
                            <div class="form-group row ml-3">
                                <p>Описание:&nbsp;</p>
                                {{$product->description}}
                            </div>
                            <div class="form-group row ml-3">
                                <p>Цена(руб.):&nbsp; </p>
                                {{$product->price_rub}}
                            </div>
                            <div class="form-group row ml-3">
                                <p>Количество:&nbsp;</p>
                                {{$product->quantity}}
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Подтвердить удаление') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
