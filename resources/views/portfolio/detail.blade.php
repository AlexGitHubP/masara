@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designeri-section'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{ route('portfolio.list') }}">Portofoliu</a>
                </li>
                <li>
                    <a href="{{$item->mainUrl}}">{{$item->name}}</a>
                </li>
            </ul>
        </div>
        
        <div class='main-listing blogDetail portfolioDetail'>
            <div class='center-list'>
                <div class='blog-detail-content'>
                    <h1>{{$item->name}}</h1>
                    <div class='featuredImage' href="{{$item->mainImg}}" data-fancybox="gallery">
                        <picture>
                            <source media="(max-width:770px)" srcset="{{$item->mainImg}}">
                            <img src="{{$item->mainImg}}" alt="Product image: {{$item->name}}">
                        </picture>
                    </div>
                    <div class='blogContent'>
                        {!!$item->description!!}
                    </div>

                    <h2>Imagini:</h2>
                    <div class="flexed-images">
                    @foreach($portfolioImages as $key => $value)
                        @if($key != 0)
                                <div href="{{$value->file}}" data-fancybox="gallery" class='portfolio-image'>
                                    <picture>
                                        <source media="(max-width:770px)" srcset="{{$value->file}}">
                                        <img src="{{$value->file}}" alt="Portfolio image: {{$value->original_name}}">
                                    </picture>
                                </div>
                        @endif
                    @endforeach
                    </div>

                </div><!--blog-list-flex-->
                
            </div><!--center-list-->
            <div class='right-list rightDetails'>
                <h2>Client: {{ $item->client }}</h2>
                <h3><strong>Designer:</strong> {{ $item->designer }}</h3>
                <h4><strong>Materiale:</strong> {{ $item->materials }}</h4>
                <h5><a href="{{ $item->external_link }}" target="_blank"><strong>Link:</strong> {{ $item->external_link }}</a></h5>
            </div>
        </div>
    </div>

</section>
@stop

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

    <script>
        document.addEventListener("DOMContentLoaded",function(){
            Fancybox.bind('[data-fancybox="gallery"]', {
                // Your custom options for a specific gallery
            });
        });
    </script>
@endsection