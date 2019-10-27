@php
    $menu = [
        'user' => [
            'title' => 'Users',
            'icon' => 'fas fa-users'
        ],
        'food' => [
            'title' => 'Foods',
            'icon' => 'fas fa-hamburger'
        ],
    ];
@endphp

<aside>
    <div class="list-group">
        @foreach ($menu as $key => $item)
            <a 
                href="{{route($key.'.index')}}" 
                class="list-group-item list-group-item-action
                {{request()->is($key.'*') ? ' active':''}}"
            >
                <i class="{{$item['icon']}}"></i>    
                {{$item['title']}}
            </a>
        @endforeach
    </div>
</aside>