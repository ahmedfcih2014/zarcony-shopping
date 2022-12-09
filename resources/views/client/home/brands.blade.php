<div class="text-center mb-3 h5">
    Shopping By Brand
</div>
<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        @foreach($brands as $brand)
            <div class="swiper-slide">
                <x-client.brand-card
                    name="{{ $brand->small_name }}"
                    url="{{ route('client.brands.products', ['brand' => $brand]) }}"
                />
            </div>
        @endforeach
    </div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
<div class="text-end mb-3 h5">
    <a style="color: #525252" href="{{ route('client.brands.list') }}">More Brands</a>
</div>
