@include('inc.menu_main')
@php
$cartExists = (isset($cartInfos['cartItems']) && count($cartInfos['cartItems']) > 0) ? true : false;
$cartFunnel = (isset($cartFunnel) && $cartFunnel==true) ? true : false;
@endphp
<div class='menu-compensator' id='compensator'></div>
<section class='site-menu' id='site-menu'>
    <div class='large-container relative'>
        @include('inc.cart_offcanvas')

        <div class='navhold'>
            <div class='nav1'>
                <button class="hamburger hamburger--collapse" type="button" aria-label="Menu" aria-controls="navigation" aria-expanded="true/false">
                    <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                    </span>
                </button>
                <a href="{{ route('shop') }}">Shop</a>
            </div>
            <div class='nav2'>
                <a href="{{ url('/') }}" class='logo'>
                    <img src="{{url('img/logo.svg')}}" alt="">
                </a>
            </div>
            <div class='nav3'>
{{--                <form class='main-search' method='POST' action="" id='site-search'>--}}
{{--                    <div class='search-hold'>--}}
{{--                        <input type="text" name='search' id='search' placeholder="Caută produs">--}}
{{--                        <input type="submit" value="Caută" id='searchSubmit'/>--}}
{{--                    </div>--}}
{{--                    <div class="search-toggle">--}}
{{--                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            <path d="M22 22L20 20" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <ul>
                    <li class='has-elements-in-cart @if ($cartFunnel==true || $cartExists==false) blockOffcanvas @endif'>
                        <a href="{{url('/cos/produse.html')}}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 7.67001V6.70001C7.5 4.45001 9.31 2.24001 11.56 2.03001C14.24 1.77001 16.5 3.88001 16.5 6.51001V7.89001" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.00007 22H15.0001C19.0201 22 19.7401 20.39 19.9501 18.43L20.7001 12.43C20.9701 9.98997 20.2701 7.99997 16.0001 7.99997H8.00007C3.73007 7.99997 3.03007 9.98997 3.30007 12.43L4.05007 18.43C4.26007 20.39 4.98007 22 9.00007 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.4956 12H15.5046" stroke="#262626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.49439 12H8.50337" stroke="#262626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>

                        @if ( $cartExists && $cartFunnel==false )
                        <div class='cart-nr'>
                            <span>{{count($cartInfos['cartItems'])}}</span>
                        </div>
                        @endif

                    </li>
                    <li>
                        <a href="{{url('login.html')}}">
                            <svg viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.5607 13.936C13.4767 13.924 13.3687 13.924 13.2727 13.936C11.1607 13.864 9.48071 12.136 9.48071 10.012C9.48071 7.84002 11.2327 6.07602 13.4167 6.07602C15.5887 6.07602 17.3527 7.84002 17.3527 10.012C17.3407 12.136 15.6727 13.864 13.5607 13.936Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.5049 21.856C19.3689 23.812 16.5369 25 13.4169 25C10.2969 25 7.46486 23.812 5.32886 21.856C5.44886 20.728 6.16886 19.624 7.45286 18.76C10.7409 16.576 16.1169 16.576 19.3809 18.76C20.6649 19.624 21.3849 20.728 21.5049 21.856Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13.4167 25C20.0442 25 25.4167 19.6274 25.4167 13C25.4167 6.37258 20.0442 1 13.4167 1C6.78933 1 1.41675 6.37258 1.41675 13C1.41675 19.6274 6.78933 25 13.4167 25Z" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
