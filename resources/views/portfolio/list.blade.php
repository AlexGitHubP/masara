@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designeri-section general-styles'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{ route('portfolio.list') }}">Portofoliu</a>
                </li>
            </ul>
        </div>
        <h1>Portofoliu Masara</h1>
{{--        <p class='width60'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.</p>--}}
        <div class='main-listing blogList'>
            <div class='left-list-small'>
                <div class='blog-list-flex'>
                    @if ($items->total() > 0)
                        @foreach ($items as $article)
                            <div class="blog-element">
                                <div class="blog-item">
                                    <div class='blogDate'>
                                        <p>{{$article->publishedDay}}</p>
                                        <p>{{$article->publishedMonth}}</p>
                                    </div>
                                    <a href="{{$article->mainUrl}}" class="blog-image">
                                        <picture>
                                            <source media="(max-width:770px)" srcset="{{$article->mainImg}}">
                                            <img src="{{$article->mainImg}}" alt="Blog image: {{$article->name}}">
                                        </picture>
                                    </a>
                                    <div class="blog-content">
                                        <div class="blog-content-top">
                                            <a class='blogLink' href="{{$article->mainUrl}}">{{$article->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--blog-element-->
                        @endforeach

                    @else
                        <p class='bDiscl'>Nu exista articole.</p>
                    @endif
                </div><!--blog-list-flex-->
                {{ $items->links() }}
            </div>
            <div class='right-list-small'>
                <h2>Top produse:</h2>
                @foreach ($topProducts as $product)
                    <div class='product-element swiper-slide'>
                        <div class='product-item'>
                            <a href='{{$product->detail->main_url}}' class='product-image'>
                                <picture>
                                    <source media="(max-width:770px)" srcset="{{$product->detail->mainImg}}">
                                    <img src="{{$product->detail->mainImg}}" alt="Product {{$product->detail->name}} image">
                                </picture>
                            </span>
                            </a>
                            <div class='product-content'>
                                <div class='product-content-top'>
                                    <a href="{{$product->detail->main_url}}">{{$product->detail->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div><!--product-element swiper-slide-->
                @endforeach
            </div>
        </div>
    </div>

</section>
@stop 
