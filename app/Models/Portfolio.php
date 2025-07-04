<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Locomotif\Media\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Locomotif\Blog\Models\BlogCategories;

class Portfolio extends Model{

    protected $baseUrl = '/portofoliu';
    protected $table = 'portfolio';


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
    static function buildPortfolioUrl($article){
        $url = (new self())->baseUrl;
        $url .= '/'.$article->url.'.html';

        return $url;
    }
    static function prepareContent($string){
        $string = str_replace(['<br>', '</br>', '<p>&nbsp;</p>'], '', $string);

        return $string;
    }

    static function getallPortfolios(){

        $items = Portfolio::where('status', '=', 'published')->orderBy('created_at', 'ASC')->paginate(20);
        $items->map(function($item){
            $item->mainImg = Media::getMainImage($item->getTable(), $item->id, true);
            $item->mainUrl = self::buildPortfolioUrl($item);
            $item->short_description = Str::limit($item->short_description, 100);
            $item->publishedDay = self::formatDay($item->created_at);
            $item->publishedMonth = strtoupper(self::formatMonth($item->created_at));
        });

        return $items;
    }

    static function getDetail($seo){

        $item = Portfolio::where('url', '=', $seo)->where('status', '=', 'published')->first();

        $item->mainImg = Media::getMainImage($item->getTable(), $item->id, true);
        $item->mainUrl = self::buildPortfolioUrl($item);
        $item->description = self::prepareContent($item->description);
        $item->publishedDay = self::formatDay($item->created_at);
        $item->publishedMonth = strtoupper(self::formatMonth($item->created_at));

        return $item;
    }

    static function getPortfolioImages($seo)
    {
        $item = Portfolio::where('url', '=', $seo)->where('status', '=', 'published')->first();
        $media = Media::where('owner',    '=', $item->getTable())
                        ->where('owner_id', '=', $item->id)
                        ->orderBy('ordering_owner', 'asc')
                        ->get();
        foreach ($media as $key => $value) {
            $media[$key]->file = '/'.$value->folder.'/'.$value->file;
        }

        return $media;
    }

}
