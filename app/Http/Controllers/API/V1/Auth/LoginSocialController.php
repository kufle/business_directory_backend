<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoginSocialController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'id' => ['required']
        ]);

        if(!$request->id) {
            throw ValidationException::withMessages([
                'id' => ['The provided credentials are incorrect.']
            ]);
        }

        $user = User::where('social_id', $request->id)->first();
        if ($user) {
            $device = substr($request->userAgent() ?? '', 0, 255);
            $expiresAt = $request->remember ? null : now()->addMinutes((int) config('session.lifetime'));

            return UserResource::make($user)->additional([
                'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'social_id' => $request->id,
                'avatar' => $request->photo,
                'password' => Hash::make(Str::password(12)),
            ]);
            $device = substr($request->userAgent() ?? '', 0, 255);
            $expiresAt = $request->remember ? null : now()->addMinutes((int) config('session.lifetime'));

            return UserResource::make($user)->additional([
                'access_token' => $user->createToken($device, expiresAt: $expiresAt)->plainTextToken,
            ]);
        }
    }
}
