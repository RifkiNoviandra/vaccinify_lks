<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\vaccine;
use Illuminate\Http\Request;

class OfficerGetData extends Controller
{
    function getDoctor(){
        $data = User::with('medical')->get();

        return response([
            'data' => $data
        ]);
    }

    function getVaccine(){
        $data = vaccine::all();

        return response([
            'data' => $data
        ]);
    }
}
