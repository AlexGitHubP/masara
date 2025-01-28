@extends('inc.layout')

@section('content')

<section class='menu-space'></section>
<section class='create-account'>
    <div class='large-container'>
        <div class='create-account-hold'>
            <h1>Creează cont client</h1>
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor, diam in eleifend vehicula, quam lacus elementum nunc, eget tincidunt dui neque ut diam.</p>--}}
            <form action="" method='POST' id='creeateClientAccountForm' autocomplete="off">
                @csrf
                <input type="hidden" name='accountType' id='accountType' value='{{$accountType}}'>
                <div class="perfect-flex-hold normalise">
                    <div class="perfect-left">
                        <div class="input-hold">
                            <label for="name">Nume</label>
                            <input type="text" name="name" id="name" value="">
                        </div>
                    </div>
                    <div class="perfect-right">
                        <div class="input-hold">
                            <label for="surname">Prenume</label>
                            <input type="text" name="surname" id="surname" value="">
                        </div>
                    </div>
                </div>

                <div class="perfect-flex-hold normalise">
                    <div class="perfect-left">
                        <div class="input-hold">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="">
                        </div>
                    </div>
                    <div class="perfect-right">
                        <div class="input-hold">
                            <label for="phone">Telefon</label>
                            <input type="text" name="phone" id="phone" value="">
                        </div>
                    </div>
                </div>

                <div class="input-hold">
                    <label for="password">Parola</label>
                    <input type="password" name="password" id="password" value="">
                </div>
                <div class="input-hold">
                    <label for="password_confirmation">Confirmă parola</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="">
                </div>
                <div class="input-hold checkbox-hold">
                    <label for="terms">Sunt de acord cu <a href="{{route('terms.and.conditions')}}" target="_blank">termenii si conditiile</a>.</label>
                    <input type="checkbox" name="terms" id="terms" value="">
                    <div class="fake-check"></div>
                </div>
                <div class="input-hold checkbox-hold">
                    <label for="nl">Vreau să mă abonez la newsletter.</label>
                    <input type="checkbox" name="nl" id="nl" value="">
                    <div class="fake-check"></div>
                </div>
                <div class='create-account-btn-hold relative'>
                    <input type="submit" value='Creează cont' class='general-btn' id='creeateClientAccount' data-endpoint='/login/creeaza-cont-client.html' data-method='POST' data-form='creeateClientAccountForm'>
                    <div class='loader'>
                        <img src="{{url('img/loader.svg')}}" alt="">
                    </div>
                </div>
                <p class='alreadyAccount'>Ai deja cont? <a href='{{url('login.html')}}'>Intră în cont aici</a>.</p>

            </form>
        </div>
    </div>
</section>
@stop 