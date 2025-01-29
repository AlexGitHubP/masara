@extends('inc.layout')

@section('content')

<section class='home-slider'>
    <div class="large-container maxHeight">
        <div class='slider-element'>
            <div class='slider-image'>
                <div class='slider-overlay'></div>
                <picture>
                    <source media="(max-width:770px)" srcset="{{secure_asset('img/main-img.jpg')}}">
                    <img src="{{secure_asset('img/main-img.jpg')}}" alt="Main image">
                </picture>
            </div>
            <div class='slider-content'>
                <h1>Descoperă eleganța unică a mobilierului din lemn masiv la Masara.</h1>
                <p>Piese create cu măiestrie pentru a aduce căldura și rafinamentul lemnului în fiecare colț al casei tale.</p>
                <p>Explorează serviciile noastre pentru un spațiu cu adevărat special!</p>
                <a href='{{ route('shop') }}' class='shop-now'>
                    <p>Shop Now</p>
                </a>
            </div>
        </div>
        <a href='' class='arr-circle'>
            <img src="{{asset('img/arr-circle.svg')}}" alt="">
        </a>
    </div>
</section>

<section class='our-collections'>
    <div class="large-container">
        <h2>Produsele MASARA</h2>
        <div class='perfect-flex-hold'>
            @foreach($categoriesMasara as $key => $masaraCategory)
            <div class='collection-box'>
                <div class='collection-item'>
                    <a href='{{ $masaraCategory->nice_url }}' class='collection-image'>
                        <picture>
                            <source media="(max-width:770px)" srcset="{{ $masaraCategory->img }}">
                            <img src="{{ $masaraCategory->img }}" alt="Collection image">
                        </picture>
                    </a>
                    <div class='collection-content'>
                        <a href="{{ $masaraCategory->nice_url }}">{{ $masaraCategory->category_name }}</a>
                        <a href="{{ $masaraCategory->nice_url }}" class='collection-arrow'>
                            <svg viewBox="0 0 108 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M107.593 7.94084C107.944 7.58937 107.944 7.01952 107.593 6.66805L101.865 0.940482C101.514 0.589011 100.944 0.589011 100.592 0.940482C100.241 1.29195 100.241 1.8618 100.592 2.21327L105.684 7.30444L100.592 12.3956C100.241 12.7471 100.241 13.3169 100.592 13.6684C100.944 14.0199 101.514 14.0199 101.865 13.6684L107.593 7.94084ZM0.713257 8.20444H106.956V6.40444H0.713257V8.20444Z" fill="#909090"/>
                            </svg>
                        </a>
                    </div>
                </div><!--collection-item-->
            </div>
            @endforeach
        </div><!--perfect-flex-hold-->
        <div class='collections-hold'>
            @foreach($subcategoriesMasara as $key => $masaraSubcategory)
            <div class="collections-element">
                <div class='collection-item'>
                    <a href='{{ $masaraSubcategory->nice_url }}' class='collection-image'>
                        <picture>
                            <source media="(max-width:770px)" srcset="{{ $masaraSubcategory->img }}">
                            <img src="{{ $masaraSubcategory->img }}" alt="Collection image">
                        </picture>
                    </a>
                    <div class='collection-content'>
                        <a href="{{ $masaraSubcategory->nice_url }}">{{ $masaraSubcategory->subcategory_name }}</a>
                        <a href="{{ $masaraSubcategory->nice_url }}" class='collection-arrow'>
                            <svg viewBox="0 0 108 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M107.593 7.94084C107.944 7.58937 107.944 7.01952 107.593 6.66805L101.865 0.940482C101.514 0.589011 100.944 0.589011 100.592 0.940482C100.241 1.29195 100.241 1.8618 100.592 2.21327L105.684 7.30444L100.592 12.3956C100.241 12.7471 100.241 13.3169 100.592 13.6684C100.944 14.0199 101.514 14.0199 101.865 13.6684L107.593 7.94084ZM0.713257 8.20444H106.956V6.40444H0.713257V8.20444Z" fill="#909090"/>
                            </svg>
                        </a>
                    </div>
                </div><!--collection-item-->
            </div><!--collections-element-->
            @endforeach
        </div>
    </div>
</section>

<section class='our-collections'>
    <div class="large-container">
        <h2>Produse designer</h2>
        <div class='perfect-flex-hold'>
            @foreach($categoriesDesigner as $key => $designerCategory)
                <div class='collection-box'>
                    <div class='collection-item'>
                        <a href='{{ $designerCategory->nice_url }}' class='collection-image'>
                            <picture>
                                <source media="(max-width:770px)" srcset="{{ $designerCategory->img }}">
                                <img src="{{ $designerCategory->img }}" alt="Collection image">
                            </picture>
                        </a>
                        <div class='collection-content'>
                            <a href="{{ $designerCategory->nice_url }}">{{ $designerCategory->category_name }}</a>
                            <a href="{{ $designerCategory->nice_url }}" class='collection-arrow'>
                                <svg viewBox="0 0 108 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M107.593 7.94084C107.944 7.58937 107.944 7.01952 107.593 6.66805L101.865 0.940482C101.514 0.589011 100.944 0.589011 100.592 0.940482C100.241 1.29195 100.241 1.8618 100.592 2.21327L105.684 7.30444L100.592 12.3956C100.241 12.7471 100.241 13.3169 100.592 13.6684C100.944 14.0199 101.514 14.0199 101.865 13.6684L107.593 7.94084ZM0.713257 8.20444H106.956V6.40444H0.713257V8.20444Z" fill="#909090"/>
                                </svg>
                            </a>
                        </div>
                    </div><!--collection-item-->
                </div>
            @endforeach
        </div><!--perfect-flex-hold-->
        <div class='collections-hold'>
            @foreach($subcategoriesDesigner as $key => $designerSubcategory)
                <div class="collections-element">
                    <div class='collection-item'>
                        <a href='{{ $designerSubcategory->nice_url }}' class='collection-image'>
                            <picture>
                                <source media="(max-width:770px)" srcset="{{ $designerSubcategory->img }}">
                                <img src="{{ $designerSubcategory->img }}" alt="Collection image">
                            </picture>
                        </a>
                        <div class='collection-content'>
                            <a href="{{ $designerSubcategory->nice_url }}">{{ $designerSubcategory->subcategory_name }}</a>
                            <a href="{{ $designerSubcategory->nice_url }}" class='collection-arrow'>
                                <svg viewBox="0 0 108 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M107.593 7.94084C107.944 7.58937 107.944 7.01952 107.593 6.66805L101.865 0.940482C101.514 0.589011 100.944 0.589011 100.592 0.940482C100.241 1.29195 100.241 1.8618 100.592 2.21327L105.684 7.30444L100.592 12.3956C100.241 12.7471 100.241 13.3169 100.592 13.6684C100.944 14.0199 101.514 14.0199 101.865 13.6684L107.593 7.94084ZM0.713257 8.20444H106.956V6.40444H0.713257V8.20444Z" fill="#909090"/>
                                </svg>
                            </a>
                        </div>
                    </div><!--collection-item-->
                </div><!--collections-element-->
            @endforeach
        </div>
    </div>
