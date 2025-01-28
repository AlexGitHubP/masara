@extends('inc.layout')

@section('content')


<section class='about-us-section'>
    <div class='large-container maxHeight relative'>
        <div class='about-us-img'>
            <picture>
                <source media="(max-width:770px)" srcset="{{url('img/aboutUs.jpg')}}">
                <img src="{{url('img/aboutUs.jpg')}}" alt="AboutUs image">
            </picture>
        </div>
    </div>
    <div class='about-us-content'>
        <div class='small-container relative'>
            <h1>Despre noi</h1>
            <p>Cu buchetul de cunostinte acumulat de-a lungul timpului si materia prima la indemana, am decis sa impartasim cele mai bune solutii, prin aceste produse.</p>
            <div class='about-us-holder'>
{{--                <ul>--}}
{{--                    <li>--}}
{{--                        <a href="">Echipa</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="">Brandul MASARA</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
                <div class='years-hold'>
                    <p>7</p>
                    <p>ani în industria lemnului</p>
                </div>
            </div>
        </div>
    </div>
</section>


{{--<section class='guarantee-section'>--}}
{{--    <div class='small-container'>--}}
{{--        <h2>Garanția noastră</h2>--}}
{{--        <div class='perfect-flex-hold'>--}}
{{--            <div class='perfect-left'>--}}
{{--                <div class='guarantee-element'>--}}
{{--                    <h3>Plata in siguranta</h3>--}}
{{--                    <p>Poti plati in siguranta, fara nici un fel de grija. Datele tale sunt confidentiale si nu le stocam. Suntem in conformitate cu noul regulament european GDPR.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class='perfect-right'>--}}
{{--                <div class='guarantee-element'>--}}
{{--                    <h3>Plata in siguranta</h3>--}}
{{--                    <p>Poti plati in siguranta, fara nici un fel de grija. Datele tale sunt confidentiale si nu le stocam. Suntem in conformitate cu noul regulament european GDPR.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class='perfect-left'>--}}
{{--                <div class='guarantee-element'>--}}
{{--                    <h3>Plata in siguranta</h3>--}}
{{--                    <p>Poti plati in siguranta, fara nici un fel de grija. Datele tale sunt confidentiale si nu le stocam. Suntem in conformitate cu noul regulament european GDPR.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class='perfect-right'>--}}
{{--                <div class='guarantee-element'>--}}
{{--                    <h3>Plata in siguranta</h3>--}}
{{--                    <p>Poti plati in siguranta, fara nici un fel de grija. Datele tale sunt confidentiale si nu le stocam. Suntem in conformitate cu noul regulament european GDPR.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}


<section class='about-us-extra'>
    <div class='small-container'>
        <h2>Producem minunatii din lemn masiv, cu brandul Masara, chiar in inima <span>Transilvaniei.</span></h2>
    </div>
</section>

<section class='mood-two'>
    <div class='large-container maxHeight relative'>
        <div class='mood-two-overlay'></div>
        <div class='mood-two-img'>
            <picture>
                <source media="(max-width:770px)" srcset="{{url('img/mood2.jpg')}}">
                <img src="{{url('img/mood2.jpg')}}" alt="Mood2 image">
            </picture>
        </div>
        <div class='mood-two-content'>
            <div class='small-container'>
                <a href="{{route('shop')}}" class='general-btn'>Vezi produsele</a>
                <p>In urma unei experiente de 7 ani in industria lemnului, producand mii de blaturi de mese, apare o intrebare: unde este masa noastra?</p>
                <p>Toate mesele sunt executate din materiale de cea mai buna calitate, de la picioarele din inox satinat sau vopsite in camp electrostatic, alternativa ecologica a vopselei clasice, pana la blaturile atent selectionate si special concepute, finisate cu uleiuri ecologice.</p>
            </div>
        </div>
    </div>
</section>

<section class='our-team'>
    <div class='small-container'>
        <h2>Echipa noastră</h2>
    </div>
{{--    <div class='large-container'>--}}
{{--        <div class='team-flex'>--}}
{{--            <div class='team-hold'>--}}
{{--                <div class='team-item'>--}}
{{--                    <div class='team-img'>--}}
{{--                        <picture>--}}
{{--                            <source media="(max-width:770px)" srcset="{{url('img/team1.jpg')}}">--}}
{{--                            <img src="{{url('img/team1.jpg')}}" alt="Team 1 image">--}}
{{--                        </picture>--}}
{{--                    </div>--}}
{{--                    <div class='team-content'>--}}
{{--                        <p>Andrei Popescu</p>--}}
{{--                        <p>CEO, Founder</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!--team-hold-->--}}

{{--            <div class='team-hold'>--}}
{{--                <div class='team-item'>--}}
{{--                    <div class='team-img'>--}}
{{--                        <picture>--}}
{{--                            <source media="(max-width:770px)" srcset="{{url('img/team2.jpg')}}">--}}
{{--                            <img src="{{url('img/team2.jpg')}}" alt="Team 2 image">--}}
{{--                        </picture>--}}
{{--                    </div>--}}
{{--                    <div class='team-content'>--}}
{{--                        <p>Andrei Popescu</p>--}}
{{--                        <p>CEO, Founder</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!--team-hold-->--}}

{{--            <div class='team-hold'>--}}
{{--                <div class='team-item'>--}}
{{--                    <div class='team-img'>--}}
{{--                        <picture>--}}
{{--                            <source media="(max-width:770px)" srcset="{{url('img/team3.jpg')}}">--}}
{{--                            <img src="{{url('img/team3.jpg')}}" alt="Team 3 image">--}}
{{--                        </picture>--}}
{{--                    </div>--}}
{{--                    <div class='team-content'>--}}
{{--                        <p>Andrei Popescu</p>--}}
{{--                        <p>CEO, Founder</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!--team-hold-->--}}

{{--            <div class='team-hold'>--}}
{{--                <div class='team-item'>--}}
{{--                    <div class='team-img'>--}}
{{--                        <picture>--}}
{{--                            <source media="(max-width:770px)" srcset="{{url('img/team4.jpg')}}">--}}
{{--                            <img src="{{url('img/team4.jpg')}}" alt="Team 4 image">--}}
{{--                        </picture>--}}
{{--                    </div>--}}
{{--                    <div class='team-content'>--}}
{{--                        <p>Andrei Popescu</p>--}}
{{--                        <p>CEO, Founder</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!--team-hold-->--}}
{{--        </div><!--team-flex-->--}}
{{--    </div>--}}
    <div class='small-container spacedTop'>
        <p>Fiecare piesă de mobilier Masara își găsește rădăcinile în viziunile creative ale designerilor noștri. Cu abilități remarcabile și imaginație debordantă, acești profesioniști transformă idei în opere de artă funcționale, aducând unicitate și stil în fiecare creație. Cu o atenție la detalii deosebită, transformăm lemnul de cea mai înaltă calitate în piese de mobilier durabile și remarcabile.</p>
    </div>
</section>

<div class='separator-large'></div>
<section class='small-faq'>
    <div class='small-container'>
        <div class='perfect-flex-hold'>
            <div class='perfect-left small-faq-list-left'>
{{--                <h3>Lorem ipsum dolor sit amet</h3>--}}
                <div class='faq-element'>
                    <h4>1. Care este materialul principal din care este făcută masa?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Materialul principal din care sunt executate produsele noastre, este stejarul.</p>
                    </div>
                </div><!--faq-element-->

                <div class='faq-element'>
                    <h4>2. Care sunt tipurile de material lemnos cu care lucraţi?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Tipurile de material cu care lucrăm, sunt următoarele: stejar, nuc american, frasin, molid, lemn termotratat, MDF furniruit, panel furniruit.</p>
                    </div>
                </div><!--faq-element-->

                <div class='faq-element'>
                    <h4>3. Este masa potrivită pentru uz interior sau exterior?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Mesele şi produsele noastre sunt potrivite atât pentru interior cât si pentru exterior. Tot ce trebuie să faceţi, este să precizaţi unde vor fi folosite şi venim cu cele mai bune soluţii.</p>
                    </div>
                </div><!--faq-element-->
                
            </div>
            <div class='perfect-right small-faq-list-right'>
                <h2>FAQ si informatii generale </h2>
                <p>Echipa noastră dedicată este gata să te ghideze în alegerea meselor din lemn de stejar si lemn masiv, să răspundă la orice nelămurire și să asigure că experiența ta de cumpărături este plăcută și satisfăcătoare. La Masara, ne pasă de fiecare detaliu și suntem aici să facem ca fiecare pas în această călătorie să fie unul plăcut și inspirat.</p>
                <a href="{{route('faq')}}">Vezi întrebări frecvente</a>
            </div>
        </div>
    </div>
</section>

@stop 