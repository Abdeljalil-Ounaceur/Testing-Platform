<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Utilisateur;
use App\Traits\HttpResponses;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());           //validates the request, if everything is ok, it will return true
        $credentials = $request->only('email', 'password');     //gets the email and password from the request

        if (auth()->attempt($credentials)) {        //checks if the credentials are correct
            $user = User::where('email', $request->email)->first();     //gets the user from the database
            return $this->success([     //returns the user and the token
                'user' => $user,
                'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
            ]);
        } else {
            $response = "Email or password is wrong!";
            return response($response, 401);
        }
    }


    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();       //deletes the token of the user

        return $this->success([             //this success method is in the HttpResponses trait, App/Trait/HttpResponses
            'message' => 'Logged out successfully'
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());       //validates the request, if everything is ok, it will return true

        $user = User::create([          //creates the user  
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'gsm' => $request->gsm,
            'isAdmin' => $request->isAdmin,
            'password' => Hash::make($request->password)    //hashes the password
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->nom)->accessToken        //this is the token that will be used to authenticate the user
        ]);
    }
}
