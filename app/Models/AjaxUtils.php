<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AjaxUtils extends Model{


    static function getCityByCounty($county){
        $cityList = DB::table('localitati')
                      ->select('denumire')
                      ->distinct()
                      ->where('judet', $county)
                      ->orderBy('denumire', 'ASC')
                      ->get();
        return $cityList;
    }

}
