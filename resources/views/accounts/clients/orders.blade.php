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
                <h1>Comenzile tale</h1>
                <div class='order-filter-flex'>
                    <div class='order-filter-left'>
                        <div class="input-hold">
                            <label for="period">Perioada</label>
                            <select name="period" id="period" value="">
                                <option value="">Alege perioada</option>
                                <option value="1luna">1 lună</option>
                                <option value="6luni">6 luni</option>
                                <option value="12luni">12 luni</option>
                            </select>
                        </div>
                    </div>
                    <div class='order-filter-right'>
                        <div class="input-hold">
                            <label for="sorder">Căutare</label>
                            <input type="text" name='product_name_search' id='product_name_search' placeholder="Caută după numele produsului">
                        </div>
                    </div>
                </div>
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
                                    <p>Status comanda: <span class='pending'>În procesare</span></p>
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
                                    <p>Status comanda: <span class='transit'>În tranzit</span></p>
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
                                    <p>Status comanda: <span class='canceled'>Anulată</span></p>
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
                <div class='separator-space'></div>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop 