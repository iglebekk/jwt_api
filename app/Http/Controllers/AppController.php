<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Jwt;

class AppController extends Controller
{

    public function encode(Request $request)
    {
        $secret = $this->getSecret();

        $token = (new Jwt)->encodeToken($request->toArray(), $secret);

        return response()->json(['status' => 'Token created', 'token' => $token], 200);
    }

    public function decode(Request $request)
    {
        $secret = $this->getSecret();
        $token = $request->token;
        $response = (new Jwt)->decodeToken($token, $secret);

        if(!$response)
        {
            return response()->json(['status' => 'Token failed'], 200);
        }
        return response()->json(['status' => 'Token accepted', 'data' => $response], 200);
    }

    private function getSecret()
    {
        return "9WXGnDzAQMG9gvQrcyP3YNVyQdEARPab";
    }
}
