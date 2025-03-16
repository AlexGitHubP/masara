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
                    <li>Consultă aici <a href='{{ route('terms.and.conditions') }}' target='_blank'>termenii și condițiile</a> MASARA.</li>
                    <li>Consultă aici <a href='{{ route('gdpr.policy') }}' target='_blank'>acordul de confidențialitate</a> MASARA.</li>
{{--                    <li>Citește despre necesitatea adăugării unei forme juridice <a href='' target='_blank'>aici</a>.</li>--}}
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
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                            <option value="1989">1989</option>
                                            <option value="1988">1988</option>
                                            <option value="1987">1987</option>
                                            <option value="1986">1986</option>
                                            <option value="1985">1985</option>
                                            <option value="1984">1984</option>
                                            <option value="1983">1983</option>
                                            <option value="1982">1982</option>
                                            <option value="1981">1981</option>
                                            <option value="1980">1980</option>
                                            <option value="1979">1979</option>
                                            <option value="1978">1978</option>
                                            <option value="1977">1977</option>
                                            <option value="1976">1976</option>
                                            <option value="1975">1975</option>
                                            <option value="1974">1974</option>
                                            <option value="1973">1973</option>
                                            <option value="1972">1972</option>
                                            <option value="1971">1971</option>
                                            <option value="1970">1970</option>
                                            <option value="1969">1969</option>
                                            <option value="1968">1968</option>
                                            <option value="1967">1967</option>
                                            <option value="1966">1966</option>
                                            <option value="1965">1965</option>
                                            <option value="1964">1964</option>
                                            <option value="1963">1963</option>
                                            <option value="1962">1962</option>
                                            <option value="1961">1961</option>
                                            <option value="1960">1960</option>
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
                                        <option value="2023" {{ $companyInfos->company_year === "2023" ? "selected" : "" }}>2023</option>
                                        <option value="2022" {{ $companyInfos->company_year === "2022" ? "selected" : "" }}>2022</option>
                                        <option value="2021" {{ $companyInfos->company_year === "2021" ? "selected" : "" }}>2021</option>
                                        <option value="2020" {{ $companyInfos->company_year === "2020" ? "selected" : "" }}>2020</option>
                                        <option value="2019" {{ $companyInfos->company_year === "2019" ? "selected" : "" }}>2019</option>
                                        <option value="2018" {{ $companyInfos->company_year === "2018" ? "selected" : "" }}>2018</option>
                                        <option value="2017" {{ $companyInfos->company_year === "2017" ? "selected" : "" }}>2017</option>
                                        <option value="2016" {{ $companyInfos->company_year === "2016" ? "selected" : "" }}>2016</option>
                                        <option value="2015" {{ $companyInfos->company_year === "2015" ? "selected" : "" }}>2015</option>
                                        <option value="2014" {{ $companyInfos->company_year === "2014" ? "selected" : "" }}>2014</option>
                                        <option value="2013" {{ $companyInfos->company_year === "2013" ? "selected" : "" }}>2013</option>
                                        <option value="2012" {{ $companyInfos->company_year === "2012" ? "selected" : "" }}>2012</option>
                                        <option value="2011" {{ $companyInfos->company_year === "2011" ? "selected" : "" }}>2011</option>
                                        <option value="2010" {{ $companyInfos->company_year === "2010" ? "selected" : "" }}>2010</option>
                                        <option value="2009" {{ $companyInfos->company_year === "2009" ? "selected" : "" }}>2009</option>
                                        <option value="2008" {{ $companyInfos->company_year === "2008" ? "selected" : "" }}>2008</option>
                                        <option value="2007" {{ $companyInfos->company_year === "2007" ? "selected" : "" }}>2007</option>
                                        <option value="2006" {{ $companyInfos->company_year === "2006" ? "selected" : "" }}>2006</option>
                                        <option value="2005" {{ $companyInfos->company_year === "2005" ? "selected" : "" }}>2005</option>
                                        <option value="2004" {{ $companyInfos->company_year === "2004" ? "selected" : "" }}>2004</option>
                                        <option value="2003" {{ $companyInfos->company_year === "2003" ? "selected" : "" }}>2003</option>
                                        <option value="2002" {{ $companyInfos->company_year === "2002" ? "selected" : "" }}>2002</option>
                                        <option value="2001" {{ $companyInfos->company_year === "2001" ? "selected" : "" }}>2001</option>
                                        <option value="2000" {{ $companyInfos->company_year === "2000" ? "selected" : "" }}>2000</option>
                                        <option value="1999" {{ $companyInfos->company_year === "1999" ? "selected" : "" }}>1999</option>
                                        <option value="1998" {{ $companyInfos->company_year === "1998" ? "selected" : "" }}>1998</option>
                                        <option value="1997" {{ $companyInfos->company_year === "1997" ? "selected" : "" }}>1997</option>
                                        <option value="1996" {{ $companyInfos->company_year === "1996" ? "selected" : "" }}>1996</option>
                                        <option value="1995" {{ $companyInfos->company_year === "1995" ? "selected" : "" }}>1995</option>
                                        <option value="1994" {{ $companyInfos->company_year === "1994" ? "selected" : "" }}>1994</option>
                                        <option value="1993" {{ $companyInfos->company_year === "1993" ? "selected" : "" }}>1993</option>
                                        <option value="1992" {{ $companyInfos->company_year === "1992" ? "selected" : "" }}>1992</option>
                                        <option value="1991" {{ $companyInfos->company_year === "1991" ? "selected" : "" }}>1991</option>
                                        <option value="1990" {{ $companyInfos->company_year === "1990" ? "selected" : "" }}>1990</option>
                                        <option value="1989" {{ $companyInfos->company_year === "1989" ? "selected" : "" }}>1989</option>
                                        <option value="1988" {{ $companyInfos->company_year === "1988" ? "selected" : "" }}>1988</option>
                                        <option value="1987" {{ $companyInfos->company_year === "1987" ? "selected" : "" }}>1987</option>
                                        <option value="1986" {{ $companyInfos->company_year === "1986" ? "selected" : "" }}>1986</option>
                                        <option value="1985" {{ $companyInfos->company_year === "1985" ? "selected" : "" }}>1985</option>
                                        <option value="1984" {{ $companyInfos->company_year === "1984" ? "selected" : "" }}>1984</option>
                                        <option value="1983" {{ $companyInfos->company_year === "1983" ? "selected" : "" }}>1983</option>
                                        <option value="1982" {{ $companyInfos->company_year === "1982" ? "selected" : "" }}>1982</option>
                                        <option value="1981" {{ $companyInfos->company_year === "1981" ? "selected" : "" }}>1981</option>
                                        <option value="1980" {{ $companyInfos->company_year === "1980" ? "selected" : "" }}>1980</option>
                                        <option value="1979" {{ $companyInfos->company_year === "1979" ? "selected" : "" }}>1979</option>
                                        <option value="1978" {{ $companyInfos->company_year === "1978" ? "selected" : "" }}>1978</option>
                                        <option value="1977" {{ $companyInfos->company_year === "1977" ? "selected" : "" }}>1977</option>
                                        <option value="1976" {{ $companyInfos->company_year === "1976" ? "selected" : "" }}>1976</option>
                                        <option value="1975" {{ $companyInfos->company_year === "1975" ? "selected" : "" }}>1975</option>
                                        <option value="1974" {{ $companyInfos->company_year === "1974" ? "selected" : "" }}>1974</option>
                                        <option value="1973" {{ $companyInfos->company_year === "1973" ? "selected" : "" }}>1973</option>
                                        <option value="1972" {{ $companyInfos->company_year === "1972" ? "selected" : "" }}>1972</option>
                                        <option value="1971" {{ $companyInfos->company_year === "1971" ? "selected" : "" }}>1971</option>
                                        <option value="1970" {{ $companyInfos->company_year === "1970" ? "selected" : "" }}>1970</option>
                                        <option value="1969" {{ $companyInfos->company_year === "1969" ? "selected" : "" }}>1969</option>
                                        <option value="1968" {{ $companyInfos->company_year === "1968" ? "selected" : "" }}>1968</option>
                                        <option value="1967" {{ $companyInfos->company_year === "1967" ? "selected" : "" }}>1967</option>
                                        <option value="1966" {{ $companyInfos->company_year === "1966" ? "selected" : "" }}>1966</option>
                                        <option value="1965" {{ $companyInfos->company_year === "1965" ? "selected" : "" }}>1965</option>
                                        <option value="1964" {{ $companyInfos->company_year === "1964" ? "selected" : "" }}>1964</option>
                                        <option value="1963" {{ $companyInfos->company_year === "1963" ? "selected" : "" }}>1963</option>
                                        <option value="1962" {{ $companyInfos->company_year === "1962" ? "selected" : "" }}>1962</option>
                                        <option value="1961" {{ $companyInfos->company_year === "1961" ? "selected" : "" }}>1961</option>
                                        <option value="1960" {{ $companyInfos->company_year === "1960" ? "selected" : "" }}>1960</option>
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
