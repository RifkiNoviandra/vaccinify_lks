<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    function RequestConsultation(Request $request){
        $request->validate([
            'disease_history' => 'required',
            'current_symptoms' => 'required'
        ]);

        $user = Auth::guard('society')->user();
        $input = $request->only('disease_history' , 'current_symptoms');
        $input['status'] = 'pending';
        $input['society_id'] = $user->id;

        $create = Consultation::create($input);

        if (!$create){
            return response([
                'message' => 'data Cant Processed'
            ] , 401);
        }

        return response([
           'message' => 'Request consultation sent successful'
        ]);
    }

    function getConsultation(Request $request){
        $user = Auth::guard('society')->user();
        $data = Consultation::with('user')->where('society_id' , $user->id)->orderBy('id' , 'DESC')->get();

        return response([
            'consultations'=> $data
        ]);
    }



}
