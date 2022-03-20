<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;

class SocietyController extends Controller
{
    function login(Request $request){
        $request->validate([
            'id_card_number' => 'required',
            'password' => 'required'
        ]);

        $input = $request->only('id_card_number' , 'password');

        $user = Society::with('regional')->where('id_card_number' , $input['id_card_number'])->where('password' , $input['password'])->first();

        if (!$user){
            return response([
                'message' => 'ID Card Number or Password Incorrect'
            ] , 401);
        }

        $user->login_tokens = md5($input['id_card_number']);
        $user->save();

        return response([
            $user
        ]);
    }

    function logout(Request $request){
        $token = $request->get('token');

        $user = Society::where('login_tokens' , $token)->first();

        if ($token === null){
            return response([
                'message' => 'invalid token'
            ] , 401);
        }

        $user->login_tokens = null;
        $user->save();

        return  response([
            'message' => 'logout success'
        ]);
    }
}
