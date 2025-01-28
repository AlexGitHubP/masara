@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='cart-section paymentSummary'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('/cos/produse.html')}}">Coș/produse</a>
                </li>
                <li>
                    <a href="{{url('/cos/detalii-comanda.html')}}">Detalii comandă</a>
                </li>
                <li class='selected'>
                    <a href="{{url('/cos/checkout.html')}}">Sumar comandă/checkout</a>
                </li>
                <li>
                    <a href="{{url('/cos/comanda-plasata.html')}}">Comandă plasată</a>
                </li>
            </ul>
        </div>



        <div class='summaryHold'>
        <h2>Sumar comandă</h2>
        <div class="cart-product-holder">
            <div class="cart-product-holder">
                @if(isset($cartInfos['cartItems']) && !empty($cartInfos['cartItems']))

                @foreach ($cartInfos['cartItems'] as $key => $cartItem)
                <div class='cart-element' data-id='{{$cartItem['id']}}'>
                        <div class='cart-product-img-hold'>
                            <a href='{{$cartItem['main_url']}}' class='cart-product-img'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{$cartItem['mainImg']}}">
                                    <img src="{{$cartItem['mainImg']}}" alt="Cart img: {{$cartItem['name']}}">
                                </picture>
                            </a>
                        </div>
                        <div class='cart-product-content'>
                            <a href='{{$cartItem['main_url']}}'>{{$cartItem['name']}}</a>
                            <div class='cart-product-price'>
                                <p><span>{{$cartItem['price']}}</span> Lei</p>
                            </div>
                        </div>
                        <div class='cart-product-detais' data-pid='{{$cartItem['id']}}' data-amount='{{$cartItem['amount']}}' data-name='{{$cartItem['name']}}' data-main_url='{{$cartItem['main_url']}}' data-mainimg='{{$cartItem['mainImg']}}' data-price='{{$cartItem['price']}}'>

                            <div class='count-product-quantity'>
                                <div class='product-quantity-hold'>
                                    <input type="text" name="quantity[]" class='quantityInput' readonly value='{{$cartItem['amount']}}'>
                                </div>
                            </div>
                        </div>
                    </div><!--cart-element-->
                @endforeach

                @else
                <p>Nu sunt produse în coș.</p>
                @endif
            </div><!--cart-product-hold-->

            </div><!--cart-product-hold-->
            <div class='large-summary finalSummary'>
                <div class='summary-element'>
                    <div class='perfect-left'>
                        <h3>Subtotal:</h3>
                    </div>
                    <div class='perfect-right'>
                        <p><span class='subtotalCartLarge'>@if (isset($cartInfos['totalCart']['subtotal']) && !empty($cartInfos['totalCart']['subtotal'])) {{$cartInfos['totalCart']['subtotal']}} @else 0 @endif</span> lei</p>
                    </div>
                </div><!--summary-element-->

                <div class='summary-element'>
                    <div class='perfect-left'>
                        <h3>Livrare:<span>*</span></h3>
                    </div>
                    <div class='perfect-right'>
                        <p><span class='deliveryFeeCartLarge'>@if (isset($cartInfos['totalCart']['deliveryFee']) && !empty($cartInfos['totalCart']['deliveryFee'])) {{$cartInfos['totalCart']['deliveryFee']}} @else 0 @endif</span> lei</p>
                    </div>
                </div><!--summary-element-->

                <div class='summary-element'>
                    <div class='perfect-left'>
                        <h3>TVA @if (isset($cartInfos['totalCart']['tva']) && !empty($cartInfos['totalCart']['tva'])) {{$cartInfos['totalCart']['tva']}} @else 0 @endif %:</h3>
                    </div>
                    <div class='perfect-right'>
                        <p><span class='tvaLarge'>@if (isset($cartInfos['totalCart']['calculatedTva']) && !empty($cartInfos['totalCart']['calculatedTva'])) {{$cartInfos['totalCart']['calculatedTva']}} @else 0 @endif</span> lei</p>
                    </div>
                </div><!--summary-element-->

                {{-- <div class='summary-element'>
                    <div class='perfect-left'>
                        <h3>Total (TVA inclus, fără livrare):<span>**</span></h3>
                    </div>
                    <div class='perfect-right'>
                        <p><span class='totalCartLarge'>@if (isset($cartInfos['totalCart']['subtotalWithTVA']) && !empty($cartInfos['totalCart']['subtotalWithTVA'])) {{$cartInfos['totalCart']['subtotalWithTVA']}} @else 0 @endif</span> lei</p>
                    </div>
                </div><!--summary-element--> --}}

                <div class='summary-element'>
                    <div class='perfect-left'>
                        <h3>Total comandă (TVA inclus, plus livrare):</h3>
                    </div>
                    <div class='perfect-right'>
                        <p><span class='totalCartLarge'>@if (isset($cartInfos['totalCart']['totalOrder']) && !empty($cartInfos['totalCart']['totalOrder'])) {{$cartInfos['totalCart']['totalOrder']}} @else 0 @endif</span> lei</p>
                    </div>
                </div><!--summary-element-->
                <p class='orderDiscl'><span>*</span>Comenzile de peste 2500 RON<span>**</span> au livrare gratuită.</p>
                <p class='orderDiscl'><span>**</span>Calculat subtotal + TVA, fără livrare.</p>
            </div><!--small-summary-->
            <div class='cart-btn-hold'>
                <a href="" class='general-btn placeOrder'>{{$payBtnCopy}}</a>
                <div class="loader">
                    <img src="{{url('img/loader.svg')}}" alt="">
                </div>
            </div>
        </div><!--summaryHold-->

        <div class='paymentInterface'>
            <form id="payment-form">
                <div id="link-authentication-element">
                    <!--Stripe.js injects the Link Authentication Element-->
                </div>
                <div id="payment-element">
                    <!--Stripe.js injects the Payment Element-->
                </div>
                <div class='cart-btn-hold'>
                    <button class='general-btn stripePayBtn' id="submit">Plasează comanda</button>
                    <div class="loader stripePayLoader">
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
            </form>
        </div>

    </div><!--large-container-->
</section>

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
<script src="https://js.stripe.com/v3/" defer></script>
<script src="{{ mix('js/stripe.js') }}" defer></script>
@endsection
