<section class='offcanvas-section'>
    <h2>Produsele tale</h2>
    <div class='offcanvas-close'>
        <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.7559 22C18.2559 22 22.7559 17.5 22.7559 12C22.7559 6.5 18.2559 2 12.7559 2C7.25586 2 2.75586 6.5 2.75586 12C2.75586 17.5 7.25586 22 12.7559 22Z" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.92578 14.83L15.5858 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15.5858 14.83L9.92578 9.16998" stroke="#909090" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class='offcanvas-cart-hold'>
        @if (isset($cartInfos['cartItems']) && count($cartInfos['cartItems']) > 0)
            
            @foreach ($cartInfos['cartItems'] as $key => $cartItem )
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
                    {{-- <ul>
                        <li>Blat</li>
                        <li>Culoare</li>
                        <li>Dimensiune</li>
                    </ul> --}}
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
        <p>Nu sunt produse adaugate in coș</p>
        <br/>
        @endif
        
    </div>
    <div class='offcavas-calculator'>
        <div class="large-summary">
            <div class="summary-element">
                <div class="perfect-left">
                    <h3>Subtotal:</h3>
                </div>
                <div class="perfect-right">
                    <p><span class='smallSubtotal'>@if (isset($cartInfos['totalCart']['subtotal']) && !empty($cartInfos['totalCart']['subtotal'])) {{$cartInfos['totalCart']['subtotal']}} @endif</span> lei</p>
                </div>
            </div><!--summary-element-->

            <div class='summary-element'>
                <div class='perfect-left'>
                    <h3>Livrare:<span>*</span></h3>
                </div>
                <div class='perfect-right'>
                    <p><span class='deliveryFeeCartSmall'>@if (isset($cartInfos['totalCart']['deliveryFee']) && !empty($cartInfos['totalCart']['deliveryFee'])) {{$cartInfos['totalCart']['deliveryFee']}} @else 0 @endif</span> lei</p>
                </div>
            </div><!--summary-element-->
{{-- 
            <div class="summary-element">
                <div class="perfect-left">
                    <h3>TVA @if (isset($cartInfos['totalCart']['tva']) && !empty($cartInfos['totalCart']['tva'])) {{$cartInfos['totalCart']['tva']}}%: @endif</h3>
                </div>
                <div class="perfect-right">
                    <p><span class='smallTVA'>@if (isset($cartInfos['totalCart']['calculatedTva']) && !empty($cartInfos['totalCart']['calculatedTva'])) {{$cartInfos['totalCart']['calculatedTva']}} @else 0 @endif</span> lei</p>
                </div>
            </div><!--summary-element-->
            <div class='summary-element'>
                <div class='perfect-left'>
                    <h3>Total (TVA inclus, fără livrare):<span>**</span></h3>
                </div>
                <div class='perfect-right'>
                    <p><span class='smallsubTotalWithTVA'>@if (isset($cartInfos['totalCart']['subtotalWithTVA']) && !empty($cartInfos['totalCart']['subtotalWithTVA'])) {{$cartInfos['totalCart']['subtotalWithTVA']}} @else 0 @endif</span> lei</p>
                </div>
            </div><!--summary-element--> --}}

            <div class="summary-element">
                <div class="perfect-left">
                    <h3>Total (TVA inclus, cu livrare):</h3>
                </div>
                <div class="perfect-right">
                    <p><span class='smallTotalWithTVA'>@if (isset($cartInfos['totalCart']['totalOrder']) && !empty($cartInfos['totalCart']['totalOrder'])) {{ $cartInfos['totalCart']['totalOrder'] }} @endif</span> lei</p>
                </div>
            </div><!--summary-element-->
            <p class='orderDiscl'><span>*</span>Comenzile de peste 2500 RON au livrare gratuită.</p>
        </div>
        <div class='perfect-flex-hold offcanvas-btns'>
            <div class='perfect-left'>
                <a href="" class='general-btn transparent-btn continue-shopping'>Continuă cumpărăturile</a>
            </div>
            <div class='perfect-right'>
                <a href="{{url('cos/produse.html')}}" class='general-btn'>Continuă</a>
            </div>
        </div>
    </div>
</section>