<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductCategory extends Model
{
    protected $table = 'products_categories';
    const STATUS_HIDDEN = 'hidden';
    const STATUS_PUBLISHED = 'published';

    protected function seoUrl(): Attribute
    {
        return Attribute::make(
            get: function(){
                return route('category.list', ['category' => $this->category_url]);
            },
        );
    }

    public function withTypeFilter($type = Products::PRODUCT_TYPE_MASARA): string
    {
        return $this->seoUrl.'?product_type='.$type;
    }

    public function subcategories(){
        return $this->hasMany('Locomotif\Products\Models\ProductsSubcategories', 'category_id');
    }

    public function products(){
        return $this->belongsToMany('Locomotif\Products\Models\Products', 'products_to_categories', 'category_id', 'product_id')
            ->where('products.product_status', '=', 'published')->orderBy('products.ordering', 'DESC');
    }

    public function scopePublished($query, $status = self::STATUS_PUBLISHED){
        return $query->where('category_status', $status);
    }

}
