@extends('inc.layout')

@section('content')

<section class='menu-space'></section>

<section class='designeri-section'>
    <div class='large-container'>
        <div class='breadcrumbs'>
            <ul>
                <li>
                    <a href="{{url('blog.html')}}">Blog</a>
                </li>
                <li>
                    <a href="{{$article->category->category_url}}">Categorie</a>
                </li>
                <li>
                    <a href="{{$article->mainUrl}}">Blog</a>
                </li>
            </ul>
        </div>
        
        <div class='main-listing blogDetail'>
            <div class='left-list'>
                <h3>Categorii blog</h3>
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
            <div class='center-list'>
                <div class='blog-detail-content'>
                    <div class='categoryTag'>
                        <span href='{{$article->category->category_url}}' class='catTag'>{{$article->category->category_name}}</span>
                    </div>
                    <h1>{{$article->name}}</h1>
                    <div class='featuredImage'>
                        <picture>
                            <source media="(max-width:770px)" srcset="{{$article->mainImg}}">
                            <img src="{{$article->mainImg}}" alt="Product image: {{$article->name}}">
                        </picture>
                    </div>
                    <div class='blogContent'>
                        {!!$article->description!!}
                    </div>
                </div><!--blog-list-flex-->
                
            </div><!--center-list-->
            <div class='right-list rightDetails'>
                <h3>Articole Recomandate</h3>
                @foreach ($relatedArticles as $article)
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
            </div>
        </div>
    </div>

</section>
@stop 
