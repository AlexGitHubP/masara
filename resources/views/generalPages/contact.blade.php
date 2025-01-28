@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='contact-section general-styles'>
    <div class='large-container'>
        <div class='perfect-flex-hold'>
            <div class='perfect-left'>
                <h1>Suntem aici pentru tine!</h1>
                <p>Indiferent dacă explorezi colecțiile noastre variate, ai întrebări despre produse sau ai nevoie de asistență în procesul de achiziție, nu ezita să ne contactezi!</p>
                <ul>
                    <li>
                        <a href="mailto:office@masara.ro" target='_blank' class='office'>office@masara.ro</a>
                    </li>
                    <li>
                        <a href="tel:+40700234777" target='_blank'>+40(700)234777</a>
                    </li>
                    <li>
                        <a href="https://www.google.com/maps/place/46%C2%B010'26.2%22N+23%C2%B055'50.1%22E/@46.1739479,23.9299401,197m/data=!3m2!1e3!4b1!4m4!3m3!8m2!3d46.173947!4d23.9305838?entry=ttu" target='_blank'>Lt. N. V. Popa, 8, Blaj, Alba, 515400</a>
                    </li>
                </ul>

                <form action="" method='POST' class='contact-form' id='contactForm'>
                    <input type="hidden" name="source" id="source" value="contactPage">
                    <div class='input-hold'>
                        <label for="name">Nume</label>
                        <input type="text" name="name" id="name" value=''>
                    </div>
                    <div class='input-hold'>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value=''>
                    </div>
                    <div class='input-hold'>
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" id="phone" value=''>
                    </div>
                    <div class='perfect-flex-hold normalise'>
                        <div class='perfect-left'>
                            <div class='input-hold'>
                                <label for="county">Județ</label>
                                <select name="county" id="county" value="" class='changeCounty'>
                                    <option value="">Alege Județ</option>
                                    @foreach ($judete as $judet)
                                        <option value="{{$judet->judet}}">{{$judet->judet}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='perfect-right'>
                            <div class='input-hold'>
                                <label for="city">Localitate/Oraș</label>
                                <select name="city" id="city" value="" class='changeCity'>
                                    <option value="">Alege un Județ pentru lista de orașe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='input-hold'>
                        <label for="subject">Subiect</label>
                        <select name="subject" id="subject" value=''>
                            <option value="">Alege subiect</option>
                            <option value="colaborare">Colaborare cu MASARA</option>
                            <option value="probleme">Probleme cu site-ul</option>
                            <option value="altul">Altele</option>
                        </select>
                    </div>
                    <div class='input-hold'>
                        <label for="message">Mesaj</label>
                        <textarea name="message" id="message" value=''></textarea>
                    </div>
                    <div class='input-hold checkbox-hold'>
                        <label for="terms">Sunt de acord cu <a href='{{route('terms.and.conditions')}}' target='_blank'>termenii si conditiile</a>.</label>
                        <input type="checkbox" name="terms" id="terms" value=''>
                        <div class='fake-check'></div>
                    </div>
                    <div class='input-hold checkbox-hold'>
                        <label for="gdpr">Sunt de acord cu <a href='{{route('gdpr.policy')}}' target='_blank'>politica de prelucrare a datelor</a>.</label>
                        <input type="checkbox" name="gdpr" id="gdpr" value=''>
                        <div class='fake-check'></div>
                    </div>
                    <div class='input-hold checkbox-hold'>
                        <label for="nl">Vreau să mă abonez la newsletter.</label>
                        <input type="checkbox" name="nl" id="nl" value=''>
                        <div class='fake-check'></div>
                    </div>
                    <div class='submit-btn-hold'>
                        <input type="submit" value='Trimite mesaj' id='sendContact' class='general-btn' data-endpoint="{{ route('saveLead') }}" data-form="contactForm" data-method="POST">
                        <div class='loader'>
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                    </div>
                </form>
            </div>
            <div class='perfect-right'>
                <div class='contact-image'>
                    <picture>
                        <source media="(max-width:770px)" srcset="{{url('img/contact.jpg')}}">
                        <img src="{{url('img/contact.jpg')}}" alt="Contact image">
                    </picture>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
