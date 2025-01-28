<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    public function saveLead(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'county' => 'required',
            'city' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'terms' => 'accepted',
            'gdpr' => 'accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'type'    => 'display',
                'message' => $validator->errors()
            ], 422);
        }

        try{
            Lead::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'county' => $request->input('county'),
                'city' => $request->input('city'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'source' => $request->input('source'),
                'terms' => (filter_var($request->input('terms'), FILTER_VALIDATE_BOOLEAN)) ? 1 : 0,
                'gdpr' => (filter_var($request->input('gdpr'), FILTER_VALIDATE_BOOLEAN)) ? 1 : 0,
                'nl' => (filter_var($request->input('nl'), FILTER_VALIDATE_BOOLEAN)) ? 1 : 0,
            ]);
            return response()->json([
                'success' => true,
                'type'    => 'standard',
                'message' => 'Mesajul tău a fost trimis cu succes.'
            ], 422);
        }catch(Exception $exception) {

            $errorCode = $exception->getCode();
            if($errorCode=='2002'){
                $response = array(
                    'success' => false,
                    'type'    => 'display',
                    'message' => array('A intervenit o eroare la creearea contului. Te rugăm încearcă din nou.')
                );
            }

            return response()->json($response);
        }
    }
}
