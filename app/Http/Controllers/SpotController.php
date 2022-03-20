<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotResorcesData;
use App\Http\Resources\SpotVaccinationsData;
use App\Models\spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    function getSpot(Request $request){
        $data = spot::with('vaccine')->get();

        return response([
            'spots' => SpotResorcesData::collection($data)
        ]);
    }

    function getSpotById(Request $request , $spot_id){
        $request->validate([
            'date' => [
                'dateformat:Y-m-d'
            ],
        ]);

        $data = spot::with(['vaccination'=>function($query) use ($request) {
            return $query->where('date' , $request->date);
        }])->where('id' , $spot_id)->get();

        return response([
            SpotVaccinationsData::collection($data)
        ]);
    }
}
