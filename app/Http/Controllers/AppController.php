<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jwt;
use Illuminate\Support\Facades\Crypt;

class AppController extends Controller
{
    private $secret;

    public function __construct()
    {
        $this->secret = env('APP_KEY');
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'secret' => 'required|min:32',
            'email' => 'required|email',
        ]);
        

        $payload =
        [
            'ant_req' => $request->ant_req,
            'mnt_req' => Carbon::now()->month,
            'premium' => $request->premium,
            'secret' => Crypt::encrypt($request->secret),
            'email' => $request->email,
        ];

        $token = (new Jwt)->encodeToken($payload, $this->secret);

        
        return response()->json(['status' => 'success', 'token' => $token], 200);
    }

    public function encode(Request $request)
    {
        $secret = Crypt::decrypt($request->get('secret'));

        $token = (new Jwt)->encodeToken($request->toArray(), $secret);

        return response()->json(['status' => 'success', 'token' => $token], 200);
    }

    public function decode(Request $request)
    {
        $secret = Crypt::decrypt($request->get('secret'));
        $token = $request->token;
        $response = (new Jwt)->decodeToken($token, $secret);

        if(!$response)
        {
            return response()->json(['status' => 'failed'], 409);
        }
        
        return response()->json(['status' => 'success', 'data' => $response], 200);
    }

}
