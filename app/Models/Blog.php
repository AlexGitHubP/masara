<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Locomotif\Media\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Locomotif\Blog\Models\BlogCategories;

class Blog extends Model{

    protected $baseUrl = '/blog';
    protected $table = 'blog';

    

    static function getBlogCategory($productID){
        $blogToCat = DB::table('blog_to_categories')
                        ->select('category_id')
                        ->where('blog_id', $productID)
                        ->first();
        $category = DB::table('blog_categories')
                        ->where('id', $blogToCat->category_id)
                        ->first();
        return $category;
    }
    
    static function formatDate($dateTime){
        $dateTime = Carbon::parse($dateTime);
        $formattedDate = $dateTime->format('d M');
        return $formattedDate;
    }

    static function formatMonth($dateTime){
        $dateTime = Carbon::parse($dateTime);
        $formattedMonth = $dateTime->format('M');
        return $formattedMonth;
    }

    static function formatDay($dateTime){
        $dateTime = Carbon::parse($dateTime);
        $formattedDay = $dateTime->format('d');
        return $formattedDay;
    }
    static function buildBlogUrl($article, $category){
        $url = (new self())->baseUrl;
        if ($category) {
            $url .= '/' . $category->category_url;
        }
        $url .= '/'.$article->url.'.html';
    
        return $url;
    }
    static function prepareContent($string){
        // Remove <p>&nbsp;</p> tags
        $string = str_replace(['<br>', '</br>', '<p>&nbsp;</p>'], '', $string);

        return $string;
    }

    static function getAllCategories(){

        $categories = BlogCategories::where('status', '=', 'published')->orderBy('created_at', 'DESC')->get();
        $categories->map(function($category){
            $category->mainImg = Media::getMainImage($category->getTable(), $category->id, true);
            $category->category_description = Str::limit($category->category_description, 50);
            $category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        });
        
        return $categories;
    }

    static function getAllCategoriesExcept($categoryID, $pagination = false){

        $catQuery = BlogCategories::where('status', '=', 'published')
                        ->where('id', '!=', $categoryID)
                        ->orderBy('created_at', 'DESC');
        if($pagination!=false){
            $categories = $catQuery->paginate($pagination);
        }else{
            $categories= $catQuery->get();
        }
        
        $categories->map(function($category){
            $category->mainImg = Media::getMainImage($category->getTable(), $category->id, true);
            $category->category_description = Str::limit($category->category_description, 50);
            $category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        });
        
        return $categories;
    }
    

    static function getCategory($categorySeo){
        $category = BlogCategories::where('category_url', $categorySeo)->first();
        $category->main_category_url = (new self())->baseUrl.'/'.$category->category_url;
        $category->mainImg           = Media::getMainImage($category->getTable(), $category->id, true);
        return $category;
    }

    static function getAllBlogs(){

        $articles = Blog::where('status', '=', 'published')->orderBy('created_at', 'DESC')->paginate(6);
        $articles->map(function($article){
            $category = self::getBlogCategory($article->id);
            $article->mainImg = Media::getMainImage($article->getTable(), $article->id, true);
            $article->mainUrl = self::buildBlogUrl($article, $category);
            $article->short_description = Str::limit($article->short_description, 100);
            $article->publishedDay = self::formatDay($article->created_at);
            $article->publishedMonth = strtoupper(self::formatMonth($article->created_at));
            $article->category = $category;
            $article->category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        });
        
        return $articles;
    }
    

    static function getBlogsPerCategory($category){
        $articles =  $category->blogs()->paginate(6);
        $articles->map(function($article){
            $category = self::getBlogCategory($article->id);
            $article->mainImg = Media::getMainImage($article->getTable(), $article->id, true);
            $article->mainUrl = self::buildBlogUrl($article, $category);
            $article->short_description = Str::limit($article->short_description, 100);
            $article->publishedDay = self::formatDay($article->created_at);
            $article->publishedMonth = strtoupper(self::formatMonth($article->created_at));
            $article->category = $category;
            $article->category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        });
        
        return $articles;
    }

    static function getRelatedBlogs($category, $articleID){
        $articles =  $category->relatedBlogs($category->id, $articleID)->paginate(2);
        $articles->map(function($article){
            $category = self::getBlogCategory($article->id);
            $article->mainImg = Media::getMainImage($article->getTable(), $article->id, true);
            $article->mainUrl = self::buildBlogUrl($article, $category);
            $article->short_description = Str::limit($article->short_description, 100);
            $article->publishedDay = self::formatDay($article->created_at);
            $article->publishedMonth = strtoupper(self::formatMonth($article->created_at));
            $article->category = $category;
            $article->category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        });
        return $articles;
    }

    static function getBlogDetail($blogSEO){
        
        $article = Blog::where('url', '=', $blogSEO)->where('status', '=', 'published')->first();

        $category = self::getBlogCategory($article->id);
        $article->mainImg = Media::getMainImage($article->getTable(), $article->id, true);
        $article->mainUrl = self::buildBlogUrl($article, $category);
        $article->description = self::prepareContent($article->description);
        $article->publishedDay = self::formatDay($article->created_at);
        $article->publishedMonth = strtoupper(self::formatMonth($article->created_at));
        $article->category = $category;
        $article->category->category_url = (new self())->baseUrl.'/'.$category->category_url;
        
        return $article;
    }
    
}
