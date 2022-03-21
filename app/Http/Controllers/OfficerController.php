<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\User;
use App\Models\vaccination;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $input = $request->only('username' , 'password');

        $user = User::with('medical')->where('username' , $input['username'])->where('password' , $input['password'])->first();

        if (!$user){
            return response([
                'message' => 'Username / Password Salah'
            ] , 401);
        }

        return response([
            $user
        ]);
    }

    function getAllConsultation(Request $request){

        $data = Consultation::with('society')->where('status' , 'pending')->get();

        return response([
            'data' => $data
        ]);
    }

    function approveConsultation(Request $request , $id){
        $request->validate([
            'doctor_id' => 'required' ,
            'doctor_notes' => 'required',
            'status' => 'required'
        ]);

        $input = $request->only('doctor_id' , 'doctor_notes' , 'status');

        $data = Consultation::where('id' , $id)->first();

        if (!$data){
            return response([
                'message' => "No data with Id ".$id
            ] , 401);
        }

        $data->doctor_id = $input['doctor_id'];
        $data->doctor_notes = $input['doctor_notes'];
        $data->status = $input['status'];

        if ($data->save() && $input['status'] === 'accepted'){
            return response([
                'message' => 'Consultation Accepted'
            ]);
        }elseif ($data->save() && $input['status'] === 'declined'){
            return response([
                'message' => 'Consultation Declined'
            ]);
        }else{
            return response([
                'message' => 'Data Cant be Processed'
            ] , 401);
        }
    }

    function getAllVaccination(Request $request){
        $data = vaccination::with('society' , 'user' , 'vaccine' , 'spot')->where('doctor_id' , null)->where('officer_id' , null)->where('vaccine_id' , null)->get();

        return response([
            'data' => $data
        ]);
    }

    function Vaccination(Request $request , $id){
        $request->validate([
            'doctor_id' => 'required',
            'vaccine_id' => 'required',
            'officer_id' => 'required'
        ]);

        $input = $request->only('doctor_id' , 'vaccine_id' , 'officer_id');

        $data = vaccination::where('id' , $id)->first();

        if (!$data){
            return response([
                'message' => 'No data with ID '.$id
            ] , 401);
        }

        $data->doctor_id = $input['doctor_id'];
        $data->vaccine_id = $input['vaccine_id'];
        $data->officer_id = $input['officer_id'];

        if ($data->save()){
            return response([
                'message' => 'Vaccination Complete'
            ]);
        }

        return response([
            'message' => 'Data Cant Be processed'
        ] , 401);
    }
}
