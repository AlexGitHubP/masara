@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='cart-section'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li class='selected'>
                    <a href="{{url('/cos/produse.html')}}">Coș/produse</a>
                </li>
                <li>
                    <a href="{{url('/cos/detalii-comanda.html')}}">Detalii comandă</a>
                </li>
                <li>
                    <a href="{{url('/cos/checkout.html')}}">Sumar comandă/checkout</a>
                </li>
                <li>
                    <a href="{{url('/cos/comanda-plasata.html')}}">Comandă plasată</a>
                </li>
            </ul>
        </div>

        <div class='perfect-flex-hold'>
            <div class='perfect-left'>
                <div class='cart-content-box'>
                    <h1>Coș de cumpărături</h1>
                    
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
                                    <div class='delete-cart-element'>
                                        <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.7559 22C18.2559 22 22.7559 17.5 22.7559 12C22.7559 6.5 18.2559 2 12.7559 2C7.25586 2 2.75586 6.5 2.75586 12C2.75586 17.5 7.25586 22 12.7559 22Z" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.92578 14.83L15.5858 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.5858 14.83L9.92578 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class='count-product-quantity'>
                                        <div class='product-quantity-hold'>
                                            <div class='amountHandler decrease-number' data-operation='decrease'>-</div>
                                            <input type="text" name="quantity[]" class='quantityInput' value='{{$cartItem['amount']}}'>
                                            <div class='amountHandler increase-number' data-operation='increase'>+</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--cart-element-->    
                        @endforeach
                            
                        @else
                        <p>Nu sunt produse în coș.</p>
                        @endif
                    </div><!--cart-product-hold-->

                </div><!--cart-content-box-->
            </div>
            <div class='perfect-right'>
                <div class='small-summary'>
                    <h2>Comanda ta</h2>
                    
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
                            <p><span class='totalCartLargeTVA'>@if (isset($cartInfos['totalCart']['subtotalWithTVA']) && !empty($cartInfos['totalCart']['subtotalWithTVA'])) {{$cartInfos['totalCart']['subtotalWithTVA']}} @else 0 @endif</span> lei</p>
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
                    <div class='cart-btn-hold'>
                        <a href="{{url('cos/detalii-comanda.html')}}" class='general-btn'>Continuă spre detalii comandă</a>
                    </div>
                    <p class='orderDiscl'><span>*</span>Comenzile de peste 2500 RON<span>**</span> au livrare gratuită.</p>
                    <p class='orderDiscl'><span>**</span>Subtotal, fără TVA.</p>
                </div><!--small-summary-->
            </div>
        </div>
    </div><!--large-container-->
</section>

@stop 