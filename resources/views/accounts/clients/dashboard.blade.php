@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='client-account'>
    <div class='large-container'>
        <div class='dashboard-flex'>
            <div class='dashboard-left'>
                <div class='dashboard-left-content'>
                    @include('accounts.clients.clients_left_menu')
                </div>
            </div>
            <div class='dashboard-right'>
                <h1>Ultimele 2 comenzi</h1>
                <div class='my-orders-hold'>
                    <div class='order-element'>
                        <div class='order-item'>
                            <div class='order-item-left'>
                                <div class='order-item-img'>
                                    <img src="{{url('img/order.jpg')}}" alt="">
                                </div>
                            </div><!--order-item-left'-->
                            <div class='order-item-right'>
                                <div class='order-item-content'>
                                    <h2>Comanda #530693</h2>
                                    <h3>Comanda plasata pe 7 ianuarie 2023</h3>
                                    <p>Total: 6530 Lei</p>
                                    <p>Status comanda: <span class='delivered'>Livrat</span></p>
                                </div>
                                <ul class='follow-order'>
                                    <li>
                                        <a href="">Vezi detalii</a>
                                    </li>
                                    <li>
                                        <a href="">Urmărește livrarea</a>
                                    </li>
                                </ul>
                            </div><!--order-item-right-->
                        </div>
                    </div><!--order-element-->

                    <div class='order-element'>
                        <div class='order-item'>
                            <div class='order-item-left'>
                                <div class='order-item-img'>
                                    <img src="{{url('img/order.jpg')}}" alt="">
                                </div>
                            </div><!--order-item-left'-->
                            <div class='order-item-right'>
                                <div class='order-item-content'>
                                    <h2>Comanda #530693</h2>
                                    <h3>Comanda plasata pe 7 ianuarie 2023</h3>
                                    <p>Total: 6530 Lei</p>
                                    <p>Status comanda: <span class='delivered'>Livrat</span></p>
                                </div>
                                <ul class='follow-order'>
                                    <li>
                                        <a href="">Vezi detalii</a>
                                    </li>
                                    <li>
                                        <a href="">Urmărește livrarea</a>
                                    </li>
                                </ul>
                            </div><!--order-item-right-->
                        </div>
                    </div><!--order-element-->

                    
                </div><!--my-orders-hold-->
                <div class='separator-space'></div>
                <div class='perfect-flex-hold'>
                    <div class='perfect-left'>
                        <div class='infos-panel'>
                            <h2>Adresa de livrare</h2>
                            <h3>Adresa salvată</h3>
                            <p>Bulevardul Barbu Vacarescu,  Numaru 90, Bloc X, Scara 2, Etaj 7, Apartament 64, Interfon 112, Bucureşti (Sectorul 2), Bucureşti</p>
                            <p><strong>Persoana de contact:</strong> Andrei Popescu</p>
                            <a href="">Editează adresa de livrare</a>
                        </div><!--infos-panel-->
                    </div>
                    <div class='perfect-right'>
                        <div class='infos-panel'>
                            <h2>Date de facturare</h2>
                            <h3>Persoană fizică</h3>
                            <p>Bulevardul Barbu Vacarescu,  Numaru 90, Bloc X, Scara 2, Etaj 7, Apartament 64, Interfon 112, Bucureşti (Sectorul 2), Bucureşti</p>
                            <p><strong>Persoana de contact:</strong> Andrei Popescu - <strong>0909090909</strong></p>
                            <a href="">Editează datele de facturare</a>
                        </div><!--infos-panel-->
                    </div>
                </div>
                <div class='separator-space'></div>
                <div class='separator-space'></div>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop 