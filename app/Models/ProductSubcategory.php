<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class ProductSubcategory extends Model
{
    protected $table = 'products_subcategories';
    const STATUS_HIDDEN = 'hidden';
    const STATUS_PUBLISHED = 'published';

    protected function seoUrl(): Attribute
    {
        return Attribute::make(
            get: function(){
                return route('subcategory.list', ['category' => $this->category->category_url, 'subcategory' => $this->subcategory_url]);
            },
        );
    }

    public function withTypeFilter($type = Products::PRODUCT_TYPE_MASARA): string
    {
        return $this->seo_url.'?product_type='.$type;
    }

    public function category(){
        return $this->belongsTo('Locomotif\Products\Models\ProductsCategories', 'category_id');
    }

    public function products(){
        return $this->belongsToMany('Locomotif\Products\Models\Products', 'products_to_subcategories', 'subcategory_id', 'product_id')
            ->where('products.product_status', '=', 'published')->orderBy('products.ordering', 'DESC');
    }

    public function scopePublished($query, $status = self::STATUS_PUBLISHED){
        return $query->where('subcategory_status', $status);
    }
}
