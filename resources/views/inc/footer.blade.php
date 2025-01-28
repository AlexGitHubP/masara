<footer>
    <div class='large-container'>
        <div class='top-footer'>
            <div class='footer-section s1'>
                <a href='' class='footer-logo'>
                    <img src="{{url('img/logo-footer.svg')}}" alt="">
                </a>
            </div>
            <div class='footer-section s2 flexed-column'>
                <div class='footer-column'>
                    <ul>
                        <li>
                            <a href="{{ route('terms.and.conditions') }}">Termeni și condiții</a>
                        </li>
                        <li>
                            <a href="{{ route('cookies.policy') }}">Politica cookies</a>
                        </li>
                        <li>
                            <a href="{{ route('gdpr.policy') }}">Politica GDPR</a>
                        </li>
                    </ul>
                </div>
                <div class='footer-column'>
                    <ul>
                        <li>
                            <a href="{{ route('masara.brand') }}">Brandul Masara</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class='footer-section s3'>
                <p>Abonează-te la newsletter</p>
                <form class='newsletter-subscribe' id='nlSubscribe' method="POST" action=''>
                    <div class='nl-input-hold'>
                        <input type="text" name="nl_email" id="nl_email" placeholder="Introdu adresa de email">
                        <input type="submit" value="Trimite" id='sendNl' data-method="POST" data-endpoint="{{ route('saveNewsletter') }}" data-form="nlSubscribe">
                        <div class='loader'>
                            <img src="{{url('img/loader.svg')}}" alt="">
                        </div>
                    </div>
                </form>
                <ul class='footer-social'>
                    <li>
                        <a href="https://www.facebook.com/masararomania" target='_blank'>
                            <img src="{{url('img/facebook.svg')}}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/masararomania/" target='_blank'>
                            <img src="{{url('img/instagram.svg')}}" alt="">
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="" target='_blank'>--}}
{{--                            <img src="{{url('img/linkedin.svg')}}" alt="">--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="" target='_blank'>--}}
{{--                            <img src="{{url('img/youtube.svg')}}" alt="">--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
        <div class='bottom-footer'>
            <div class='perfect-flex-hold vertical-align-center-flex'>
                <div class='perfect-left'>
                    <p>COPYRIGHT © <?php echo date("Y");?> MASARA</p>
                </div>
                <div class='perfect-right'>
                    <ul>
                        <li>
                            <a href="https://anpc.ro/" target='_blank'>
                                <img src="{{url('img/anpc.png')}}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="https://anpc.ro/ce-este-sal/" target='_blank'>
                                <img src="{{url('img/litigii.png')}}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
