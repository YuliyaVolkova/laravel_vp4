@extends('layouts.form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-w100">
                <div class="card">
                    <div class="card-header">Редактирование категории   {{$cat->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cat.update', $cat->id) }}" aria-label="{{ __('Update') }}">
                            @csrf

                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Название категории') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" required autofocus value="{{$cat->title}}">

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Описание категории') }}</label>

                                <div class="textarea-row">
                                    <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }} textarea" name="description" value = "" required autofocus>
                                        {{$cat->description}}
                                    </textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Сохранить в БД') }}
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
