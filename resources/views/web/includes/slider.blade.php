<!-- Banner -->
@php
$product = App\Models\Product::where('main_slider', 1)
    ->orderBy('id', 'desc')
    ->first();
if ($product->discount != null) {
    $newPrice = $product->price - $product->price * ($product->discount / 100);
}
@endphp
<div class="banner">
    <div class="banner_background" style="background-image:url({{ asset('web/images/banner_background.jpg') }})">
    </div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img src="{{ asset("uploads/$product->image_one") }}" style="width:500px; height:350px;"></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">{{ $product->name }}</h1>
                    @if ($product->discount == null)
                        <div class="banner_price">{{ $product->price }}</div>
                    @else
                        <div class="banner_price"><span>{{ $product->price }}</span>{{ $newPrice }}</div>
                    @endif
                    <div class="banner_product_name">{{ $product->brand->name }}</div>
                    <div class="button banner_button"><a href="{{ url("web/product/details/$product->id") }}">Shop
                            Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
