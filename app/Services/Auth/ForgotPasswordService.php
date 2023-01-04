<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordService
{

    /**
     * Logic to handle the data
     */
    public function handle($data)
    {   
        $token = base64_encode(Str::random(64));
        DB::table('password_resets')->insert([
            'email' => $data['email'] ,
            'token' => $token ,
            'created_at' => Carbon::now(),
        ]);
        $user = User::where('email', $data['email'] )->first();
        $link = route('author.reset-form',['token' => $token,'email' => $data['email']]);
        $body_mess = 'Click here to reset password<br><a href='.$link.' >RESET PASSWORD</a>';
        $data=[
            'name' => $user->name,
            'body_message' => $body_mess,
        ];
        Mail::send('forgot-email-template',$data,function($message) use ($user){
            $message->from('huyxinhboy12@gmail.com','lara-blog');
            $message->to($user->email,$user->name)->subject('Reset Password');
        });
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