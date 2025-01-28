@extends('inc.layout')

@section('content')

    <section class='menu-space'></section>

    <section class='cart-section '>
        <div class='large-container'>
            <div class='order-success-container'>
                <h1>Eroare 404. Această pagină nu există.</h1>
                <h2><a href="{{ url('/') }}">Înapoi la site</a></h2>
            </div>
        </div><!--large-container-->
    </section>

@stop


@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection
