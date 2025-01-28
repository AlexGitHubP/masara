<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'keywords',
        'canonical',
        'image',
        'created_at',
        'updated_at'
    ];

}
