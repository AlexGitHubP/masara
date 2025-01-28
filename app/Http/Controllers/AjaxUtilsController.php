<?php

namespace App\Http\Controllers;

use App\Models\AjaxUtils;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxUtilsController extends Controller{

    public function getCityByCounty(Request $request){

        $county = $request->json()->all();
        $cityList = AjaxUtils::getCityByCounty($county['county']);

        return response()->json([
            'success' => true,
            'type'    => 'citySelector',
            'data'    => $cityList
        ]);
    }

    public function saveNewsletter(Request $request){

        $validator = Validator::make($request->all(), [
            'nl_email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }
        try{

            Newsletter::create([
                'nl_email' => $request->input('nl_email')
            ]);
            return response()->json([
                'success' => true,
                'type'    => 'standard',
                'message' => 'Te-ai abonat cu succes la newsletter.'
            ], 422);

        }catch(Exception $exception) {
            $errorCode = $exception->getCode();
            if($errorCode=='2002'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('A intervenit o eroare la abonare. Te rugăm încearcă din nou.')
                );
            }

            return response()->json($response);
        }
    }

}
