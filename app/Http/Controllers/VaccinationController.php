<?php

namespace App\Http\Controllers;

use App\Http\Resources\VaccinationDataCollection;
use App\Http\Resources\VaccinationDataResources;
use App\Models\Consultation;
use App\Models\vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    function RegisterVaccination(Request $request){
        $request->validate([
            'spot_id' => 'required',
            'date' => [
                'required',
                'dateformat:Y-m-d'
            ]
        ]);

        $input = $request->only('spot_id' , 'date');

        $id = Auth::guard('society')->id();
        $check = Consultation::with('society')->where('society_id' , $id)->first();

        if ($check->status !== 'accepted'){
            return response([
                'message' => 'your consultation must be accepted by doctor before'
            ],401);
        }

        $dose = vaccination::where('society_id' , $id)->orderBy('id' , 'DESC')->first();
        $input['society_id'] = $id;
        if (!$dose){

            $input['dose'] = 1;
            vaccination::create($input);
            return response([
                'message' => 'First vaccination registered'
            ]);
        }else if ($dose->dose === 1){
            $date = Carbon::parse($dose->date);
            if ($date->diffInDays(Carbon::parse($request->date)) > 30){
                $input['dose'] = 2;
                vaccination::create($input);
                return response([
                    'message' => 'Second vaccination registered'
                ]);
            }else{
                return response([
                    'message' => 'wait at least +30days from 1st vaccination'
                ] , 401);
            }
        }else{
            return response([
                'message' => 'the Society has been 2x vaccinated'
            ],401);
        }
    }

    function getVaccinationById(){
        $user = Auth::guard('society')->user();

        $data = vaccination::with(['spot.regional' , 'vaccine' , 'user.medical'])->where('society_id' , $user->id)->get();

        return response([
            'vaccinations' => new VaccinationDataCollection($data)
        ]);

    }

    function getVaccinationBydate(Request $request , $spot_id){

        $date = $request->date;
        $data = vaccination::with(['spot.regional' , 'vaccine' , 'user' , 'society'])->where('spot_id' , $spot_id)->where('date' , $date)->orderBy('id' , 'ASC')->get();

        return response([
            'data' => $data
        ]);

    }
}
