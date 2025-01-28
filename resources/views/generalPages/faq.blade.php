@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='faq-section'>
    <div class='small-container'>
        <h1>FAQ si informatii generale </h1>
        <h5>Echipa noastră dedicată este gata să te ghideze în alegerea meselor din lemn de stejar si lemn masiv, să răspundă la orice nelămurire și să asigure că experiența ta de cumpărături este plăcută și satisfăcătoare. La Masara, ne pasă de fiecare detaliu și suntem aici să facem ca fiecare pas în această călătorie să fie unul plăcut și inspirat.</h5>
        <div class='tags-hold'>
            <p>Tags</p>
            <ul>
                <li class='active-faq' data-tab='0'>
                    <a href="">General</a>
                </li>
{{--                <li data-tab='1'>--}}
{{--                    <a href="">Livrare</a>--}}
{{--                </li>--}}
{{--                <li data-tab='2'>--}}
{{--                    <a href="">Produse custom</a>--}}
{{--                </li>--}}
{{--                <li data-tab='3'>--}}
{{--                    <a href="">Livrare</a>--}}
{{--                </li>--}}
{{--                <li data-tab='4'>--}}
{{--                    <a href="">Produse custom</a>--}}
{{--                </li>--}}
            </ul>
        </div>
        <section class='menu-space'></section>
        <div class='faq-tabs'>
            

            <div class='tab-content tab-content-0'>
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
                <div class='faq-element'>
                    <h4>4. Care sunt cele mai potrivite dimensiuni pentru o masă?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Este important să luați în considerare dimensiunea încăperii și a altor obiecte de mobilier din încăpere atunci când alegeți dimensiunea unei mese. Este recomandat să aveți cel puțin 60 cm per persoană la o masă de dining, astfel încât oamenii să aibă suficient spațiu pentru a se așeza confortabil și pentru a manevra farfuria și paharul. </p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>5. Există opțiuni de culoare disponibile pentru masa?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Da, există mai multe opţiuni de culoare disponibile. Aici puteţi vedea o parte din culorile standard, disponibile: <a href="https://configurator.masara.ro/" target="_blank">configurator.masara.ro</a></p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>6. Cum se face curățarea și întreținerea mesei?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Pentru întreținerea obișnuită nu se folosesc substanțe abrazive nici apă foarte fierbinte. Masa se curăță cu apă caldă și detergent de vase sau săpun. Ștergerea se face cu cârpa sau un burete moale.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>7. Este montajul mesei dificil sau vine deja asamblată?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Montajul mesei este foarte simplu, aceasta nu vine direct asamblată. Blatul vine separat de picioare, împreuna cu o cheie şi şuruburile aferente.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>8. Există opțiuni personalizate sau posibilitatea de a comanda măsuri speciale?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Da, există opţiuni de personalizare atât pentru culori, textură, esenţă, etc ... cât şi pentru măsuri speciale.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>9. Care este termenul de livrare pentru masa comandată?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Termenul de livrare, este de aproximativ 20 zile lucrătoare pentru produsele standard. Pentru alte tipuri produse, timpul poate creşte.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>10.	Ce garanții oferiți pentru masa achiziționată?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Termenul de livrare, este de aproximativ 20 zile lucrătoare pentru produsele standard. Pentru alte tipuri produse, timpul poate creşte.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>11.	Este masa potrivită pentru uz comercial sau rezidențial?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Mesele noastre sunt potrivite atât pentru uz comercial cât şi pentru uz rezidenţial.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>12.	Pot să vă returnez masa în cazul în care nu sunt mulțumit de calitate sau aspect?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>În cazul în care masa nu corespunde condiţiilor de calitate transmise sau aspectul nu este conform solicitării, aceasta se poate returna.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>13.	Există produse complementare disponibile pentru masa respectivă?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Da, vă punem la dispoziţie kit-uri de întreţinere şi recondiţionare a meselor sau produselor din lemn masiv.</p>
                    </div>
                </div><!--faq-element-->
                <div class='faq-element'>
                    <h4>14.	Produceţi şi alte tipuri de mobilier?
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </h4>
                    <div class='faq-content'>
                        <p>Da, la comandă producem şi alte tipuri de mobilier. Începând de la proiecte complexe din domeniul HoReCa, până la proiecte complete de tip rezidenţial.</p>
                    </div>
                </div><!--faq-element-->
            </div><!--tab-content-->

{{--            <div class='tab-content tab-content-1'>--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 1?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 1?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--            </div><!--tab-content-->--}}

{{--            <div class='tab-content tab-content-2'>--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--            </div><!--tab-content-->--}}



{{--            <div class='tab-content tab-content-3'>--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}


{{--            </div><!--tab-content-->--}}


{{--            <div class='tab-content tab-content-4'>--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--                <div class='faq-element'>--}}
{{--                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit 2?--}}
{{--                        <span>--}}
{{--                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#262626" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                <path d="M8.46997 10.74L12 14.26L15.53 10.74" stroke="#262626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                    </h4>--}}
{{--                    <div class='faq-content'>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia facilisis lectus vitae mattis. Quisque interdum urna ut libero lobortis, ut luctus lectus fermentum. Ut dapibus, diam sit amet luctus consequat, purus odio aliquam ligula.</p>--}}
{{--                    </div>--}}
{{--                </div><!--faq-element-->--}}
{{--               --}}
{{--                --}}
{{--            </div><!--tab-content-->--}}

        </div>
        
        <div class='separator-small'></div>
        <div class='faq-more'>
            <div class='faq-more-constrain'>                
                <h2>Nu ai gasit raspunsul? Suntem aici pentru tine!</h2>
                <div class='perfect-flex-hold'>
                    <div class='perfect-left'>
                        <p>Fie că preferi să ne suni, să ne trimiți un e-mail sau să folosești formularul nostru de contact, suntem gata să răspundem la orice întrebare și să rezolvăm orice nelămurire. Experiența ta contează, iar noi suntem dedicați să facem tot posibilul pentru ca tu să te simți încrezător și mulțumit.</p>
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
                    </div>
                    <div class='perfect-right centered'>
                        <a href="{{route('contact')}}" class='general-btn'>Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop 