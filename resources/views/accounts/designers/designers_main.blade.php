@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designeri-section general-styles'>
    <div class='small-container'>
        <h1>Designeri lorem ipsum</h1>
        <p class='width60'>Fiecare design devine o poveste, iar fiecare designer este arhitectul acestei povești. Alătură-te echipei noastre și contribuie la definirea viitorului designului de mobilier.</p>
    </div>

    <div class='large-container'>
        <div class='designers-list'>
            @foreach($designers as $key => $designer)
                <div class='designer-element'>
                    <a href='{{ $designer->nice_url }}' class='designer-item'>
                        <div class='designer-overlay'></div>
                        <div class='designer-image'>
                            <picture>
                                <source media="(max-width:770px)" srcset="{{ $designer->image }}">
                                <img src="{{ $designer->image }}" alt="Designer image">
                            </picture>
                        </div>
                        <div class='designer-list-content'>
                            <p>Designer Interior @ Good Design </p>
                            <p>{{ $designer->name }} {{ $designer->surname }}</p>
                        </div>
                    </a>
                </div><!--designer-element-->
            @endforeach
        </div><!--designers-list-->
    </div>

</section>


<section class='join-us'>
    <div class='small-container'>
        <div class='join-us-flex'>
            <div class='join-us-left'>
                <h2>Vrei sa faci parte din echipa noastra de designeri?</h2>
            </div>
            <div class='join-us-right'>
                <p>Ești invitat să faci parte din echipa noastră de designeri la Masara! Căutăm talente inovatoare care să aducă prospetime și inspirație în lumea mobilierului. Alătură-te nouă și împreună să creăm piese memorabile, unde fiecare design devine o expresie a talentului și stilului tău distinct. Fă primul pas către o colaborare creativă și trimite-ne portofoliul tău astăzi. Împreună, putem da viață la idei și transforma spațiile în opere autentice de artă funcțională!</p>
                <a href="{{route('contact')}}" class='general-btn'>Trimite mesaj</a>
            </div>
        </div>
    </div>
</section>

@stop
