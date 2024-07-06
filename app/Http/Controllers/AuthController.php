<?php

namespace App\Http\Controllers;

use App\Enums\TokenAbility;
use App\Exceptions\ApiUnauthorizedException;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponser;
    public function signup(SignupRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $this->successResponse(data: $user->toArray(), statusCode: Response::HTTP_CREATED);
    }

    public function signin(SigninRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (! Auth::attempt($data))
            throw new ApiUnauthorizedException();

        // TODO: change to update()
        Auth::user()->tokens()->delete();

        return $this->successResponse($this->createTokensPair());
    }

    public function refresh(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->successResponse($this->createTokensPair());
    }

    public function signout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return $this->successResponse();
    }

    private function createTokensPair(): array
    {
        $accessToken = Auth::user()->createToken('access_token', [
            TokenAbility::ACCESS_API->value
        ], now()->addMinutes(config('sanctum.at_expiration')));

        $refreshToken = Auth::user()->createToken('refresh_token', [
            TokenAbility::REFRESH_ACCESS_TOKEN->value
        ], now()->addMinutes(config('sanctum.rt_expiration')));

        return [
            'access_token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken
        ];
    }
}
