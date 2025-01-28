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
                <h1>Produse favorite</h1>
                <div class='shop-list-flex'>

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='{{url('categorii.html')}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url('img/prod1.png')}}">
                                    <img src="{{url('img/prod1.png')}}" alt="Product image">
                                </picture>
                                <span class='fav-btn added'>
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
                                    <a href="">Leick Solid Ash Mission Console Table</a>
                                    <div class='product-list-price'>
                                        <p>3.826 lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom'>
                                    <a href="">Adaugă în coș</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->

                  
                </div><!--shop-list-flex-->
                <div class='pagination-hold'>
                    <ul>
                        <li>
                            <a href="" class='prevPage'>
                                <svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.99984 16.92L1.47984 10.4C0.709844 9.62996 0.709844 8.36996 1.47984 7.59996L7.99984 1.07996" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="">1</a>
                        </li>
                        <li>
                            <a href="">2</a>
                        </li>
                        <li>
                            <a href="">3</a>
                        </li>
                        <li>
                            <a href="">4</a>
                        </li>
                        <li>
                            <a href="">5</a>
                        </li>
                        <li>
                            <a href="">...</a>
                        </li>
                        <li>
                            <a href="">25</a>
                        </li>
                        <li>
                            <a href="" class='nextPage'>
                                <svg viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.00016 1.08004L7.52016 7.60004C8.29016 8.37004 8.29016 9.63004 7.52016 10.4L1.00016 16.92" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                    
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop 