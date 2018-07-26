@extends('layouts.form')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-w100">
                <div class="card">
                    <div class="card-header">Редактировать товар {{$product->id }}</div>
                    @if($cats->isNotEmpty())
                        <div class="card-body">
                            <form method="POST" action="{{ route('product.update', $product->id) }}" aria-label="{{__('Update Product') }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Название товара') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value = "{{$product->name}}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cat" class="col-md-4 col-form-label text-md-right">{{ __('Выберите категорию товара') }}</label>

                                    <div class="col-md-6">
                                        <select name = "cat_id" id="cat">
                                            <option value="">&nbsp;</option>
                                            @foreach($cats as $cat)
                                                <option value="{{$cat->id}}" {{($cat->id === $product->cat_id) ? 'selected' : ''}}>
                                                    {{$cat->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Изображение товара') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" accept="image/*">

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание товара') }}</label>

                                    <div class="textarea-row">
                                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} textarea" name="description" required autofocus>
                                        {{$product->description}}
                                        </textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Цена (в руб.)') }}</label>

                                    <div class="col-md-6">
                                        <input id="price" type="number" class="form-control{{ $errors->has('price_rub') ? ' is-invalid' : '' }}" name="price_rub" value="{{$product->price_rub}}" required autofocus>

                                        @if ($errors->has('price_rub'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price_rub') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Количество') }}</label>

                                    <div class="col-md-6">
                                        <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{$product->quantity}}" required autofocus>

                                        @if ($errors->has('quantity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{__('Записать в БД') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="row justify-content-center align-items-end">
                            <p> В БД нет категорий.</p>
                            <a href="{{route('cat.create')}}" class="btn btn-success ml-3">Создать категорию</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
