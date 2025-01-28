@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designeri-section general-styles'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('blog.html')}}">Blog</a>
                </li>
            </ul>
        </div>
        <h1>Articole blog</h1>
        <p class='width60'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam congue, dolor et pharetra consequat, dui enim interdum justo, vitae gravida massa est eu elit.</p>
        <div class='main-listing blogList'>
            <div class='left-list'>
                @foreach ($categories as $category)
                <div class="blog-category-element">
                    <div class="category-item">
                        <a href="{{$category->category_url}}" class="blog-image">
                            <picture>
                                <source media="(max-width:770px)" srcset="{{$category->mainImg}}">
                                <img src="{{$category->mainImg}}" alt="Category image: {{$category->category_name}}">
                            </picture>
                            <div class='blog-category-tag'>
                                <span class='catTag'>{{$category->category_name}}</span>
                            </div>
                        </a>
                    </div>
                </div><!--blog-element-->
                @endforeach
            </div>
            <div class='right-list'>
                <div class='blog-list-flex'>
                    @if ($articles->total() > 0)
                    @foreach ($articles as $article)
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
                                    <div class='blog-category-tag'>
                                        <a href='{{$article->category->category_url}}'>{{$article->category->category_name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--blog-element-->
                    @endforeach

                    @else
                    <p class='bDiscl'>Nu exista articole.</p>
                    @endif
                </div><!--blog-list-flex-->
                {{ $articles->links() }}
                
            </div>
        </div>
    </div>

</section>
@stop 
