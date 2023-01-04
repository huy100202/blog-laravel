<?php

namespace App\Services\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
class LoginService
{

    /**
     * Logic to handle the data
     */
    public function handle($data)
    {
        $cred = ['email' => $data['email'], 'password' => $data['password']];
        if(Auth::attempt($cred)) {
            return redirect()->route('author.home');
            // $checkUser = User::where(['email'=> $data['email'],'password'=>$data['password']])->first();
            // if($checkUser){
            //     return redirect()->intended('author.home');
            // } else {
            //     return Redirect::back()->withErrors(['msg' => 'Incorrect email or password']);
            // }
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

        /**
     * Credential Information
     *
     * @return mixed
     */
    // protected function credential()
    // {
    //     $credential = $this->data;
    //     if (Auth::guard('api-member')->attempt($credential)) {
    //         return Auth::guard('api-member')->user();
    //     }
    //     return null;
    // }
    
    // /**
    //  * Get Token
    //  *
    //  * @param User $admin
    //  * @return array
    //  */
    // protected function getToken($admin): array
    // {
    //     $expireTime = now()->addMinutes(config('session.lifetime'));
    //     $token      = $admin->createToken(config('app.name'));
    //     $token->token->update(['expires_at' => $expireTime]);

    //     return [
    //         'token_type'   => 'Bearer',
    //         'access_token' => $token->accessToken,
    //         'expired_at'   => $expireTime,
    //     ];
    // }

}