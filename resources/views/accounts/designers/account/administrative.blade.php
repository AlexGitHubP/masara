@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='dashboard-account'>
    <div class='large-container'>
        <div class='dashboard-flex'>
            <div class='dashboard-left'>
                <div class='dashboard-left-content'>
                    @include('accounts.designers.account.designers_left_menu', ['accountID'=>$accountID, 'userRole'=>$userRole, 'profilePicture'=>$profilePicture])
                </div>
            </div>
            <div class='dashboard-right administrativeDashboard'>
                <h2>Informații legate de MASARA.</h2>
                <ul>
                    <li>Consultă aici <a href='' target='_blank'>informațiile legate de cardul tău</a>.</li>
                    <li>Consultă aici <a href='' target='_blank'>termenii și condițiile</a> MASARA.</li>
                    <li>Consultă aici <a href='' target='_blank'>acordul de confidențialitate</a> MASARA.</li>
                    <li>Citește despre necesitatea adăugării unei forme juridice <a href='' target='_blank'>aici</a>.</li>
                </ul>
                <div class='separator-large'></div>
                @if ($companyInfos==false)
                    <p>Nu există informații juridice.</p>

                    <form action="" id='addCompanyDetails'>
                        @csrf
                        <div class="juridic-fields juridica">
                            <div class="perfect-flex-hold normalise">
                                <div class="perfect-left">
                                    <div class="input-hold">
                                        <label for="company_name">Nume companie <span>*</span></label>
                                        <input type="text" name="company_name" id="company_name" value="">
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <label for="company_type">Tip companie <span>*</span></label>
                                        <select name="company_type" id="company_type" value="">
                                            <option value="">Alege</option>
                                            <option value="SRL">S.R.L.</option>
                                            <option value="SA">S.A.</option>
                                            <option value="PFA">P.F.A.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <label for="company_vat_type">Plătitor de TVA <span>*</span></label>
                                        <select name="company_vat_type" id="company_vat_type" value="">
                                            <option value="">Alege</option>
                                            <option value="RO">RO - plătitor de tva</option>
                                            <option value="N/A"> -- neplătitor de TVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <label for="company_cui">CUI <span>*</span></label>
                                        <input type="text" name="company_cui" id="company_cui" value="">
                                    </div>
                                </div>
                            </div><!--perfect-flex-hold-->
                            <div class="company-space-comensator"></div>
                            <div class="perfect-flex-hold normalise">
                                <div class="perfect-left">
                                    <div class="input-hold">
                                        <label for="company_j" class="absolute-label">Numar de inregistrare in Registrul Comertului <span>*</span></label>
                                        <select name="company_j" id="company_j" value="">
                                            <option value="">Alege</option>
                                            <option value="J">J</option>
                                            <option value="F">F</option>
                                            <option value="C">C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <select name="company_nr" id="company_nr" value="">
                                            <option value="">Alege</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <input type="text" name="company_series" id="company_series" value="">
                                    </div>
                                </div>
                                <div class="perfect-right">
                                    <div class="input-hold">
                                        <select name="company_year" id="company_year" value="">
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!--perfect-flex-hold-->
                        </div>
                        <div class='btn-hold'>
                            <a href="" class='general-btn transparent-btn addCompanyDetail' data-endpoint='/saveCompanyInfo' data-method='POST' data-form='addCompanyDetails'>Adaugă detalii companie</a>
                            <div class='loader'>
                                <img src="{{url('img/loader.svg')}}" alt="">
                            </div>
                        </div>
                    </form>
                @else
                <h2>Informații companie</h2>
                <form action="" id='editCompanyDetail'>
                    @csrf
                    <input type="hidden" name='company_id' id='company_id' value="{{$companyInfos->id}}">
                    <input type="hidden" name='account_id' id='account_id' value="{{$companyInfos->account_id}}">
                    <div class="juridic-fields">
                        <div class="perfect-flex-hold normalise">
                            <div class="perfect-left">
                                <div class="input-hold">
                                    <label for="company_name">Nume companie <span>*</span></label>
                                    <input type="text" name="company_name" id="company_name" value="{{$companyInfos->company_name}}">
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <label for="company_type">Tip companie <span>*</span></label>
                                    <select name="company_type" id="company_type" value="">
                                        <option value="">Alege</option>
                                        <option value="SRL" {{ $companyInfos->company_type === "SRL" ? "selected" : "" }}>S.R.L.</option>
                                        <option value="SA" {{ $companyInfos->company_type === "SA" ? "selected" : "" }}>S.A.</option>
                                        <option value="PFA" {{ $companyInfos->company_type === "PFA" ? "selected" : "" }}>P.F.A.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <label for="company_vat_type">Plătitor de TVA <span>*</span></label>
                                    <select name="company_vat_type" id="company_vat_type" value="">
                                        <option value="">Alege</option>
                                        <option value="RO" {{ $companyInfos->company_vat_type === "RO" ? "selected" : "" }}>RO - plătitor de tva</option>
                                        <option value="N/A" {{ $companyInfos->company_vat_type === "N/A" ? "selected" : "" }}> -- neplătitor de TVA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <label for="company_cui">CUI <span>*</span></label>
                                    <input type="text" name="company_cui" id="company_cui" value="{{$companyInfos->company_cui}}">
                                </div>
                            </div>
                        </div><!--perfect-flex-hold-->
                        <div class="company-space-comensator"></div>
                        <div class="perfect-flex-hold normalise">
                            <div class="perfect-left">
                                <div class="input-hold">
                                    <label for="company_j" class="absolute-label">Numar de inregistrare in Registrul Comertului <span>*</span></label>
                                    <select name="company_j" id="company_j" value="">
                                        <option value="">Alege</option>
                                        <option value="J" {{ $companyInfos->company_j === "J" ? "selected" : "" }}>J</option>
                                        <option value="F" {{ $companyInfos->company_j === "F" ? "selected" : "" }}>F</option>
                                        <option value="C" {{ $companyInfos->company_j === "C" ? "selected" : "" }}>C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <select name="company_nr" id="company_nr" value="">
                                        <option value="">Alege</option>
                                        <option value="01" {{ $companyInfos->company_nr === "01" ? "selected" : "" }}>01</option>
                                        <option value="02" {{ $companyInfos->company_nr === "02" ? "selected" : "" }}>02</option>
                                        <option value="03" {{ $companyInfos->company_nr === "03" ? "selected" : "" }}>03</option>
                                        <option value="04" {{ $companyInfos->company_nr === "04" ? "selected" : "" }}>04</option>
                                    </select>
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <input type="text" name="company_series" id="company_series" value="{{$companyInfos->company_series}}">
                                </div>
                            </div>
                            <div class="perfect-right">
                                <div class="input-hold">
                                    <select name="company_year" id="company_year" value="">
                                        <option value="2023" {{ $companyInfos->company_nr === "2023" ? "selected" : "" }}>2023</option>
                                        <option value="2022" {{ $companyInfos->company_nr === "2022" ? "selected" : "" }}>2022</option>
                                        <option value="2021" {{ $companyInfos->company_nr === "2021" ? "selected" : "" }}>2021</option>
                                        <option value="2020" {{ $companyInfos->company_nr === "2020" ? "selected" : "" }}>2020</option>
                                    </select>
                                </div>
                            </div>
                        </div><!--perfect-flex-hold-->
                    </div>
                    <div class='btn-hold'>
                        <a href="" class='general-btn transparent-btn editCompanyDetail' data-endpoint='/editCompanyInfo' data-method='POST' data-form='editCompanyDetail'>Modifică detaliile companiei</a>
                        <div class='loader'>
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                    </div>
                </form>
                @endif
{{--                <div class='separator-large'></div>--}}
{{--                <h2>Informatii card companie</h2>--}}
{{--                <div class='btn-hold'>--}}
{{--                    <form action="/createAndSetupExpressAccount" method="POST">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name='accountID' id='accountID' value='{{$accountID}}'>--}}
{{--                        <input type="submit" class='general-btn transparent-btn' value='Adaugă detalii de card prin Stripe'>--}}
{{--                    </form>--}}
{{--                    <div class='loader cardBtnLoad'>--}}
{{--                        <img src="{{url('img/loader.svg')}}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class='separator-large'></div>
                <h2>Facturi</h2>

                @foreach ($invoicesList as $key => $invoiceYear)
                    <div class='invoicesHolder'>
                        <h3>{{$invoiceYear->year}}</h3>
                        <div class='invoiceMonthsHolder'>
                            @foreach ($invoiceYear->months as $kk => $invoiceMonth)
                                <div class='monthColumn m-{{$invoiceMonth->month}}'>
                                    <h4>{{$invoiceMonth->month}}</h4>
                                    @if (isset($invoiceMonth->invoice_status))
                                        @if($invoiceMonth->sameMonth==true && $invoiceMonth->lastDayofMonth==true)
                                            @if($invoiceMonth->invoice==null)
                                                <form action="/uploadInvoice" method='POST' enctype='multipart/form-data' class='invoice-upload' id='uploadInvoice{{ $kk }}'>
                                                    @csrf
                                                    <input type="hidden" id='reseller_invoices_id' name='reseller_invoices_id' value='{{ $invoiceMonth->id }}'>
                                                    <input type="hidden" id='accountID' name='accountID' value='{{$accountID}}'>

                                                    <div class='invoiceUploadHold'>
                                                        <input type="file" class="invoiceElem" name="invoice{{ $kk }}" id="invoice{{ $kk }}">
                                                        <div class='loader invoiceLoader'>
                                                            <img src="{{url('img/loader.svg')}}" alt="">
                                                        </div>
                                                        <label for='invoice{{ $kk }}' class='general-btn uploadInvoice'>Urca factura</label>

                                                        @if ($invoiceMonth->invoicesArePaid==true)
                                                            <p>Magazinul a incasat toate platile pentru vanzarile tale.</p>
                                                            <p>Vom vira banii in maxim 7 zile lucratoare de la urcarea facturii.</p>
                                                        @else
                                                            <p>Magazinul inca nu a incasat toate platile pentru vanzarile tale din luna aceasta.</p>
                                                            <p>Poti urca factura, iar noi te vom instiinta cand toate facturile sunt incasate si vom vira banii.</p>
                                                        @endif

                                                        <p>Factura trebuie să fie de <strong>{{$invoiceMonth->amount_to_invoice}} RON</strong> NET.</p>
                                                    </div>
                                                    <p><strong>Status factură:</strong> {{$invoiceMonth->invoice_status}}</p>
                                                </form>
                                            @else
                                                <p><strong>Sumă:</strong> {{$invoiceMonth->amount_to_invoice}} RON</p>
                                                <p><strong>Vezi aici factura:</strong> <a href='/invoices/{{$invoiceMonth->invoice}}' target='_blank'>factură</a></p>
                                                <p><strong>Status factură:</strong> {{$invoiceMonth->invoice_status}}</p>
                                            @endif

                                        @elseif($invoiceMonth->sameMonth==false && $invoiceMonth->invoice==null)
                                            <form action="/uploadInvoice" method='POST' enctype='multipart/form-data' class='invoice-upload' id='uploadInvoice{{ $kk }}'>
                                                @csrf
                                                <input type="hidden" id='reseller_invoices_id' name='reseller_invoices_id' value='{{ $invoiceMonth->id }}'>
                                                <input type="hidden" id='accountID' name='accountID' value='{{$accountID}}'>

                                                <div class='invoiceUploadHold'>
                                                    <input type="file" class="invoiceElem" name="invoice{{ $kk }}" id="invoice{{ $kk }}">
                                                    <div class='loader invoiceLoader'>
                                                        <img src="{{url('img/loader.svg')}}" alt="">
                                                    </div>
                                                    <label for='invoice{{ $kk }}' class='general-btn uploadInvoice'>Urca factura</label>

                                                    <p>Nu ai încărcat factura pentru această lună, însă ai 20 de zile pentru a o încrca.</p>

                                                    <p>Factura trebuie să fie de <strong>{{$invoiceMonth->amount_to_invoice}} RON</strong> NET.</p>
                                                </div>
                                                <p><strong>Status factură:</strong> {{$invoiceMonth->invoice_status}}</p>
                                            </form>

                                        @elseif($invoiceMonth->sameMonth==false && $invoiceMonth->invoice!=null)
                                            <p><strong>Sumă:</strong> {{$invoiceMonth->amount_to_invoice}} RON</p>
                                            <p><strong>Status factură:</strong> {{$invoiceMonth->invoice_status}}</p>
                                            <p><strong>Vezi aici factura:</strong> <a href='/invoices/{{$invoiceMonth->invoice}}' target='_blank'>factură</a></p>
                                        @else
                                            <p>Vei putea urca factura doar in ultima zi din luna curenta.</p>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop
