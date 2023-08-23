<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthenticationController extends Controller
{
    use GeneralTrait;

    public function registerUser(UserRegisterRequest $request){
        try{

            $user = User::create($request->validated());

            if($user){
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                $success['name'] =  $user->name;
                return $this->returnData($success,__('messages.userRegisteredSuccessfully'));
            }else{
                return $this->returnError(__('messages.errorWhenRegisteringUser'));
            }

        } catch (\Throwable $th) {
            return $this->returnError(__('messages.errorWhenRegisteringUser'));
        }

    }

    public function loginUser(UserLoginRequest $request){
        try{

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){
                $user = Auth::user();
                $success['user'] = new UserResource($user);
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return $this->returnData($success,__('messages.loginSuccessfully'));
            }
            else{
                return $this->returnError(__('messages.incorrectLoginData'));
            }

        } catch (\Throwable $th) {
            return $this->returnError(__('messages.errorWhenLoginUser'));
        }
    }
}
