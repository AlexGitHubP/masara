@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='cart-section orderD'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('/cos/produse.html')}}">Coș/produse</a>
                </li>
                <li class='selected'>
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
            <div class='perfect-left orderDetailsLayout'>
                <div class='cart-content-box'>
                    <h1>Detalii facturare</h1>
                    <p>Ai deja cont? <a class='enter' href=''>Intră în cont</a></p>
                    <form action="" method="POST" id='orderDetailForm'>
                        <p>Tip persoană</p>
                        <div class='account-type-btns'>
                            <div class='account-btn-switch' >
                                <label for="fizica" data-tab='fizica' class='active-account-tab'>Persoană fizică</label>
                                <input type="radio" name='person_type' id='fizica' value='fizica' checked>
                            </div>
                            <div class='account-btn-switch' >
                                <label for="juridica" data-tab='juridica'>Persoană juridică</label>
                                <input type="radio" name='person_type' id='juridica' value='juridica'>
                            </div>
                        </div>

                        <div class='account-tabs'>
                            <div class='tab-content tab-content-0'>
                                <div class='perfect-flex-hold normalise'>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="name">Nume <span>*</span></label>
                                            <input type="text" name="name" id="name" value=''>
                                        </div>
                                    </div>
                                    <div class='perfect-right'>
                                        <div class='input-hold'>
                                            <label for="surname">Prenume <span>*</span></label>
                                            <input type="text" name="surname" id="surname" value=''>
                                        </div>
                                    </div>
                                </div><!--perfect-flex-hold-->
                                <div class='perfect-flex-hold normalise'>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="email">Email <span>*</span></label>
                                            <input type="text" name="email" id="email" value=''>
                                        </div>
                                    </div>
                                    <div class='perfect-right'>
                                        <div class='input-hold'>
                                            <label for="phone">Telefon <span>*</span></label>
                                            <input type="text" name="phone" id="phone" value=''>
                                        </div>
                                    </div>
                                </div><!--perfect-flex-hold-->
                                

                                <div class='juridic-fields juridica'>
                                    <fieldset id='juridic-fields'>
                                        <div class='perfect-flex-hold normalise'>
                                            <div class='perfect-left'>
                                                <div class='input-hold'>
                                                    <label for="company_name">Nume companie <span>*</span></label>
                                                    <input type="text" name="company_name" id="company_name" value=''>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_type">Tip firmă <span>*</span></label>
                                                    <select name="company_type" id="company_type" value=''>
                                                        <option value="">Alege tip</option>
                                                        <option value="SRL">S.R.L.</option>
                                                        <option value="SA">S.A.</option>
                                                        <option value="PFA">P.F.A.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_vat_type">Plătitor de TVA <span>*</span></label>
                                                    <select name="company_vat_type" id="company_vat_type" value=''>
                                                        <option value="">Alege</option>
                                                        <option value="RO">RO - plătitor de tva</option>
                                                        <option value="N/A"> -- neplătitor de TVA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_cui">CUI <span>*</span></label>
                                                    <input type="text" name="company_cui" id="company_cui" value=''>
                                                </div>
                                            </div>
                                        </div><!--perfect-flex-hold-->
                                        <div class='perfect-flex-hold normalise'>
                                            <div class='perfect-left'>
                                                <div class='input-hold'>
                                                    <label for="company_j">Numar de înregistrare<span>*</span></label>
                                                    <select name="company_j" id="company_j" value=''>
                                                        <option value="">Alege nr. înregistrare</option>
                                                        <option value="J">J</option>
                                                        <option value="F">F</option>
                                                        <option value="C">C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_nr">Nr. firmă<span>*</span></label>
                                                    <select name="company_nr" id="company_nr" value=''>
                                                        <option value="">Alege număr</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_series">Serie firmă<span>*</span></label>
                                                    <input type="text" name="company_series" id="company_series" value=''>
                                                </div>
                                            </div>
                                            <div class='perfect-right'>
                                                <div class='input-hold'>
                                                    <label for="company_year">An înființare<span>*</span></label>
                                                    <select name="company_year" id="company_year" value=''>
                                                        <option value="">Alege anul</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2020">2020</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!--perfect-flex-hold-->

                                    </fieldset>
                                </div><!--juridic-fields-->

                                <div class='perfect-flex-hold normalise'>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="county">Județ</label>
                                            <select name="county" id="county" value="" class='changeCounty'>
                                                <option value="">Alege Județ</option>
                                                @foreach ($judete as $judet)
                                                    <option value="{{$judet->judet}}">{{$judet->judet}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class='perfect-right'>
                                        <div class='input-hold'>
                                            <label for="city">Localitate/Oraș</label>
                                            <select name="city" id="city" value="" class='changeCity'>
                                                <option value="">Alege un Județ pentru lista de orașe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class='perfect-right'>
                                        <div class='input-hold'>
                                            <label for="country">Țară/regiune <span>*</span></label>
                                            <select name="country" id="country" value=''>
                                                <option value="">Alege țara/regiunea</option>
                                                <option value="România">România</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--perfect-flex-hold-->
                               
                                <div class='perfect-flex-hold normalise'>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="street">Stradă<span>*</span></label>
                                            <input type="text" name="street" id="street" value='' placeholder='Ex: Str. Eroilor'>
                                        </div>
                                    </div>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="nr">Nr.<span>*</span></label>
                                            <input type="text" name="nr" id="nr" value='' placeholder='Ex: 8'>
                                        </div>
                                    </div>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="bloc">Bloc</label>
                                            <input type="text" name="bloc" id="bloc" value='' placeholder='Ex: 2'>
                                        </div>
                                    </div>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="scara">Scara</label>
                                            <input type="text" name="scara" id="scara" value='' placeholder='Ex: B'>
                                        </div>
                                    </div>
                                    <div class='perfect-left'>
                                        <div class='input-hold'>
                                            <label for="apartament">Apartament</label>
                                            <input type="text" name="apartament" id="apartament" value='' placeholder='Ex: 35'>
                                        </div>
                                    </div>
                                </div>

                                <div class='input-hold'>
                                    <label for="zip_code">Cod poștal</label>
                                    <input type="text" name="zip_code" id="zip_code" value=''>
                                </div>
                                
                            </div>
                        </div><!--account-tabs-->
                        <div class='input-hold checkbox-hold'>
                            <label for="terms">Sunt de acord cu <a href='' target='_blank'>termenii si conditiile</a>.</label>
                            <input type="checkbox" name="terms" id="terms" value=''>
                            <div class='fake-check'></div>
                        </div>
    
                        <div class='input-hold checkbox-hold'>
                            <label for="gdpr">Sunt de acord cu <a href='' target='_blank'>politica de prelucrare a datelor</a>.</label>
                            <input type="checkbox" name="gdpr" id="gdpr" value=''>
                            <div class='fake-check'></div>
                        </div>
                        {{-- <div class='cart-btn-hold'>
                            <a href="{{url('cos/detalii-plata.html')}}" class='general-btn' id='checkout1' data-endpoint='/cart/checkout1' data-method='POST' data-form='checkout1Form'>Spre plătă</a>
                            <div class="loader">
                                <img src="{{url('img/loader.svg')}}" alt="">
                            </div>
                        </div> --}}
                    
                </div><!--cart-content-box-->
            </div><!--perfect-left-->

            <div class='perfect-right orderDetailsLayout'>
            <div class='cart-content-box'>
                <h1>Detalii transport/plată</h1>
                <div class='leftFormDetailsHold'>
                    <h2>Livrare</h2>
                    @foreach ($carriers as $carrier)
                        <h3 class='deliveryOwner'>{{$carrier->name}}</h3>
                        @foreach ($carrier->type as $carrierType)
                            <div class='delivery-method'>
                                <div class='input-hold checkbox-hold'>
                                    <label for="{{$carrierType->id}}_{{$carrierType->carrier_id}}">{{$carrierType->name}}</label>
                                    <input type="radio" name="carrier" id="{{$carrierType->id}}_{{$carrierType->carrier_id}}" @if($carrierType->is_default==1) checked @endif value='{{$carrierType->id}}'>
                                    <div class='fake-check'></div>
                                </div>
                                <p>{!!$carrierType->description!!}</p>
                            </div>        
                        @endforeach
                    @endforeach
                    

                    <div class='separator-space'></div>
                    <h2>Metodă de plată</h2>
                    @foreach ($payMethods as $payMethod)
                    <div class='pay-method'>
                        <div class='input-hold checkbox-hold'>
                            <label for="{{$payMethod->type}}_{{$payMethod->id}}">{{$payMethod->name}}</label>
                            <input type="radio" name="paymethod" id="{{$payMethod->type}}_{{$payMethod->id}}" value='{{$payMethod->id}}' @if($payMethod->is_default==1) checked @endif>
                            <div class='fake-check'></div>
                        </div>
                    </div>    
                    @endforeach
                    
                    
                    <div class='large-summary'>
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
                    </div><!--large-summary-->
                    <div class='cart-btn-hold'>
                        <a href="{{url('cos/detalii-plata.html')}}" class='general-btn' id='saveOrderDetails' data-endpoint='/cart/putOrderDetailsToSession' data-method='POST' data-form='orderDetailForm'>Pasul următor</a>

                        <div class="loader">
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                
            </div><!--cart-content-box-->
        </div>
    </div><!--large-container-->
    {{-- <div class='constrainSummary'>
        
    </div> --}}
</section>

@stop 