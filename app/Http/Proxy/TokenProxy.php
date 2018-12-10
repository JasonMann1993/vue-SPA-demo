<?php

namespace App\Http\Proxy;


use GuzzleHttp\Client;

class TokenProxy
{
    protected $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }


    public function login($email,$password)
    {
        if(auth()->attempt(['email' => $email, 'password' => $password, 'is_active'=> 1])){
            return $this->proxy('password',[
                'username' => $email,
                'password' => $password,
                'scope' => ''
            ]);
        }

        return response()->json([
           'status' => false,
           'message' =>  'Credentials not match'
        ],421);
    }

    public function refresh()
    {
        $refreshToken = request()->cookie('refreshToken');

        return $this->proxy('refresh_token',[
            'refresh_token' => $refreshToken
        ]);
    }

    public function logout()
    {
        $user = auth()->guard('api')->user();

        if($user) {
            $accessToken = $user->token();

            app('db')->table('oauth_refresh_tokens')->where('access_token_id',$accessToken->id)->update([
                'revoked' => true
            ]);
            $accessToken->revoke();

        }

        $cookie = app('cookie')->forget('refreshToken');

        return response()->json([
            'message' => 'logout'
        ],204)->cookie($cookie);
    }

    public function proxy($grantType, array $data)
    {
        $response = $this->http->post('http://homestead.test/oauth/token', [
            'form_params' => array_merge($data,[
                'grant_type' => $grantType,
                'client_id' => env('PASSPOART_CLIENT_ID'),
                'client_secret' => env('PASSPOART_CLIENT_SECRET'),
            ])
        ]);

        $token = json_decode((string) $response->getBody(),true);

        return response()->json([
            'token' => $token['access_token'],
            'auth_id' => md5($token['refresh_token']),
            'expires_in' => $token['expires_in']
        ])->cookie('refreshToken', $token['refresh_token'],14400,null,null,false, true);

    }
}
