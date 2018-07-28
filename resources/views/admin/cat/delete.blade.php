@extends('layouts.form')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="form-w100">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('admin.index')}}" class="btn btn-primary">Вернуться назад</a>
                        <a href="{{route('cat.edit', $cat->id)}}" class="btn btn-default">Редактировать</a>
                    </div>
                    @if($cat !== null)
                    <div class="card-header">Удаление категории  {{ $cat->title }}</div>
                    @if(!empty($product))
                         невозможно, категория не пуста, удалите сначала товар ({{$product->name}})
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('cat.destroy', $cat->id) }}" aria-label="{{ __('Delete') }}">
                            @csrf

                            {{ method_field('DELETE') }}

                            <div class="form-group row ml-3">
                                    {{$cat->description}}
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
                    @else
                        <div class="card-header">Категория не найдена</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
