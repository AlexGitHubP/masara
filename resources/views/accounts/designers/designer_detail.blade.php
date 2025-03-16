@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designer-detail-page'>
    <div class='large-container maxHeight'>

        <div class='designer-detail-page-hold'>
            <div class='perfect-flex-hold maxHeight nospacing'>
                <div class='perfect-left maxHeight baseBackground'>
                    <div class='designer-detail-content'>
                        <h1>{{ $designer->name }} {{ $designer->surname }}</h1>
                        <p>{{ $designer->description }}</p>
{{--                        <a href="">Vezi toate produsele</a>--}}
{{--                        <div class='designNavhold perfect-flex-hold vertical-align-center-flex '>--}}
{{--                            <div class='perfect-left'>--}}
{{--                                <p>Treci prin produsele designerului si alege ce iti place!</p>--}}
{{--                            </div>--}}
{{--                            <div class='perfect-right centered'>--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <a href="">--}}
{{--                                            <img src="{{url('img/nav-left.svg')}}" alt="">--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="">--}}
{{--                                            <img src="{{url('img/nav-right.svg')}}" alt="">--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class='perfect-right maxHeight'>
                    <div class='dezImg'>
                        <img src="{{url('img/dezImg.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section class='products-list-designers'>
    <div class='large-container'>
        <div class='products-list-designers-flex'>

            @if(count($designerProducts) > 0)

                @foreach ($designerProducts as $product)
                    <div class='product-element' data-id='{{$product->id}}' data-name='{{$product->name}}' data-main_url='{{$product->main_url}}' data-mainimg='{{$product->mainImg}}' data-price='{{$product->price}}' data-amount='1'>
                        <div class='product-item'>
                            <a href='{{$product->main_url}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url($product->mainImg)}}">
                                    <img src="{{url($product->mainImg)}}" alt="Product image">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class='new-tag'>
                                    <p>NOU!</p>
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="{{$product->main_url}}">{{$product->name}}</a>
                                    <div class='product-list-price'>
                                        <p>{{$product->price}} lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="" class='quickAddToCart'>Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->
                @endforeach
            @else
                <p>Acest designer nu are produse adaugate momentan.</p>
            @endif

        </div>
    </div>
</section>


<section class='join-us noMarginBottom'>
    <div class='small-container'>
        <div class='join-us-flex'>
            <div class='join-us-left'>
                <h2>Vrei sa faci parte din echipa noastra de designeri?</h2>
            </div>
            <div class='join-us-right'>
                <p>Ești invitat să faci parte din echipa noastră de designeri la Masara! Căutăm talente inovatoare care să aducă prospetime și inspirație în lumea mobilierului. Alătură-te nouă și împreună să creăm piese memorabile, unde fiecare design devine o expresie a talentului și stilului tău distinct. Fă primul pas către o colaborare creativă și trimite-ne portofoliul tău astăzi. Împreună, putem da viață la idei și transforma spațiile în opere autentice de artă funcțională!</p>
                <a href="{{ route('contact') }}" class='general-btn'>Trimite mesaj</a>
            </div>
        </div>
    </div>
</section>


<section class='top-designers'>
    <div class='large-container'>
        <h2>Alți designeri</h2>
        <h3 class='centered'>Colaborăm cu o echipă diversificată de designeri talentați pentru a aduce la viață viziuni unice. Folosim cu pasiune și dedicare lemn de cea mai înaltă calitate, selectat cu grijă pentru a asigura durabilitate și rafinament în fiecare detaliu.</h3>
        @if(count($recommendedDesigners) > 0)
        <div class='homepage-designers'>
            <div class="swiper-wrapper">
                @foreach($recommendedDesigners as $key => $designer)
                    <div class='designer-element swiper-slide'>
                        <a href='{{ $designer->nice_url }}' class='designer-item'>
                            <div class='designer-overlay'></div>
                            <div class='designer-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{ $designer->image }}">
                                    <img src="{{ $designer->image }}" alt="Designer image">
                                </picture>
                            </div>
                            <div class='designer-list-content'>
                                <p>Designer Interior @ Good Design </p>
                                <p>{{ $designer->name }} {{ $designer->surname }}</p>
                            </div>
                        </a>
                    </div><!--designer-element-->
                @endforeach
            </div><!--swiper-wrapper-->
        </div><!--homepage-designers-->
        @else
            <p class="centered">Momentan nu există alte conturi de designer.</p>
        @endif
        <div class='scrollbar-hint'>
            <p><img src="{{url('img/two-arrows.svg')}}" alt="">Trage pentru a vedea întreaga selecție</p>
        </div>
    </div>
</section>


@stop
