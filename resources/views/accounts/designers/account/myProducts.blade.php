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
                <h1>Produsele mele</h1>
                @if (count($products) > 0)
                <div class='shop-list-flex'>
                   
                    @foreach ($products as $product)
                    <div class='product-element'>
                        <div class='product-item'>
                            <a href='{{$product->main_url}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{url($product->mainImg)}}">
                                    <img src="{{url($product->mainImg)}}" alt="Product image: {{$product->name}}">
                                </picture>
                                <span class='fav-btn'>
                                    <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12.3044" r="11.5" stroke="#909090"/>
                                        <path d="M12.372 17.9444C12.168 18.0185 11.832 18.0185 11.628 17.9444C9.888 17.3326 6 14.7803 6 10.4545C6 8.54494 7.494 7 9.336 7C10.428 7 11.394 7.54382 12 8.38427C12.606 7.54382 13.578 7 14.664 7C16.506 7 18 8.54494 18 10.4545C18 14.7803 14.112 17.3326 12.372 17.9444Z" fill="#909090" stroke="#909090" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>                                
                                </span>
                                <span class='new-tag {{$product->product_status}}'>
                                    <p>{{$product->product_status_nice}}</p>                      
                                </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="{{$product->main_url}}">{{$product->name}}</a>
                                    <div class='product-list-price'>
                                        <p>{{$product->price}} lei</p>
                                    </div>
                                </div>
                                <div class='product-content-bottom editProduct'>
                                    <a href="{{$product->main_url}}" class='general-btn'>Editează produs</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element-->
                    @endforeach
                    
                  
                </div><!--shop-list-flex-->
                @else
                    <p>Nu ai produse adaugate in cont. </p>
                @endif
                {{ $products->links() }}
            </div><!--dashboard-right-->
        </div>
    </div>

</section>


@stop 