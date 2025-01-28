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
            <div class='dashboard-right'>
                <div class='charts-flex'>
                    <div class='left-chart'>
                        <div class='designer-raport'>
                            <div id='chartRaport1'></div>
                            <h2>Vânzări</h2>
                            <div class='raport-tabs-infos'>
                                <div class='raport-input-hold'>
                                    <select name="rapportPeriod" id="rapportPeriod" class='rapportPeriod'>
                                        <option value="7days">Ultimele 7 zile</option>
                                        <option value="1mo">1 lună</option>
                                    </select>
                                </div>
                            </div><!--raport-tabs-infos-->
                        </div>
                    </div>
                    <div class='right-chart'>
                        <div class='raport-chart'>
                            <h2>Rapoarte</h2>
                            <div class='raport-tabs-infos'>
                                <div class='raport-input-hold'>
                                    <select name="period" id="period">
                                        <option value="7days">Ultimele 7 zile</option>
                                        <option value="1mo">1 lună</option>
                                    </select>
                                </div>
                                <a href="" class='raport-more'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 5.43199C14 4.31439 13.1 3.39999 12 3.39999C10.9 3.39999 10 4.31439 10 5.43199C10 6.54959 10.9 7.46399 12 7.46399C13.1 7.46399 14 6.54959 14 5.43199Z" fill="#909090"/>
                                        <path d="M14 19.656C14 18.5384 13.1 17.624 12 17.624C10.9 17.624 10 18.5384 10 19.656C10 20.7736 10.9 21.688 12 21.688C13.1 21.688 14 20.7736 14 19.656Z" fill="#909090"/>
                                        <path d="M14 12.544C14 11.4264 13.1 10.512 12 10.512C10.9 10.512 10 11.4264 10 12.544C10 13.6616 10.9 14.576 12 14.576C13.1 14.576 14 13.6616 14 12.544Z" fill="#909090"/>
                                    </svg>                                        
                                </a>
                            </div><!--raport-tabs-infos-->
                            <div class='reports-box perfect-flex-hold'>
                                <div class='perfect-left'>
                                    <div class='report-element-flex'>
                                        <p>Vizionari produse ultimele 7 zile</p>
                                        <h3>{{$salesRapport['hitsInCurrentRange']}}</h3>
                                    </div>
                                    <h6 class='report-stats'>&#8593 <span class='{{$salesRapport['type']}}'>{{$salesRapport['percentageDifference']}}%</span> </h6>
                                </div>
                                <div class='perfect-right'>
                                    <div class='report-element-flex'>
                                        <p>Vizionari produse 7 zile anterioare</p>
                                        <h3>{{$salesRapport['hitsInPreviousRange']}}</h3>
                                    </div>
                                    {{-- <h6 class='report-stats'>&#8595 <span class='red'>37.8%</span> luna aceasta</h6> --}}
                                </div>

                                <div class='perfect-left'>
                                    <div class='report-element-flex'>
                                        <p>Încasări totale</p>
                                        <h3>{{$invoicesRapport['invoiceTotal']}} RON</h3>
                                    </div>
                                    {{-- <h6 class='report-stats'>&#8593 <span class='green'>37.8%</span> luna aceasta</h6> --}}
                                </div>
                                <div class='perfect-right'>
                                    <div class='report-element-flex'>
                                        <p>De încasat luna aceasta (fără TVA)</p>
                                        <h3>{{$invoicesRapport['invoiceThisMonth']}} RON</h3>
                                    </div>
                                    <h6 class='report-stats'>&#8595 <span class='{{$invoicesRapport['type']}}'>{{$invoicesRapport['percentageDifference']}}%</span> luna aceasta</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!--charts-flex-->
                
                <div class='detail-raport-hold'>

                    


                    @if ($invoiceGateInfos['invoicesArePaid']==true)
                    <p>Magazinul a incasat toate platile pentru vanzarile tale. Vom vira banii in maxim 7 zile lucratoare de la urcarea facturii.</p>
                    @else 
                    <p>Magazinul inca nu a incasat toate platile pentru vanzarile tale. Poti urca factura, iar noi te vom instiinta cand toate facturile sunt in casate si vom vira banii.</p>
                    @endif
                    
                </div>

            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop 