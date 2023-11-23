<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // in flutter, use https://pub.dev/packages/device_info
        return response()->json([
            'token' => $user->createToken(
                name: $request->device_name,
                expiresAt: now()->addDays(90)
            )->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;

            $accessToken = $model::findToken($token);

            if($accessToken) {
                $accessToken->delete();
            }
        }

        return response()->json([
            'status' => true,
        ]);
    }

    public function validateToken(Request $request)
    {
        $status = false;

        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;

            $accessToken = $model::findToken($token);

            if($accessToken) {
                $status = now()->lessThan($accessToken->expires_at) ? true : false;

                if(! $status) {
                    $accessToken->delete();
                }
            }
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
