<div class="card shadow-sm">
    <svg class="bd-placeholder-img card-img-top" width="100%" height="125"
         xmlns="http://www.w3.org/2000/svg" role="img"
         aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
         focusable="false">
        <title>{{ $title ?? "" }}</title>
        <rect width="100%" height="100%" fill="#55595c"/>
        <text x="50%" y="50%" fill="#eceeef" dy=".3em">
            {{ $sku ?? "" }}
        </text>
    </svg>
    <div class="card-body">
        <p class="card-text h6">{{ $title ?? "" }}</p>
        <p class="card-text">{!! $details ?? "" !!}</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="{{ $url }}" class="btn btn-sm btn-outline-secondary">
                    {{ __("words.view-product") }}
                </a>
            </div>
        </div>
    </div>
</div>
