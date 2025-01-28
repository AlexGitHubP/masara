@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='cart-section '>
    <div class='large-container'>
        <div class='order-success-container'>
            @if (isset($moneyOrderDetails) && !empty($moneyOrderDetails))
            <h1>Comandă plasată cu succes!</h1>
            <h2>Te rog folosește ID-ul comenzii tale ca referință de plată.</h2>
            <div class='order-success-details'>
                <h4><strong>Id comandă:</strong> #{{$moneyOrderDetails['orderReference']}}</h4>
                <h4><strong>Firmă:</strong> {{$moneyOrderDetails['shopName']}}</h4>
                <h4><strong>Contact:</strong> {{$moneyOrderDetails['shopContact']}}</h4>
                <h4><strong>IBAN:</strong> {{$moneyOrderDetails['shopIBAN']}}</h4>
                <h4><strong>Bancă:</strong> {{$moneyOrderDetails['shopBank']}}</h4>
                <h4><strong>De plată:</strong> 50% din total, {{$moneyOrderDetails['payNow']}} RON</h4>
                <h2>Comanda ta va fi procesată după ce se plata este livrată în cont.</h2>
                <ul>
                    <li>
                        <a href="" target='_blank'>Conditii Livrare</a>
                    </li>
                    <li>
                        <a href="" target='_blank'>Politica Retur</a>
                    </li>
                    <li>
                        <a href="" target='_blank'>Termeni si conditii</a>
                    </li>
                </ul>
            </div>    
            @else
            <h1>Comandă plasată cu succes!</h1>
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor, diam in eleifend vehicula, quam lacus elementum nunc, eget tincidunt dui neque ut diam.</h2>
            <div class='order-success-details'>
                <h3>Comanda #1249342</h3>
                <ul>
                    <li>
                        <a href="" target='_blank'>Conditii Livrare</a>
                    </li>
                    <li>
                        <a href="" target='_blank'>Politica Retur</a>
                    </li>
                    <li>
                        <a href="" target='_blank'>Termeni si conditii</a>
                    </li>
                </ul>
            </div>
            @endif
            
        </div>
    </div><!--large-container-->
</section>

@stop 


@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
@endsection