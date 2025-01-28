@extends('inc.layout')

@section('content')

<section class='menu-space'></section>
<section class='login-section'>
    <div class='large-container maxHeight'>
        <div class='perfect-flex-hold noPadding maxHeight vertical-align-center-flex'>
            <div class='perfect-left maxHeight'>
                <div class='login-welcome'>
                    <div class='login-welcome-content'>
                        <h1>Bine ai venit!</h1>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor, diam in eleifend vehicula, quam lacus elementum nunc, eget tincidunt dui neque ut diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor, diam in eleifend vehicula, quam lacus elementum nunc, eget tincidunt dui neque ut diam.</p>--}}
                        <ul>
                            <li>
                                <a href="{{route('terms.and.conditions')}}">Condiții livrare</a>
                            </li>
                            <li>
                                <a href="{{route('terms.and.conditions')}}">Politica de retur</a>
                            </li>
                            <li>
                                <a href="{{route('terms.and.conditions')}}">Termeni și condiții</a>
                            </li>
                        </ul>
                        <div class='masara-round'>
                            <img src="{{url('img/masara-round.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class='perfect-right'>
                <div class='login-holder'>
                    <form action="" method='POST' id='loginForm'>
                        @csrf
                        <div class="input-hold">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="">
                        </div>
                        <div class="input-hold small-margin-bottom">
                            <label for="password">Parola</label>
                            <input type="password" name="password" id="password" value="">
                        </div>
{{--                        <p class='disclaimer'>Ai uitat parola? <a href=''>Resetează parola</a>.</p>--}}
                        <div class="input-hold checkbox-hold login-checker">
                            <label for="keep_login">Ține-mă minte.</label>
                            <input type="checkbox" name="keep_login" id="keep_login" value="">
                            <div class="fake-check"></div>
                        </div>
                        <div class='login-btn-hold relative'>
                            <input type="submit" value='Intră în cont' class="general-btn" id='submitLogin' data-endpoint='/client/login.html' data-method='POST' data-form='loginForm'>
                            <div class='loader'>
                                <img src="{{url('img/loader.svg')}}" alt="">
                            </div>
                        </div>
                    </form>
                    <div class='login-content'>
                        <h2>Nu ai cont? Creeaza unul acum:</h2>
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor, diam in eleifend vehicula, quam lacus elementum nunc, eget tincidunt dui neque ut diam.</p>--}}
                        <div class='login-account-btns'>
                            <a href="{{url('login/creeaza-cont-client.html')}}" class='general-btn transparent-btn'>Creeaza cont client</a>
                            <a href="{{url('login/creeaza-cont-designer.html')}}" class='general-btn transparent-btn'>Creeaza cont designer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class='separator-space'></div>
<div class='separator-space'></div>

@stop 