</section>

<section class='top-products'>
    <div class="large-container">
        <h2>Top produse cumpărate</h2>
        <div class='homepage-products'>
            <div class="swiper-wrapper">
                @foreach ($topProducts as $product)
                <div class='product-element swiper-slide'>
                    <div class='product-item'>
                        <a href='{{$product->detail->main_url}}' class='product-image'>
                            <picture>
                                <source media="(max-width:770px)" srcset="{{$product->detail->mainImg}}">
                                <img src="{{$product->detail->mainImg}}" alt="Product image">
                            </picture>
{{--                            <span class='fav-btn'>--}}
{{--                                <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>--}}
{{--                                    <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
                            <span class='new-tag'>
                                <p>NOU!</p>
                            </span>
                        </a>
                        <div class='product-content'>
                            <div class='product-content-top'>
                                <a href="{{$product->detail->main_url}}">{{$product->detail->name}}</a>
                                <div class='product-list-price'>
                                    <p>{{$product->detail->price}} lei</p>
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

<section class='top-designers'>
    <div class='large-container'>
        <h2>Designeri</h2>
        <h3 class='centered'>Colaborăm cu o echipă diversificată de designeri talentați pentru a aduce la viață viziuni unice. Folosim cu pasiune și dedicare lemn de cea mai înaltă calitate, selectat cu grijă pentru a asigura durabilitate și rafinament în fiecare detaliu.</h3>
        <div class='homepage-designers'>
            <div class="swiper-wrapper">
                @foreach ($topDesigners as $designer)
                <div class='designer-element swiper-slide'>
                    <a href='{{$designer->mainUrl}}' class='designer-item'>
                        <div class='designer-overlay'></div>
                        <div class='designer-image'>
                            <picture>
                                <source media="(max-width:770px)" srcset="{{$designer->image}}">
                                <img src="{{$designer->image}}" alt="Designer image: {{$designer->name}} {{$designer->surname}}">
                            </picture>
                        </div>
                        <div class='designer-list-content'>
                            <p>Designer Interior @ Good Design </p>
                            <p>{{$designer->name}} {{$designer->surname}}</p>
                        </div>
                    </a>
                </div><!--designer-element-->
                @endforeach




            </div><!--swiper-wrapper-->
        </div><!--homepage-designers-->
        <div class='more-products-hold'>
            <a href="{{ route('designers.list') }}">Vezi toți designerii</a>
        </div>
        <div class='scrollbar-hint'>
            <p><img src="{{url('img/two-arrows.svg')}}" alt="">Trage pentru a vedea întreaga selecție</p>
        </div>
    </div>
</section>

<section class='mood-section'>
    <div class='large-container maxHeight relative'>
        <div class='mood-overlay'></div>
        <div class='mood-img'>
            <picture>
                <source media="(max-width:770px)" srcset="{{url('img/mood.jpg')}}">
                <img src="{{url('img/mood.jpg')}}" alt="Main image">
            </picture>
        </div>
        <div class='mood-constrain'>
            <h2>La Masara, nu facem doar mobilier, ci construim experiențe autentice pentru casele tale.</h2>
            <p>Suntem o echipă pasionată și diversă de meșteri și designeri, uniți de dragostea pentru creație și atenția la detalii a produselor din lemn masiv. Calitatea este esențială în fiecare aspect al activității noastre. Fiecare piesă reflectă nu doar măiestria noastră, ci și angajamentul nostru față de durabilitate și finețea designului.</p>
            <div class='benefits-flex'>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Calitate superioară</h3>
                    <p>Ne angajăm să folosim lemn de cea mai înaltă calitate și să aplicăm standarde riguroase în procesul de fabricație, asigurând produse durabile și de încredere.</p>
                </div>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Versatilitate</h3>
                    <p>Avem abilitatea de a oferi mobilier versatil, adaptabil la diverse nevoi și stiluri de viață, aducând practicitate și funcționalitate în fiecare proiect.</p>
                </div>
                <div class='benefits-element'>
                    <div class='benefits-img'>
                        <img src="{{url('img/benefit1.png')}}" alt="">
                    </div>
                    <h3>Durabilitate garantată</h3>
                    <p>Ne dedicăm oferirii de produse durabile, construite pentru a rezista în timp și a aduce satisfacție pe termen lung clienților noștri.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
