@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='product-detail-section general-styles'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                @foreach ($breadcrumbs as $breadcrumb)
                <li>
                    <a href="{{url($breadcrumb['url'])}}">{{$breadcrumb['name']}}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class='perfect-flex-hold vertical-align-center-flex'>
            <div class='perfect-left'>
                <div class='product-detail-slider'>
                    <div class='product-detail-img' id='zoomedImage'>
                        <picture>
                            <source media="(max-width:770px)" srcset="{{ $product->mainImg }}">
                            <img src="{{ $product->mainImg }}" alt="Main image">
                        </picture>
                    </div>
                    <div id='zoomContainer'></div>
                </div>
                <div class='swiper productDetailSwiper'>
                    <div class="swiper-wrapper">
                        @foreach ($product->gallery as $galleryImg)
                        <div class='upload-img-hold swiper-slide'>
                            <div class='upload-img-item'>
                                <img src="{{ $galleryImg->file }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class='scrollbar-hold productDetailScroll'>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>

            </div>
            <div class='perfect-right'>
                <div class='prodct-detail-content'>
{{--                    <div class='fav-btn'>--}}
{{--                        <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"></circle>--}}
{{--                            <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
                    <h1>{{$product->name}}</h1>
                    <h2>Creat de “{{$designer}}”</h2>

                    <div class='product-detail-price'>
                        <h3><span>{{$product->price}}</span> lei <span>TVA inclus</span></h3>
                    </div>

                    <div class='product-detail-content-inner'>
                        <a href="{{$mainCategory->category_url}}" target='_blank'>Categoria: "{{$mainCategory->category_name}}"
                            <svg viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.375 15.5H1.625" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.25 1.625L2.75 12.125" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.25 9.3275V1.625H5.5475" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        {!!$product->description!!}
                        <h6>*Livrare in 20 de zile lucrătoare de la confirmarea comenzii.</h6>
                    </div>
                    <div class='addCartHold'>
                        <a href="" class='general-btn add-to-cart-detail' data-endpoint='/addProductToCartSession' data-method='POST' data-form='cartProductForm'>Adaugă în coș</a>
                        <div class='loader'>
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</section>

<section class='detail-separator'></section>

<div class='large-container'>
    <section class='extra-infos'>
        <div class='perfect-flex-hold vertical-align-flex-start'>
            @if($product->product_type != 'masara')
            <div class='perfect-left'>
                <h2>Produsul este compus din:</h2>
                @foreach ($product->components as $componentKey => $componentValue)
                    <div class='attrComponentHold'>
                        <h3>{{ucfirst($componentKey)}}:</h3>
                        @foreach ($componentValue as $k => $v )
                        <div class='attrComponent'>
                            <p>{{ucfirst($k)}}:</p>
                            <ul>
                                @foreach ($v as $kk => $vv )
                                <li>{{$vv}} @php echo ($loop->last) ? '' : ','; @endphp</li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            @endif
            <div class='perfect-right'>
                <h2>Detalii tehnice:</h2>
                {!!$product->description_tech!!}
            </div>
        </div>
    </section>
</div>

<section class='detail-separator'></section>

<section class='mood-section detail-mood'>
    <div class='large-container maxHeight relative'>
        <div class='mood-overlay'></div>
        <div class='mood-img'>
            <picture>
                <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">
                <img src="{{url('img/mood.jpg')}}" alt="Main image">
            </picture>
        </div>
        <div class='mood-constrain'>
            <div class='benefits-flex'>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Beneficiu nume aici</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Beneficiu nume aici</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Beneficiu nume aici</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class='detail-separator'></section>


{{--<section class='clients-images'>--}}
{{--    <div class='large-container'>--}}
{{--        <h2>Poze de la clienți</h2>--}}
{{--        <div class='client-images-flex'>--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--            <div class='client-images-holder'>--}}
{{--                <a href='' class='client-images-element'>--}}
{{--                    <picture>--}}
{{--                        <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">--}}
{{--                        <img src="{{url('img/mood.jpg')}}" alt="Main image">--}}
{{--                    </picture>--}}
{{--                </a>--}}
{{--            </div><!--client-images-holder-->--}}

{{--        </div><!--client-images-flex-->--}}

{{--        <h2>Reviews</h2>--}}
{{--        <div class='perfect-flex-hold review-hold'>--}}
{{--            <div class='perfect-left'>--}}
{{--                <div class='rating-element'>--}}
{{--                    <h3>Andrei Popescu</h3>--}}
{{--                    <div class='star'>--}}
{{--                        <img src="{{url('/img/star.svg')}}" alt="Star image">--}}
{{--                    </div>--}}
{{--                    <p>4.5 stele</p>--}}
{{--                </div>--}}
{{--                <div class='rating-content'>--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class='perfect-right'>--}}
{{--                <div class='rating-element'>--}}
{{--                    <h3>Andrei Popescu</h3>--}}
{{--                    <div class='star'>--}}
{{--                        <img src="{{url('/img/star.svg')}}" alt="Star image">--}}
{{--                    </div>--}}
{{--                    <p>4.5 stele</p>--}}
{{--                </div>--}}
{{--                <div class='rating-content'>--}}
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

{{--<div class='separator-large'></div>--}}
{{--<section class='detail-separator'></section>--}}

<section class='recommended-products'>
    <div class="large-container">
        <h2>Recomandări produse similare</h2>
        <div class='product-detail-recommended-products'>
            <div class="swiper-wrapper">

                @foreach ($recommendedProducts as $recProd)
                    <div class='product-element swiper-slide'>
                        <div class='product-item'>
                            <a href='{{$recProd->detail->main_url}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{$recProd->detail->mainImg}}">
                                    <img src="{{$recProd->detail->mainImg}}" alt="Product image">
                                </picture>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="{{$recProd->detail->main_url}}">{{$recProd->detail->name}}</a>
                                    <div class='product-list-price'>
                                        <p>{{$recProd->detail->price}} lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element swiper-slide-->
                @endforeach
            </div><!--swiper-wrapper-->
        </div>
    </div>
    <div class='scrollbar-hold'>
        <div class="swiper-scrollbar"></div>
    </div>
    <div class='more-products-hold'>
        <a href="">Vezi toate produsele</a>
    </div>
    <div class='scrollbar-hint'>
        <p><img src="{{url('img/two-arrows.svg')}}" alt="">Trage pentru a vedea întreaga selecție</p>
    </div>
</section>
<form method='POST' action='' id='cartProductForm'>
    @csrf
    <input type="hidden" id='id'       name='id'       value='<?php echo $product->id;?>'>
    <input type="hidden" id='name'     name='name'     value='<?php echo $product->name;?>'>
    <input type="hidden" id='main_url' name='main_url' value='<?php echo $product->main_url;?>'>
    <input type="hidden" id='mainImg'  name='mainImg'  value='<?php echo $product->mainImg;?>'>
    <input type="hidden" id='price'    name='price'    value='<?php echo $product->price;?>'>
    <input type="hidden" id='amount'   name='amount'   value='1'>
</form>

@section('scripts')
<script src="{{ asset('js/zoom/js-image-zoom.js') }}" defer></script>
@endsection

@stop
