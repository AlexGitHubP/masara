<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart as CartModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   public function __construct(){
      $cartInfos = CartModel::getCart();
      view()->share(compact('cartInfos'));
   }

   public function list(){
      
      $articles   = Blog::getAllBlogs();
      $categories = Blog::getAllCategories();
      return view('blog.list')
         ->with(compact('articles'))
         ->with(compact('categories'));
   }

   public function category(Request $request, $categorySeo){
      
      $category   = Blog::getCategory($categorySeo);
      $articles   = Blog::getBlogsPerCategory($category);
      $categories = Blog::getAllCategoriesExcept($category->id);
      
      return view('blog.category')
         ->with(compact('category'))
         ->with(compact('articles'))
         ->with(compact('categories'));
   }

   public function detail(Request $request, $categorySeo, $blogSeo){
      
      $category        = Blog::getCategory($categorySeo);
      $article         = Blog::getBlogDetail($blogSeo);
      $relatedArticles = Blog::getRelatedBlogs($category, $article->id);
      $categories      = Blog::getAllCategoriesExcept($category->id, 2);

      return view('blog.detail')
         ->with(compact('category'))
         ->with(compact('article'))
         ->with(compact('relatedArticles'))
         ->with(compact('categories'));
     }
}
