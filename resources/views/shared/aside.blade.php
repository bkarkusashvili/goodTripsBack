@php
    $menu = [
        'user' => [
            'title' => 'Users',
            'icon' => 'fas fa-users',
            'role' => true
        ],
        'food' => [
            'title' => 'Foods',
            'icon' => 'fas fa-hamburger'
        ],
        'category' => [
            'title' => 'Food Categories',
            'icon' => 'fas fa-filter'
        ],
        'service' => [
            'title' => 'Services',
            'icon' => 'fas fa-concierge-bell'
        ],
        'city' => [
            'title' => 'Cities',
            'icon' => 'fas fa-globe-europe'
        ],
        'place' => [
            'title' => 'Places',
            'icon' => 'fas fa-map-marker-alt'
        ],
        'hotel' => [
            'title' => 'Hotels',
            'icon' => 'fas fa-hotel'
        ],
        'restaurant' => [
            'title' => 'Restaurants',
            'icon' => 'fas fa-utensils'
        ],
    ];
@endphp

<aside>
    <div class="list-group">
        @foreach ($menu as $key => $item)
            @if (!isset($item['role']) || Auth::user()->isAdmin())
                <a 
                    href="{{route($key.'.index')}}" 
                    class="list-group-item list-group-item-action
                    {{request()->is($key.'*') ? ' active':''}}"
                >
                    <i class="{{$item['icon']}}"></i>    
                    {{$item['title']}}
                </a>
            @endif
        @endforeach
    </div>
</aside>