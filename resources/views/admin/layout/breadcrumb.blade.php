<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($links as $link)
            @if($link['is_active'] ?? false)
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $link['name'] }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $link['url'] }}"> {{ $link['name'] }} </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
