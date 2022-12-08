<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="height: 100vh">
    <a href="{{ route("admin.home") }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <i style="font-size: 24px" class="fa fa-home"></i>
        <span class="fs-4">
            {{ __("words.dashboard") }}
        </span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route("admin.home") }}"
               class="nav-link text-white {{ request()->routeIs('admin.home') ? "active" : "" }}"
               aria-current="page">
                <i class="fa fa-home"></i>
                {{ __("words.dashboard") }}
            </a>
        </li>
        <li>
            <a href="{{ route("admin.brands.index") }}"
               class="nav-link text-white {{ request()->routeIs('admin.brands.*') ? "active" : "" }}">
                <i class="fa fa-flag"></i>
                {{ __("words.brands") }}
            </a>
        </li>
        <li>
            <a href="{{ route("admin.products.index") }}"
               class="nav-link text-white {{ request()->routeIs('admin.products.*') ? "active" : "" }}">
                <i class="fa fa-table"></i>
                {{ __("words.products") }}
            </a>
        </li>
        <li>
            <a href="{{ route("admin.users.index") }}"
               class="nav-link text-white {{ request()->routeIs('admin.users.*') ? "active" : "" }}">
                <i class="fa fa-users"></i>
                {{ __("words.users") }}
            </a>
        </li>
        <li>
            <a href="{{ route("admin.products.index") }}"
               class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? "active" : "" }}">
                <i class="fa fa-cubes"></i>
                {{ __("words.orders") }}
            </a>
        </li>
    </ul>
    <hr>
</div>
