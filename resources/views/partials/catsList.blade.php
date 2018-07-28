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
